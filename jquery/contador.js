/* ---------------------------------------------------------------------- */
/* Contador
/* ---------------------------------------------------------------------- */
(function($, undefined) {
	'use strict';

	$(function() {
		$('.contador').each(function() {
			var days = $('.dias .conta', this);
			var hours = $('.horas .conta', this);
			var minutes = $('.minutos .conta', this);
			var seconds = $('.segundos .conta', this);

			var until = parseInt($(this).data('until'), 10);
			var done = $(this).data('done');

			var self = $(this);

			var updateTime = function() {
				var now = Math.round( (+new Date())  / 1000);

				if(until <= now) {
					clearInterval(interval);
					self.html($('<span />').addClass('done block').html($('<span />').addClass('conta').text(done)));
					return;
				}

				var left = until-now;

				seconds.text(left%60);

				left = Math.floor(left/60);
				minutes.text(left%60);

				left = Math.floor(left/60);
				hours.text(left%24);

				left = Math.floor(left/24);
				days.text(left);
			};

			var interval = setInterval(updateTime, 1000);
		});
	});
})(jQuery);

