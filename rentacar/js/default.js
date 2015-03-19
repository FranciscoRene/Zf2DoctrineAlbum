(function( $ ) {
	$.fn.validCampoFranz = function(cadena) {
    	$(this).on({
			keypress : function(e){
    			var key = e.which,
    				keye = e.keyCode,
    				tecla = String.fromCharCode(key).toLowerCase(),
    				letras = cadena;
			    if(letras.indexOf(tecla)==-1 && keye!=9&& (key==37 || keye!=37)&& (keye!=39 || key==39) && keye!=8 && (keye!=46 || key==46) || key==161){
			    	e.preventDefault();
			    }
			}
		});
	};
})( jQuery );

$(function(){
                //Para escribir solo letras

		//CLIENTES
                $('#c_rut').validCampoFranz('0123456789.-k');
                $('#c_edad').validCampoFranz('0123456789');
                $('#c_tel').validCampoFranz('0123456789-');
		//ARRIENDO
                $('#c_rut_text').validCampoFranz('0123456789.-k');
                $('#v_valor').validCampoFranz('0123456789.');

		//VEHICULOS
                $('#v_cilindrada').validCampoFranz('0123456789.');

		// MANTENCIONES
                $('#mant_valor').validCampoFranz('0123456789.');

		// SERV TECNICOS
                $('#serv_tel').validCampoFranz('0123456789');
                $('#serv_rut').validCampoFranz('0123456789.-k');

            });
