// JavaScript Document

var homoclaves = [];

window.addEvent('domready', function() {
	Listado();
});

var Listado = function(comprobante) {
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=listado',
		'onRequest': function() {
			$('captura').empty();
			
			new Element('img', {
				'src': 'imagenes/_loading.gif'
			}).inject($('captura'));
			
			new Element('span', {
				'text': ' Buscando...'
			}).inject($('captura'));
		},
		'onSuccess': function(result) {
			$('captura').set('html', result);
			
			if ($defined($('banco'))) {
				new FormStyles($('Datos'));
				
				$('banco').addEvent('change', cambiarBanco);
				
				$$('[class^=linea_]').each(function(el) {
					el.addEvents({
						'mouseover': function() {
							this.addClass('highlight');
						},
						'mouseout': function() {
							this.removeClass('highlight');
						}
					});
				});
				
				$$('.comprobante').each(function(el, i) {
					el.addEvents({
						'mouseover': function() {
							this.setStyle('cursor', 'pointer');
						},
						'mouseout': function() {
							this.setStyle('cursor', 'default');
						},
						'click': ModificarComprobante.pass(el.get('title'))
					});
				});
				
				$$('.depositos').each(function(el, i) {
					el.store('tip:title', '<img src="imagenes/info.png" /> Informaci&oacute;n');
					el.store('tip:text', el.get('title'));
					
					el.removeProperty('title');
					
					el.addEvents({
						'mouseover': function() {
							this.setStyle('cursor', 'pointer');
						},
						'mouseout': function() {
							this.setStyle('cursor', 'default');
						}
					});
				});
				
				$$('img[id=mod]').each(function(el, i) {
					el.addEvents({
						'mouseover': function() {
							this.setStyle('cursor', 'pointer');
						},
						'mouseout': function() {
							this.setStyle('cursor', 'default');
						},
						'click': ModificarDepositos.pass(el.get('title'))
					});
				});
				
				$$('img[id=del]').each(function(el, i) {
					el.addEvents({
						'mouseover': function() {
							this.setStyle('cursor', 'pointer');
						},
						'mouseout': function() {
							this.setStyle('cursor', 'default');
						},
						'click': BorrarDepositos.pass(el.get('title'))
					});
				});
				
				tips = new Tips($$('.depositos'), {
					'fixed': true,
					'className': 'Tip',
					'showDelay': 50,
					'hideDelay': 50
				});
				
				$('nuevo').addEvent('click', Nuevo);
				
				if ($chk(comprobante)) {
					window.scrollTo(0, $(comprobante).getPosition().y - 50);
				}
			}
			else {
				$('nuevo').addEvent('click', Nuevo);
			}
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var cambiarBanco = function() {
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=cambiarBanco&banco=' + $('banco').get('value'),
		'onRequest': function() {
		},
		'onSuccess': function() {
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var Nuevo = function() {
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=nuevo',
		'onRequest': function() {
			$('captura').empty();
			
			new Element('img', {
				'src': 'imagenes/_loading.gif'
			}).inject($('captura'));
			
			new Element('span', {
				'text': ' Actualizando...'
			}).inject($('captura'));
		},
		'onSuccess': function() {
			Listado();
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var ModificarComprobante = function(comprobante) {
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=modComprobante&comprobante=' + comprobante,
		'onRequest': function() {
			$('captura').empty();
			
			new Element('img', {
				'src': 'imagenes/_loading.gif'
			}).inject($('captura'));
			
			new Element('span', {
				'text': ' Obteniendo comprobante...'
			}).inject($('captura'));
		},
		'onSuccess': function(result) {
			$('captura').set('html', result);
			
			new FormValidator($('Datos'), {
				showErrors: true
			});
			
			new FormStyles($('Datos'));
			
			$('cancelar').addEvent('click', Listado.pass(comprobante));
			$('cambiar').addEvent('click', ActualizarComprobante);
			
			$('comprobante_nuevo').select();
			
			/*
			@ FIX: Mover scroll hasta el principio de la p�gina cuando el tama�o del scroll de la p�gina no se auto-ajusta
			*/
			window.scrollTo(0, 0);
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var ActualizarComprobante = function() {
	if (!$chk($('comprobante_nuevo').get('value').getNumericValue())) {
		alert('Debe especificar el nuevo comprobante');
		$('comprobante_nuevo').focus();
	}
	else {
		new Request({
			'url': 'DepositosCometra.php',
			'data': 'accion=actComprobante&' + $('Datos').toQueryString(),
			'onRequest': function() {
				$('captura').empty();
				
				new Element('img', {
					'src': 'imagenes/_loading.gif'
				}).inject($('captura'));
				
				new Element('span', {
					'text': ' Actualizando comprobante...'
				}).inject($('captura'));
			},
			'onSuccess': function(result) {
				Listado(result);
			},
			'onFailure': function(xhr) {
				alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
			}
		}).send();
	}
}

var ModificarDepositos = function(comprobante) {
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=modDepositos&comprobante=' + comprobante,
		'onRequest': function() {
			$('captura').empty();
			
			new Element('img', {
				'src': 'imagenes/_loading.gif'
			}).inject($('captura'));
			
			new Element('span', {
				'text': ' Obteniendo depositos...'
			}).inject($('captura'));
		},
		'onSuccess': function(result) {
			$('captura').set('html', result);
			
			new FormValidator($('Datos'), {
				showErrors: true,
				selectOnFocus: true
			});
			
			new FormStyles($('Datos'));
			
			$$('input[id=num_cia]').each(function(el, i) {
				el.addEvents({
					'change': cambiaCia.pass([el, $$('input[id=nombre_cia]')[i], $$('input[id=cod_mov]')[i], i]),
					'keydown': function(e) {
						if (e.key == 'enter') {
							e.stop();
							
							if (el.get('value').getNumericValue() > 0) {
								$$('input[id=cod_mov]')[i].select();
							}
							else {
								alert('Debe especificar la compa��a');
							}
						}
					}
				});
			});
			
			$$('input[id=cod_mov]').each(function(el, i) {
				el.addEvents({
					'change': cambiaCod.pass([$$('input[id=num_cia]')[i], el, $$('input[id=descripcion]')[i], $$('input[id=importe]')[i]]),
					'keydown': function(e) {
						if (e.key == 'enter') {
							e.stop();
							
							if (!$chk(el.get('value'))) {
								if ($$('input[id=num_cia]')[i].get('value').getNumericValue() <= 300
									|| $$('input[id=num_cia]')[i].get('value').getNumericValue() >= 900
									|| ($$('input[id=num_cia]')[i].get('value').getNumericValue() >= 600 && $$('input[id=num_cia]')[i].get('value').getNumericValue() <= 699)) {
									el.set('value', 1);
								}
								else {
									el.set('value', 16);
								}
								
								el.fireEvent('change');
							}
							
							$$('input[id=fecha]')[i].select();
						}
					}
				});
			});
			
			$$('input[id=fecha]').each(function(el, i) {
				el.addEvents({
					'change': validarFecha.pass(el),
					'keydown': function(e) {
						if (e.key == 'enter') {
							e.stop();
							
							if (!$chk(el.get('value')) && i > 0) {
								el.set('value', $$('input[id=fecha]')[i - 1].get('value'));
							}
							
							$$('input[id=concepto]')[i].select();
						}
					}
				});
			});
			
			$$('input[id=concepto]').each(function(el, i) {
				el.addEvents({
					'keydown': function(e) {
						if (e.key == 'enter') {
							e.stop();
							
							$$('input[id=importe]')[i].select();
						}
					}
				});
			});
			
			$$('input[id=importe]').each(function(el, i) {
				el.setStyle('color', ['19', '48'].contains($$('input[id=cod_mov]')[i].get('value')) ? '#C00' : '#00C');
				
				el.addEvents({
					'change': actualizaTotal,
					'keydown': function(e) {
						if (e.key == 'enter') {
							e.stop();
							
							if ($defined($$('input[id=num_cia]')[i + 1])) {
								$$('input[id=num_cia]')[i + 1].select();
							}
							else {
								$$('input[id=num_cia]')[0].select();
							}
						}
					}
				});
			});
			
			$('cancelar').addEvent('click', Listado.pass(comprobante));
			$('actualizar').addEvent('click', ActualizarDepositos);
			
			cias = $$('input[id=num_cia]').get('value').getNumericValue().filter(function(value, i) {
				return value > 0;
			});
			
			new Request({
				'url': 'DepositosCometra.php',
				'data': 'accion=obtenerCia&num_cia=' + $$('input[id=num_cia]')[0].get('value') + '&primaria=true' + (cias.length > 0 ? '&cias=' + cias.join(',') : ''),
				'onSuccess': function(result) {
					var data = JSON.decode(result);
					
					homoclaves.empty();
					
					homoclaves.extend(data.homoclaves);
				},
				'onFailure': function(xhr) {
					alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
				}
			}).send();
			
			/*
			@ FIX: Mover scroll hasta el principio de la p�gina cuando el tama�o del scroll de la p�gina no se auto-ajusta
			*/
			window.scrollTo(0, 0);
			
			$$('input[id=num_cia]').filter(function(el, i) {
				return !$chk(el.get('value'));
			})[0].select();
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var cambiaCia = function() {
	var num_cia = arguments[0],
		nombre_cia = arguments[1],
		cod_mov = arguments[2],
		index = arguments[3],
		cias = $$('input[id=num_cia]').get('value').getNumericValue().filter(function(value) {
			return value > 0;
		});
	
	if ($chk(num_cia.get('value'))) {
		new Request({
			'url': 'DepositosCometra.php',
			'data': 'accion=obtenerCia&num_cia=' + num_cia.get('value') + (index == 0 ? '&primaria=true' : '') + (cias.length > 0 ? '&cias=' + cias.join(',') : ''),
			'onSuccess': function(result) {
				if (result == '-1') {
					alert('La compa��a no se encuentra en el cat�logo');
					num_cia.set('value', num_cia.retrieve('tmp', ''));
					num_cia.select();
				}
				else {
					var data = JSON.decode(result);
					
					if ($defined(data.homoclaves)
						&& homoclaves.length > 0
						&& !homoclaves.contains(num_cia.get('value'))
						&& confirm('Al cambiar la primera compa��a cambiaran todas las homoclaves y tendra que capturar todo de nuevo. �Desea continuar?')) {
						
						var num_cia_value = num_cia.get('value');
						
						$$('input.valid', 'input[id=nombre_cia]', 'input[id=descripcion]').set('value', '');
						
						homoclaves.empty();
						
						homoclaves.extend(data.homoclaves);
						
						num_cia.set('value', num_cia_value);
						nombre_cia.set('value', data.nombre_cia);
					}
					else if (homoclaves.contains(num_cia.get('value'))) {
						nombre_cia.set('value', data.nombre_cia);
					}
					else {
						alert('La compa��a debe estar dentro de las siguientes claves:\n\n' + homoclaves.join(', '));
						num_cia.set('value', num_cia.retrieve('tmp', ''));
						num_cia.select();
					}
				}
			},
			'onFailure': function(xhr) {
				alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
			}
		}).send();
	}
	else {
		if (index == 0 && confirm('Al borrar la primera compa��a se borraran todas las homoclaves y tendra que capturar todo de nuevo. �Desea continuar?')) {
			$$('input.valid', 'input[id=nombre_cia]', 'input[id=descripcion]').set('value', '');
			
			actualizaTotal();
		}
		else if (index > 0 && confirm('Al borrar la compa��a se borrara todo el registro. �Desea continuar?')) {
			num_cia.set('value', '');
			nombre_cia.set('value', '');
		}
	}
}

var cambiaCod = function() {
	var num_cia = arguments[0]
		cod_mov = arguments[1],
		descripcion = arguments[2],
		importe = arguments[3];
	
	if ($chk(num_cia.get('value'))) {
		switch (cod_mov.get('value')) {
			case '1':
				if (!(num_cia.get('value').getNumericValue() <= 300
					|| num_cia.get('value').getNumericValue() >= 900
					|| (num_cia.get('value').getNumericValue() >= 600 && num_cia.get('value').getNumericValue() <= 699))) {
					alert('El c�digo 1 es solo para panader�as, zapater�as e inmobiliarias');
					cod_mov.set('value', cod_mov.retrieve('tmp', ''));
					cod_mov.select();
				}
				else {
					descripcion.set('value', num_cia.get('value').getNumericValue() <= 300 ? 'PAN' : (num_cia.get('value').getNumericValue() < 900 ? 'INMOBILIARIA' : 'ZAPATERIA'));
				}
			break;
			
			case '16':
				if (num_cia.get('value').getNumericValue() <= 300
					|| num_cia.get('value').getNumericValue() >= 900
					|| (num_cia.get('value').getNumericValue() >= 600 && num_cia.get('value').getNumericValue() <= 699)) {
					alert('El c�digo 16 es solo para rosticer�as');
					cod_mov.set('value', cod_mov.retrieve('tmp', ''));
					cod_mov.select();
				}
				else {
					descripcion.set('value', 'POLLOS');
				}
			break;
			
			case '2':
				descripcion.set('value', 'RENTA');
			break;
			
			case '7':
				descripcion.set('value', 'PAGO FALT.');
			break;
			
			case '13':
				descripcion.set('value', 'SOBRANTE');
			break;
			
			case '19':
				descripcion.set('value', 'FALTANTE');
			break;
			
			case '48':
				descripcion.set('value', 'FALSO');
			break;
			
			case '99':
				descripcion.set('value', 'CHEQUE');
			break;

			case '21':
				descripcion.set('value', 'CANC. DEP.');
			break;
			
			default:
				alert('El c�digo debe estar dentro de los siguientes valores:\n\n[ 1] PAN, ZAPATERIA � INMOBILIRIA\n[16] POLLOS\n[13] SOBRANTE\n[19] FALTANTE\n[48] FALSO\n[99] CHEQUE\n[21] CANCELACION DE DEPOSITO');
				cod_mov.set('value', cod_mov.retrieve('tmp', ''));
				cod_mov.select();
		}
	}
	else {
		descripcion.set('value', '');
	}
	
	importe.setStyle('color', ['19', '48'].contains(cod_mov.get('value')) ? '#C00' : '#00C');
	actualizaTotal();
}

var validarFecha = function() {
	var fecha = arguments[0];
	
	if ($chk(fecha.get('value'))) {
		new Request({
			'url': 'DepositosCometra.php',
			'data': 'accion=validarFecha&fecha=' + fecha.get('value'),
			'onSuccess': function(result) {
				if (result == '-1') {
					alert('La fecha no puede ser mayor al d�a de hoy ni menor a hace 15 d�as');
					fecha.set('value', fecha.retrieve('tmp', ''));
					fecha.select();
				}
			},
			'onFailure': function(xhr) {
				alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
			}
		}).send();
	}
	else {
		fecha.set('value', '');
	}
}

var actualizaTotal = function() {
	var total = 0;
	
	$$('input[id=importe]').each(function(el, i) {
		total += ['19', '48', '21'].contains($$('input[id=cod_mov]')[i].get('value')) ? -el.get('value').getNumericValue() : el.get('value').getNumericValue();
	});
	
	$('total').set('value', total.numberFormat(2, '.', ','));
}

var ActualizarDepositos = function() {
	var queryString = [];
	
	$('Datos').getElements('input').each(function(el) {
		if (!el.name || el.disabled || el.type == 'submit' || el.type == 'reset' || el.type == 'file') {
			return;
		}
		
		var value = (el.tagName.toLowerCase() == 'select') ? Element.getSelected(el).map(function(opt) {
			return opt.value;
		}) : ((el.type == 'radio' || el.type == 'checkbox') && !el.checked) ? null : el.value;
		
		$splat(value).each(function(val) {
			if (typeof val != 'undefined') {
				queryString.push(el.name + '=' + encodeURIComponent(val));
			}
		});
	});
	
	new Request({
		'url': 'DepositosCometra.php',
		'data': 'accion=actDepositos&' + queryString.join('&'),
		'onRequest': function() {
			$('captura').empty();
			
			new Element('img', {
				'src': 'imagenes/_loading.gif'
			}).inject($('captura'));
			
			new Element('span', {
				'text': ' Actualizando depositos...'
			}).inject($('captura'));
		},
		'onSuccess': function(result) {
			Listado(result)
		},
		'onFailure': function(xhr) {
			alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
		}
	}).send();
}

var BorrarDepositos = function(comprobante) {
	if (confirm('�Desea borrar el comprobante seleccionado?')) {
		new Request({
			'url': 'DepositosCometra.php',
			'data': 'accion=borrarDepositos&comprobante=' + comprobante,
			'onRequest': function() {
				$('captura').empty();
				
				new Element('img', {
					'src': 'imagenes/_loading.gif'
				}).inject($('captura'));
				
				new Element('span', {
					'text': ' Borrando depositos...'
				}).inject($('captura'));
			},
			'onSuccess': function(result) {
				Listado();
			},
			'onFailure': function() {
				alert('Error al sincronizar con el servidor, avisar al administrador\n\n' + xhr);
			}
		}).send();
	}
}
