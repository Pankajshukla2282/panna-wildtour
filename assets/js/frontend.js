/**
 * Panna Wild Tours site-specific frontend behavior.
 * Generic menu/search behavior belongs to the base theme.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var anchors = document.querySelectorAll('a[href^="#"]');

        anchors.forEach(function (anchor) {
            anchor.addEventListener('click', function (event) {
                var id = anchor.getAttribute('href');
                if (!id || id.length < 2) return;

                var target = document.getElementById(id.substring(1));
                if (!target) return;

                event.preventDefault();
                window.scrollTo({
                    top: target.getBoundingClientRect().top + window.scrollY - 90,
                    behavior: 'smooth'
                });
            });
        });
    });
})();
