( function( $, window, document ) {

	/**
	 * Check if the element to be animated is in the viewport.
	 */
	function inViewport( element ) {
		if ( element instanceof jQuery ) {
			element = element[ 0 ];
		}

		var rect = element.getBoundingClientRect();

		return rect.bottom > 0 &&
			rect.right > 0 &&
			rect.left < ( window.innerWidth || document.documentElement.clientWidth ) &&
			rect.top < ( window.innerHeight || document.documentElement.clientHeight );
	}

	/**
	 * When an element to be animated is scrolled into the viewport, remove the `animate`
	 * class from it and add the `animated` class to its list items at short intervals.
	 */
	function animateElement() {
		var $elementsToAnimate = $( ".animate" );

		$elementsToAnimate.each( function() {
			var $element = $( this );
			$( document ).on( "scroll", function() {
				if ( !inViewport( $element ) ) {
					return;
				}
				$element.addClass( "animated" );
			} );
		} );
	}

	/**
	 * Fire any actions that we need to happen once the document is ready.
	 */
	$( document ).ready( function() {
		animateElement();
	} );
}( jQuery, window, document ) );
