$(document).ready(inicializarEventos);

function inicializarEventos()
{
	inicio();
}
function inicio()
{
	$('.field-terceros-razon_social').hide();
	$('.field-terceros-digitoverificacion').hide();
}
function formularioajax(idformulario)
{
	var url=$("#"+idformulario).attr("action");
	var datastring = $("#"+idformulario).serialize();
	$.ajax({
  		type: "POST",
  		url:".."+url,
  		data:datastring,  		
  		success : function(data) {
  			alert('data');
        	$('.mensaje').html(data);
    	}
	});
    // tu codigo aqui
 
}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function terceros(b=null){
	if(b==3)
 	{
 		$('.field-terceros-nombre').hide();
 		$('#terceros-nombre').val("");
 		$('.field-terceros-apellido').hide();
 		$('.field-terceros-apellido input').val("");
 		$('.field-terceros-razon_social').show();
 		$('.field-terceros-digitoverificacion').show();
 	}
 	else
 	{
 		$('.field-terceros-nombre').show();
 		$('.field-terceros-apellido').show();
 		$('.field-terceros-razon_social').hide();
 		$('.field-terceros-razon_social input').val("");
 		$('.field-terceros-digitoverificacion').hide();
 		$('.field-terceros-digitoverificacion input').val("");
 	}
}


$('#detallescomprobanteegreso-cedulatercero').bind('typeahead:select', function(ev, suggestion) {

	 $('#detallescomprobanteegreso-idtercero').val(suggestion.idtercero);
	 if(suggestion.razon_social!="")
	 {
	 	$('#detallescomprobanteegreso-nombre').val(suggestion.razon_social);
	 }
	 else
	 {
	 	var nombre=suggestion.nombre+" "+suggestion.apellido;
	 	$('#detallescomprobanteegreso-nombre').val(nombre);
	 }	
   
});
$('#detallescomprobanteegreso-idconcepto').on('change', function() {
	var idconcepto=this.value;
	$.ajax({
  		type: "POST",
  		url:"../concepto/concepto-porcentaje",
  		data: {id:idconcepto},
  		dataType : 'json',
  		success : function(data) {
        	$.each(data, function(indice, valor) {
        		$('#detallescomprobanteegreso-porcentaje').val(data[indice]['porcentaje']);
        		$('#detallescomprobanteegreso-piso').val(data[indice]['piso']);
        		$('#detallescomprobanteegreso-doble').val(data[indice]['doble']);
        		$('#detallescomprobanteegreso-adjobligatorio').val(data[indice]['adjobligatorio']);
			});
    	}
	});
});
	
$('#detallescomprobanteegreso-valor-disp').on('blur', function() {
	var resultado=0;
	var valorbase=this.value;
	valorbase=valorbase.replace("$", "");
	valorbase=parseInt(valorbase.split(',').join(''));	
	var porcentaje=$('#detallescomprobanteegreso-porcentaje').val();
	var piso=$('#detallescomprobanteegreso-piso').val();
	if(valorbase>= piso)
	{	
		resultado=regladetres(valorbase,porcentaje);
	}
	
	$("#detallescomprobanteegreso-subtotal-disp").val(resultado);
	document.getElementById('detallescomprobanteegreso-subtotal-disp').focus();
	$('#detallescomprobanteegreso-total-disp').val(valorbase-resultado);
	document.getElementById('detallescomprobanteegreso-total-disp').focus();

});

function regladetres(valorbase,porcentaje)
{
	var resultado=(porcentaje*valorbase)/100;
	return resultado;
}

function updatecomprobantes(urlalta,urlbaja){
  id=getParameterByName('id');
  var valorbase=$(".valor-total").text();
  var valorreal=$(".valor-comprobante").text();
  valorbase=valorbase.replace("$", "");
  valorreal=valorreal.replace("$", "");
  if(valorbase==valorreal)
  {
      $.ajax({
      type: "GET",
      url:urlalta,
      data: {id:id},    
      success : function(data) {
         $('.mensaje').html(data); 
      }
      });
  }
  else
  {
   $.ajax({
      type: "GET",
      url:urlbaja,
      data: {id:id},    
      success : function(data) {
         $('.mensaje').html(data); 
      }
      });
    
  }
}

$(function(){


      $(document).on('click', '.showModalButton', function(){

         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {        		
            $('#modal').find('#modalContent')
             .load($(this).attr('value'));
            //dynamiclly set the header for the modal
document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title')+
'</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

        } else {
        		inicio();
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
          
        }
    });
});