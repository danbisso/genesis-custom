
// Look for menu
var toggle = document.querySelector( '#nav-primary-toggle' );
var body = document.body;

// On click
toggle.addEventListener( 'click' , function() {

	body.classList.toggle( 'menu-open' );
});

// On resize
window.addEventListener( 'resize', function() {

	var toggleDisplayValue = window.getComputedStyle( toggle ).getPropertyValue( 'display' );

	if ( 'none' == toggleDisplayValue ) {// toggle is disabled

		return;

	}else if( body.classList.contains( 'menu-open' ) ){

		body.classList.remove( 'menu-open' );
	}
});


// Handle dropdown links
var dropdown_links = document.querySelectorAll( '.nav-primary .menu-item-has-children > a' );

dropdown_links.forEach(function(dropdown_link) {
    dropdown_link.addEventListener( 'click', function(event){

    	event.preventDefault();

    	dropdown_link.parentElement.classList.toggle( 'open' );
    });
});




