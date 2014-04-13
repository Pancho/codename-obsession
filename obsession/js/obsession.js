var Obsession = (function ($) {
	var r= {
		img: document.getElementById('obsession-img'),
		elementToSelector: function (jqElm) {
			var result = '', id = '', classes = '';

			jqElm = $(jqElm); // Get the first one
			if (!!jqElm) {
				result = jqElm.prop('tagName').toLowerCase();

				id = jqElm.attr('id');
				classes = jqElm.attr('class');

				if (!!id) {
					result += '#' + id
				}

				if (!!classes) {
					classes = classes.split(' ');
					result += '.' + classes.join('.');
				}
			}
			return result;
		},
		sendToServer: function (data) {
//			r.img.src = '?' + r.objectToQuery(data);
			console.log(data);
		},
		objectToQuery: function (params) {
			var qryStr = '';
			$.each(params, function (key, param) {
				qryStr += key + '=' + encodeURIComponent(param) + '&';
			});
			return qryStr.slice(0, qryStr.length - 1);
		},
		now: function () {
			return new Date().getTime();
		},
		listenToClick: function () {
			$(document).on('click', function (ev) {
				var blob = {
					elementSelector: r.elementToSelector(ev.target),
					clientX: ev.clientX,
					clientY: ev.clientY,
					timestamp: ev.timestamp,
					url: window.location.href
				};

				r.sendToServer(blob);
			});
		}
	}, u = {
		initialize: function () {
			r.listenToClick();
		}
	};
}(jQuery));

(function($) {
   Obsession.initialize();
})(jQuery);
