( function() {
    var menuToggle = document.querySelector( '.menu-toggle' );
    var primaryMenu = document.querySelector( '.primary-menu' );

    if ( menuToggle && primaryMenu ) {
        menuToggle.addEventListener( 'click', function() {
            var expanded = this.getAttribute( 'aria-expanded' ) === 'true' || false;
            this.setAttribute( 'aria-expanded', ! expanded );
            primaryMenu.classList.toggle( 'active' );
        } );
    }
} )();
