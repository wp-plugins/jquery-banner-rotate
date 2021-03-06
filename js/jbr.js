// JavaScript Document

function formatar(src){
	var mask = '##/##/####';
	var i = src.value.length;
	src.value = src.value.replace("//","/");
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
   		src.value += texto.substring(0,1);
	}
}

function valida(form)
{
	if (form.link.value == "" && form.dataRetirada.value == "" && form.pagina.value == "")
	{
		alert(alerts.msg1);
		return false;
	}
	else if (form.link.value == "")
	{
		alert(alerts.msg2);
		return false;
	}
	else if (valida_data(form) == false)
	{
		return false;
	}
	
	return true;
}

function valida_data(form)
{	
	if (form.dataRetirada.value == "")
	{
		return true;
	}
	
    var data = form.dataRetirada.value.split("/");
	
	var msg = alerts.msg3;
	
	var dia = parseInt(data[0]);
	var mes = parseInt(data[1]);
	var ano = parseInt(data[2]);
	
	if (mes < 1 || mes > 12)
	{
		alert(msg);
		return false;
	}

	if (dia < 1)
	{
		alert(msg);
		return false;
	}
	
	if (mes % 2 == 1 && mes < 8)
	{
		if (dia > 31)
		{
			alert(msg);
			return false;
		}
	}
	else if (mes % 2 == 1 && mes > 7)
	{
		if (dia > 30)
		{
			alert(msg);
			return false;
		}
	}
	else if (mes % 2 == 0 && mes > 7)
	{
		if (dia > 31) {
			alert(msg);
			return false;
		}
	}
	else if (mes < 8)
	{
		if (mes % 2 == 0 && mes != 2)
		{
			if (dia > 30)
			{
				alert(msg);
				return false;
			} 
		}
		else if (mes == 2)
		{
			if (ano % 4 == 0 && ano % 100 != 0 || ano % 400 == 0)
			{
				if (dia > 29)
				{
					alert(msg);
					return false;
				}
			}
			else
			{
				if (dia > 28)
				{
					alert(msg);
					return false;
				}
			}
		}
	}
	
	return true;
}


(function($){
	$('#dataRetirada').mask('99/99/9999');

	var jbrUpload;
	
	$('#jbr_upload_image_button').click(function(e){
		e.preventDefault();
		var title = $(this).data('title');

		if (jbrUpload)
		{
			jbrUpload.open();
			return;
		}

		jbrUpload = wp.media.frames.jbrUpload = wp.media({
			library : {
				type : 'image'
			},
			title : title,
			button : {
				text : jbrattrs.textbutton
			},
			multiple : false
		});

		jbrUpload.on('select', function(){
			attachment = jbrUpload.state().get('selection').first().toJSON();
			$('#link').val(attachment.url);
		});

		jbrUpload.open();
	});
})(jQuery);