/**
 * Theme Name: Panna Wild Tours
 * Description: Child theme frontend behavior for the Panna Wild Tour plugin.
 * Version: 2.0.3
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		// Smooth-scroll in-page anchors (safari/pricing, faq, booking).
		var anchors = document.querySelectorAll('a[href^="#"]');

		anchors.forEach(function (anchor) {
			anchor.addEventListener('click', function (event) {
				var id = anchor.getAttribute('href');

				if (!id || id.length < 2) {
					return;
				}

				var target = document.getElementById(id.substring(1));

				if (!target) {
					return;
				}

				event.preventDefault();

				window.scrollTo({
					top: target.getBoundingClientRect().top + window.scrollY - 90,
					behavior: 'smooth'
				});
			});
		});
	});
})();
