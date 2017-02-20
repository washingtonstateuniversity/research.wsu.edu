( function( $, window, document ) {

	/**
	 * Check if the element to be animated is in the viewport.
	 */
	function inViewport( element ) {
		var rect = element[ 0 ].getBoundingClientRect();

		return rect.top >= 0 && rect.bottom <= window.innerHeight;
	}

	/**
	 * When an element to be animated is in the viewport, remove the `animate`
	 * class from it and add the `animated` class to its list items at short intervals.
	 */
	var $elementsToAnimate = $( ".animate" );

	$elementsToAnimate.each( function() {
		var $element = $( this ),
			bars = this.getElementsByTagName( "animate" );

		$( document ).on( "scroll", function() {
			if ( !inViewport( $element ) || $element.hasClass( "animated" ) ) {
				return;
			}

			for ( var i = 0; i < bars.length; i++ ) {
				bars[ i ].beginElement();
			}

			$element.addClass( "animated" );
		} );
	} );
}( jQuery, window, document ) );
