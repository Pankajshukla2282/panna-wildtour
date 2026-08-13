/**
 * Theme Name: Panna Wild Tours
 * Description: Child theme frontend behavior for the Panna Wild Tour plugin.
 * Version: 2.0.17
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

		/*
		 * On small screens, move the breadcrumb into the primary-navigation
		 * row so it shares the line with the compact search icon. This avoids
		 * a second full-width utility row and restores the breadcrumb to its
		 * original location when the viewport becomes desktop-sized.
		 */
		var breadcrumb = document.querySelector('body > #page > .breadcrumbs');
		var navigation = document.querySelector('#site-navigation');
		var search = navigation ? navigation.querySelector('.header-search') : null;
		var mobileBreakpoint = 960;
		var placeholder = null;

		function syncMobileBreadcrumb() {
			if (!breadcrumb || !navigation || !search) {
				return;
			}

			if (window.innerWidth <= mobileBreakpoint) {
				if (!placeholder) {
					placeholder = document.createComment('pwt-breadcrumb-placeholder');
					breadcrumb.parentNode.insertBefore(placeholder, breadcrumb);
				}

				if (!navigation.contains(breadcrumb)) {
					breadcrumb.classList.add('mobile-inline-breadcrumb');
					navigation.insertBefore(breadcrumb, search);
				}
			} else {
				if (placeholder && placeholder.parentNode && breadcrumb.parentNode !== placeholder.parentNode) {
					placeholder.parentNode.insertBefore(breadcrumb, placeholder.nextSibling);
				}
				breadcrumb.classList.remove('mobile-inline-breadcrumb');
			}
		}

		syncMobileBreadcrumb();
		window.addEventListener('resize', syncMobileBreadcrumb, { passive: true });
	});
})();
