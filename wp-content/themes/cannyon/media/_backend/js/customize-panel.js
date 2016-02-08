;(function( $ ){
    $.fn.hasAttr = function( name ){
        return this.attr( name ) !== undefined;
    };

})( jQuery );

jQuery(document).ready(function(){


	if( typeof mythemes_customize_panel == 'object' && typeof mythemes_customize_panel.hasOwnProperty( 'premium_url' ) ){
	    if( jQuery( 'div#customize-theme-controls li#accordion-section-themes' ).length ){
	        jQuery( 'div#customize-theme-controls li#accordion-section-themes' ).append(
	            '<a href="' + mythemes_customize_panel.premium_url + '" target="_blank" class="mythemes-button mythemes-submit-options">' +
	            '<i class="mythemes-icon-publish"></i>Upgrade to Premium' +
	            '<small>compatible with free version</small>' +
	            '</a>'
	        );
	    }
	}

    //- RANGER'S -//
    if( typeof mythemes_customize_panel == 'object' && typeof mythemes_customize_panel.hasOwnProperty( 'range_reset_label' ) ){
	    if( jQuery( 'li.customize-control.customize-control-range' ).length ){
	    	jQuery( 'li.customize-control.customize-control-range' ).each(function(i){
	            var self    = jQuery( this );
	    		var input   = jQuery( this ).find( 'input' );
	    		var label   = jQuery( this ).find( 'span.customize-control-title' );

	            var unit    = '';

	            if( input.hasAttr( 'data-unit' ) ){
	                unit = ' ' + input.attr( 'data-unit' );
	            }

	            if( input.hasAttr( 'data-deff' ) ){
	                var deff = input.attr( 'data-deff' );
	            }

	    		if( label.find( 'span.mythemes-range-counter' ).length ){
	    			label.find( 'span.mythemes-range-counter span.counter' ).html( input.val().toString() );
	    		}
	    		else{
	    			label.append( '<span class="mythemes-range-counter"><span class="counter">' + input.val().toString() + '</span>' + unit + '</span>' );
	    		}

	    		input.change(function(){
	    			label.find( 'span.mythemes-range-counter span.counter' ).html( jQuery( this ).val().toString() );
	    		});

	            if( typeof deff !== "undefined" ){
	                var hint = jQuery( '<a href="javascript:void(null);" class="hint">' + mythemes_customize_panel.range_reset_label + '</a>' );
	                hint.click(function(){
	                    input.val( deff );
	                    label.find( 'span.counter' ).html( deff.toString() );
	                    input.trigger( "change" );
	                });

	                hint.appendTo( self );
	            }
	    	});
	    }
	}
});