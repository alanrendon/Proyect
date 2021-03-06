// JavaScript Document

window.addEvent('domready', function() {
	$('cerrar').addEvent('click', function() {
		self.close();
	});
	
	if ($defined($('row'))) {
		$$('tr[id=row]').each(function(el, i) {
			el.addEvents({
				'mouseover': function() {
					this.addClass('over');
				},
				'mouseout': function() {
					this.removeClass('over');
				}
			});
		});

		$$('.info').filter(function(el) { return el.get("text").trim() != ''; }).each(function(el, i) {
			el.store('tip:title', '<img src="imagenes/info.png" /> Informaci&oacute;n');
			el.store('tip:text', el.get('title'));
			
			el.addEvents({
				'mouseover': function() {
					this.setStyle('cursor', 'pointer');
				},
				'mouseout': function() {
					this.setStyle('cursor', 'default');
				}
			});
		});
		
		tips = new Tips($$('.info').filter(function(el) { return el.get("text").trim() != ''; }), {
			'fixed': true,
			'className': 'Tip',
			'showDelay': 50,
			'hideDelay': 50
		});
	}
});
