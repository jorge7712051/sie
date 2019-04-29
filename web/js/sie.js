$(document).ready(inicializarEventos);

function inicializarEventos()
{
	inicio();
  cargarciudades();
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
function cargarciudades(){
  var id=$('#informes-idpais').val();
  if (id!=null)
  {
     $.ajax({
      type: "GET",
      url:"../departamento/departamento",
      data: {id:id},
      success : function(data) {
      
      $('#informes-iddepartamento').html( data );
      }
    });
  }
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

function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
 
else{ alert('Solo se permiten numeros');
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}


$('#detallescomprobanteegreso-cedulatercero').bind('typeahead:select', function(ev, suggestion) {
   
	 $('#detallescomprobanteegreso-idtercero').val(suggestion.idtercero);
   $('#detallerecibocaja-idtercero').val(suggestion.idtercero);
	 if(suggestion.razon_social!=null && suggestion.razon_social!="")
	 {
	 	$('#detallescomprobanteegreso-nombre').val(suggestion.razon_social);
	 }
	 else
	 {
    
	 	var nombre=suggestion.nombre+" "+suggestion.apellido;
	 	$('#detallescomprobanteegreso-nombre').val(nombre);
	 }	
   
});
$('#detallerecibocaja-cedulatercero').bind('typeahead:select', function(ev, suggestion) {

    $('#detallerecibocaja-idtercero').val(suggestion.idtercero);
   if(suggestion.razon_social!=null && suggestion.razon_social!="")
   {
    
    $('#detallerecibocaja-nombre').val(suggestion.razon_social);
   }
   else
   {
    
    var nombre=suggestion.nombre+" "+suggestion.apellido;
    $('#detallerecibocaja-nombre').val(nombre);
   }  
   
});
/*
$('#informes-idarea').change(function() {
        alert(this.value);
    });*/
$('#detallescomprobanteegreso-cedulatercero').on('blur', function() {
    var id=$('#detallescomprobanteegreso-idtercero').val();
    var identificacion=this.value;
    this.value=numberFormat(identificacion);
    $.ajax({
            url : '../terceros/busqueda',
            data : { id : identificacion },
            type : 'POST',
            dataType : 'json',
            success : function(data) {

                $('#detallescomprobanteegreso-idtercero').val(data.idtercero);
                if(data.razon_social!="" && data.razon_social!=null)
                {
                  $('#detallescomprobanteegreso-nombre').val(data.razon_social);
                }
                else
                {
                  var nombre=data.nombre+" "+data.apellido;
                  $('#detallescomprobanteegreso-nombre').val(nombre);
                }  
            }
      });
  });

$('#detallerecibocaja-cedulatercero').on('blur', function() {
    var id=$('#detallerecibocaja-idtercero').val();
    var identificacion=this.value;
    format(this);
      $.ajax({
            url : '../terceros/busqueda',
            data : { id : identificacion },
            type : 'POST',
            dataType : 'json',
            success : function(data) {

                $('#detallerecibocaja-idtercero').val(data.idtercero);
                if(data.razon_social!="" && data.razon_social!=null)
                {
                  $('#detallerecibocaja-nombre').val(data.razon_social);
                }
                else
                {
                  var nombre=data.nombre+" "+data.apellido;
                  $('#detallerecibocaja-nombre').val(nombre);
                }  
            }
      });
  });

$('#detallescomprobanteegreso-idconcepto').on('change', function() {
	var idconcepto=this.value;
  asientocontable(idconcepto);
	
});
$('#informes-idpais').on('change',function(){
  var id=$('#informes-idpais').val();
  
  $.ajax({
      type: "GET",
      url:"../departamento/departamento",
      data: {id:id},
      success : function(data) {
      
     $('#informes-iddepartamento').html( data );
      }
  });

});


$('#detallerecibocaja-idtipoingreso').on('change', function() {
  var idconcepto=this.value;
  $.ajax({
      type: "POST",
      url:"../tipo-ingreso/ingreso-doble",
      data: {id:idconcepto},
      dataType : 'json',
      success : function(data) {
          $.each(data, function(indice, valor) {
            $('#detallerecibocaja-doble').val(data[indice]['doble']);
          
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
  resultado = Math.round(resultado);
  return resultado;
}


function asientocontable(idconcepto)
{
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

 function numberFormat(numero){
        // Variable que contendra el resultado final
        var resultado = "";
 
        // Si el numero empieza por el valor "-" (numero negativo)
        if(numero[0]=="-")
        {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero=numero.replace(/\./g,'').substring(1);
        }else{
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero=numero.replace(/\./g,'');
        }
 
        // Si tiene decimales, se los quitamos al numero
        if(numero.indexOf(",")>=0)
            nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf(","));
 
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;
 
        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if(numero.indexOf(",")>=0)
            resultado+=numero.substring(numero.indexOf(","));
 
        if(numero[0]=="-")
        {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-"+resultado;
        }else{
            return resultado;
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