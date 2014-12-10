<?php

if (!function_exists('dbDelta'))
{
	require(ABSPATH . 'wp-admin/includes/upgrade.php');
}

class JBRBanner
{
	private $table;

	private $wpdb;

	public function __construct()
	{
		global $wpdb;

		$this->table = $wpdb->base_prefix . 'banners';
		$this->wpdb = $wpdb;
	}
	
	public function createTable()
	{
		$sql = 'CREATE TABLE ' . $this->table . ' (
			id int NOT NULL AUTO_INCREMENT,
			link varchar(250) null,
			data_insercao date not null,
			data_retirada varchar(10) null,
			pagina varchar(250) null,
			nova char null,
			slider_id int null,
			PRIMARY KEY(id)
		);';

		dbDelta($sql);
	}

	public function dropTable()
	{
		$this->wpdb->query("DROP TABLE IF EXISTS {$this->table}");
	}
	
	public function save($values)
	{
		$vals['link'] = trim($values['link']);
		$vals['data_insercao'] = date('Y-m-d');
		$vals['data_retirada'] = trim($values['data_retirada']);
		$vals['pagina'] = trim($values['pagina']);
		$vals['slider_id'] = trim($values['slider_id']);
		$vals['nova'] = trim($values['nova']);

		$this->wpdb->insert($this->table, $vals);
	}
	
	public function update($id, $values)
	{
		$vals['link'] = trim($values['link']);
		$vals['data_retirada'] = trim($values['data_retirada']);
		$vals['pagina'] = trim($values['pagina']);
		$vals['slider_id'] = trim($values['slider_id']);
		$vals['nova'] = trim($values['nova']);
		
		$this->wpdb->update($this->table, $vals, array('id' => $id));
	}
	
	public function delete($id)
	{
		$this->wpdb->delete($this->table, array('id' => $id), array('%d'));
	}
	
	public function find($id)
	{
		$sql = $this->wpdb->prepare(
			"SELECT id, link, data_retirada, slider_id, pagina, nova FROM {$this->table} WHERE id = %d",
			$id
		);
		return $this->wpdb->get_row($sql);
	}
	
	public function listAll()
	{
		return $this->wpdb->get_results(
			"SELECT id, link, data_retirada, slider_id, pagina, nova FROM {$this->table} ORDER BY data_insercao DESC"
		);
	}
	
	public function listBySlider($id, $limit = null)
	{
		if (is_null($limit))
		{
			$sql = $this->wpdb->prepare(
				"SELECT id, link, data_retirada, pagina, nova FROM {$this->table} WHERE slider_id = %d ORDER BY
					data_insercao DESC",
				$id
			);
		}
		else
		{
			$sql = $this->wpdb->prepare(
				"SELECT id, link, data_retirada, pagina, nova FROM {$this->table} WHERE slider_id = %d ORDER BY
					data_insercao DESC LIMIT %d",
				$id,
				$limit
			);
		}
		
		return $this->wpdb->get_results($sql);
	}
	
	public function listWithLimit($limit = 5)
	{
		$sql = $this->wpdb->prepare(
			"SELECT id, link, data_retirada, pagina, nova FROM {$this->table} ORDER BY data_insercao DESC LIMIT %d",
			$limit
		);
		return $this->wpdb->get_results($sql);
	}

	public function getBanners($limit = null)
	{
		$sql = "SELECT id, link, pagina, nova FROM {$this->table} WHERE data_retirada = '' OR
			CURDATE() < STR_TO_DATE(data_retirada, '%Y-%m-%d') ORDER BY data_insercao DESC";
			
		if (!is_null($limit))
		{
			if (is_numeric($limit) && (intval($limit) == floatval($limit)))
			{
				$sql .= ' LIMIT ' . $limit;
			}
		}
		
		return $this->wpdb->get_results($sql);
	}

	public function getBannersBySlider($id, $limit = null)
	{
		$sql = $this->wpdb->prepare(
			"SELECT id, link, pagina, nova FROM {$this->table} WHERE slider_id = %d",
			$id
		);

		$sql .= " AND data_retirada = '' OR CURDATE() < STR_TO_DATE(data_retirada, '%Y-%m-%d') ORDER BY data_insercao DESC";
		
		if (!is_null($limit))
		{
			if (is_numeric($limit) && (intval($limit) == floatval($limit)))
			{
				$sql .= ' LIMIT ' . $limit;
			}
		}
		
		return $this->wpdb->get_results($sql);
	}
}