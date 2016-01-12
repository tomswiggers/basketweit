(function( $ ){
	$.fn.hasAttr = function( name ){
   		return this.attr( name ) !== undefined;
	};

})( jQuery );


var mythemes_ahtml = {

	/* UPLOADER */
	uploader : function( selector ){

		jQuery(document).ready(function(){
	        
        	var custom_uploader;

        
        	if( custom_uploader ){
            	custom_uploader.open();
            	return;
        	}

        	custom_uploader = wp.media({
            	title: 'Choose Image',
            	button: {
                	text: 'Choose Image'
            	},
            	multiple: false
        	});

        	custom_uploader.on( 'select', function() {
            	var attachment = custom_uploader.state().get('selection').first().toJSON();
            	var post_id = parseInt( jQuery('#post_ID' ).val() );
            
            	if( post_id > 0 ){
                	jQuery.post( ajaxurl, {
                        action: 'attach_to_post',
                        attachment_id: attachment.id,
                        post_id: post_id
                	}).done( function( result ) {
                        console.log( result );
                	});
            	}
                            
            	jQuery( selector ).parent().children( 'input[type="url"]' ).val( attachment.url );
        	});

        	custom_uploader.open();
        });
	},

	in_array : function( key, array ){

    	var i = array.length;
    	while( i-- ){
        	if ( array[ i ] === key ) {
            	return true;
        	}
    	}
    	return false;
	},

	/* IS SELECTED */
	is_selected : function( selector, args ){

		var self 	= this;

		jQuery(document).ready(function(){

			var show 	= [];
	        var hide 	= [];

	        jQuery( selector ).find( 'option' ).each(function(){
	            if( jQuery( this ).is(':selected') ){
	                var val = jQuery( this ).val().trim();

	                if( args.hasOwnProperty( 'show' ) ){
	                	show = args.show;
	                }

	                if( args.hasOwnProperty( 'hide' ) ){
	                	hide = args.hide;
	                }

	                for ( var key in args ) {

	                    if( key == val ){
	                        if( args[ key ].hasOwnProperty( 'show' ) ){
	                            for( var i = 0; i < args[ key ].show.length; i++ ){
	                            	if( !self.in_array( args[ key ].show[ i ], show ) ){
	                            		show[ show.length ] = args[ key ].show[ i ];
	                            	}
	                            	if( self.in_array( args[ key ].show[ i ], hide ) ){
	                            		hide.splice( hide.indexOf( args[ key ].show[ i ] ) , 1 );
	                            	}
	                            }
	                        }
	                        if( args[ key ].hasOwnProperty( 'hide' ) ){
	                            for( var i = 0; i < args[ key ].hide.length; i++ ){
	                            	if( !self.in_array( args[ key ].hide[ i ], hide ) ){
	                            		hide[ hide.length ] = args[ key ].hide[ i ];
	                            	}
	                            	if( self.in_array( args[ key ].hide[ i ], show ) ){
	                            		show.splice( show.indexOf( args[ key ].hide[ i ] ) , 1 );
	                            	}
	                            }
	                        }
	                        if( !args[ key ].hasOwnProperty( 'show' ) && !args[ key ].hasOwnProperty( 'hide' ) ){
	                            for( var i = 0; i < args[ key ].length; i++ ){
	                            	if( !self.in_array( args[ key ][ i ], show ) ){
	                            		show[ show.length ] = args[ key ][ i ];
	                            	}
	                            	if( self.in_array( args[ key ][ i ], hide ) ){
	                            		hide.splice( hide.indexOf( args[ key ][ i ] ) , 1 );
	                            	}
	                            }
	                        }
	                    }
	                    else{
	                        if( args[ key ].hasOwnProperty( 'hide' ) ){
	                            for( var i = 0; i < args[ key ].hide.length; i++ ){
	                            	if( !self.in_array( args[ key ].hide[ i ], show ) ){
	                            		hide[ hide.length ] = args[ key ].hide[ i ];
	                            	}
	                            }
	                        }
	                    }
	                }
	            }
	        });

			if( hide.length ){
				jQuery( hide.toString() ).hide( 'slow' );
			}

			if( show.length ){
				jQuery( show.toString() ).show( 'slow' );
			}
		});
	}
};

jQuery(document).ready(function(){
	
	/* LOGIC */
	jQuery( '.mythemes-input-logic' ).click(function(){
		if( jQuery( this ).hasClass( 'is-on' ) ){
			jQuery( this ).removeClass( 'is-on' );
			jQuery( this ).addClass( 'is-off' );

			if( jQuery( this ).hasAttr( 'data-action' ) ){
				jQuery( jQuery( this ).attr( 'data-action' ) ).hide( 'slow' );
			}

			jQuery( this ).find( 'input' ).val( 0 );
		}
		else{
			jQuery( this ).removeClass( 'is-off' );
			jQuery( this ).addClass( 'is-on' );

			if( jQuery( this ).hasAttr( 'data-action' ) ){
				jQuery( jQuery( this ).attr( 'data-action' ) ).show( 'slow' );
			}

			jQuery( this ).find( 'input' ).val( 1 );
		}
	});

	/* IMAGE SELECT */
	jQuery( '.mythemes-input-image-select' ).each(function(){
		var self 	= this;

		jQuery( self ).find( '.mythemes-image-select-option' ).click(function(){
			var value = jQuery( this ).find( 'img' ).attr( 'data-value' );
			var src = jQuery( this ).find( 'img' ).attr( 'src' );

			jQuery( self ).find( '.mythemes-image-select-option' ).removeClass( 'selected' );
			jQuery( this ).addClass( 'selected' );
			jQuery( self ).find( '.mythemes-image-select-value img' ).attr( 'src' , src );
			jQuery( self ).find( '.mythemes-image-select-value img' ).attr( 'data-value' , value );
			jQuery( self ).find( 'input[type="hidden"]' ).val( value );

			var show 	= [];
			var hide    = [];

			if( jQuery( this ).find( 'img' ).hasAttr( 'data-action' ) ){
				show = jQuery( this ).find('img').attr( 'data-action' ).toString().split(',');
			}

			jQuery( self ).find( '.mythemes-image-select-option' ).each(function(){

				if( jQuery( this ).find( 'img' ).hasAttr( 'data-action' ) ){
					var array = jQuery( this ).find('img').attr( 'data-action' ).toString().split(',');

					for( var i = 0; i < array.length; i++ ){
						if( !mythemes_ahtml.in_array( array[ i ] , show ) ){
							hide[ hide.length ] = array[ i ];
						}
					}
				}
			});

			if( hide.length ){
				jQuery( hide.toString() ).hide( 'slow' );
			}
			
			if( show.length ){
				jQuery( show.toString() ).show( 'slow' );
			}
		});
	});

	/* COLOR */
    jQuery('input.mythemes-pickcolor').wpColorPicker();
});