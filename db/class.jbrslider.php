<?php

if (!function_exists('dbDelta'))
{
	require(ABSPATH . 'wp-admin/includes/upgrade.php');
}

class JBRSlider
{
	private $table;

	private $wpdb;

	public function __construct()
	{
		global $wpdb;

		$this->table = $wpdb->base_prefix . 'banner_sliders';
		$this->wpdb = $wpdb;
	}

	public function createTable()
	{
		$sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
			id int NOT NULL AUTO_INCREMENT,
			nome varchar(50) not null,
			efeito varchar(25) null,
			PRIMARY KEY(id)
		);";
		
		if (!$this->tableExists())
		{
			dbDelta($sql);
		}
	}

	private function tableExists()
	{
		return ($this->wpdb->get_row("SHOW TABLES LIKE '{$this->table}'"))? true : false;
	}

	public function dropTable()
	{
		$this->wpdb->query("DROP TABLE IF EXISTS {$this->table}");
	}
	
	public function save($values)
	{
		$values['nome'] = trim($values['nome']);
		$values['efeito'] = trim($values['efeito']);
		
		$this->wpdb->insert($this->table, $values);
	}
	
	public function update($id, $values)
	{
		$values['nome'] = trim($values['nome']);
		$values['efeito'] = trim($values['efeito']);
		
		$this->wpdb->update($this->table, $values, array('id' => $id));
	}
	
	public function find($id)
	{
		$sql = $this->wpdb->prepare("SELECT id, nome, efeito FROM {$this->table} WHERE id = %d", $id);

		return $this->wpdb->get_row($sql);
	}
	
	public function delete($id, $table_banner)
	{
		$this->wpdb->delete($this->table, array('id' => $id), array('%d'));
		
		$sql = $this->wpdb->prepare("UPDATE $table_banner SET slider_id = 0 WHERE slider_id = %d", $id);
		$this->wpdb->query($sql);
	}
	
	public function listAll()
	{
		return $this->wpdb->get_results("SELECT id, nome, efeito FROM {$this->table}");
	}

	public function getTableName()
	{
		return $this->table;
	}
}