// JavaScript Document

var f;

window.addEvent('domready', function() {
	f = new Formulario('Datos');
	
	$('cias').addEvents({
		keydown: function(e) {
			if (e.key == 'enter') {
				e.stop();
				$('anio').select();
			}
		}
	});
	
	$('anio').addEvents({
		keydown: function(e) {
			if (e.key == 'enter') {
				e.stop();
				$('cias').select();
			}
		}
	});
	
	$('generar').addEvent('click', Generar);
	
	$('cias').focus();
});

var Generar = function() {
	if ($('anio').get('value').getVal() == 0) {
		alert('Debe especificar el a�o de consulta');
		$('anio').select();
		return false;
	}
	
	f.form.set({
		'action': 'ArchivoDepositosContadores.php?accion=generar',
		'method': 'post'
	});
	
	f.form.submit();
}
