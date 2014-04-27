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
			var qryStr = '', existingData = $(r.img).data();

			params = $.extend({}, existingData, params);

			$.each(params, function (key, param) {
				qryStr += key + '=' + encodeURIComponent(param) + '&';
			});
			return qryStr.slice(0, qryStr.length - 1);
		},
		now: function () {
			return new Date().getTime();
		},
		listenToClick: function () {
			var tinyMCEEventAttached = false,
				interval = setInterval(function () {
				if (tinyMCE && tinyMCE.activeEditor && !tinyMCEEventAttached) {
					tinyMCE.activeEditor.onClick.add(function(editor, ev) {
					    var blob = {
							elementSelector: '(editor)' + r.elementToSelector(ev.target),
							clientX: ev.clientX,
							clientY: ev.clientY,
							timestamp: ev.timestamp || ev.timeStamp || r.now(),
							url: window.location.href
						};
						r.sendToServer(blob);
					});
					tinyMCEEventAttached = true;
					clearInterval(interval); // We're done here, we don't need to repeat this any more.
					console.log('Here');
				}
			}, 500); // If you access the tinyMCE var too early, it will crash the whole scope... however if we pus it to the end of the exec stack, it's ok... silly, but effective.
			$(document).on('click', function (ev) {
				var blob = {
					elementSelector: r.elementToSelector(ev.target),
					clientX: ev.clientX,
					clientY: ev.clientY,
					timestamp: ev.timestamp || ev.timeStamp || r.now(),
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
	return u;
}(jQuery));

(function($) {
   Obsession.initialize();
})(jQuery);
