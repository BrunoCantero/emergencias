$(document).ready(function(){
	load(1);
	//load_date(1);
});

function load(page){
	var q= $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/atenciones_base.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
		$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
		$(".outer_div").html(data).fadeIn('slow');
		$('#loader').html('');

		}
	})
	
}
/*function function load_date(page){
var date= $("#date").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/despachos.php?action=ajax&page='+page+'&q='+date,
		beforeSend: function(objeto){
		$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
		$(".outer_div").html(data).fadeIn('slow');
		$('#loader').html('');

		}
	})
}
*/
function eliminar (id)
{
	var q= $("#q").val();
	if (confirm("Realmente deseas eliminar la atencion?")){	
		$.ajax({
		type: "GET",
		url: "./ajax/atenciones_base.php",
		data: "id="+id,"q":q,
		beforeSend: function(objeto){
		$("#resultados").html("Mensaje: Cargando...");
		},
			success: function(datos){
			$("#resultados").html(datos);
			load(1);
			}
		});
	}
}

		
		
		

