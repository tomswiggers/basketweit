function lg( params ){
	console.log( params );
}

function mythemes_hex2rgb( hex )
{
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );
    var colors = result ? {
        r: parseInt( result[1], 16 ),
        g: parseInt( result[2], 16 ),
        b: parseInt( result[3], 16 )
    } : null;

    var rett = '';

    if( colors.hasOwnProperty( 'r' ) ){
    	rett += colors.r + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'g' ) ){
    	rett += colors.g + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'b' ) ){
    	rett += colors.b;
    }
    else{
    	rett += '255';	
    }

    return rett;
}

function mythemes_brightness( hex, steps )
{
    var steps 	= Math.max( -255, Math.min( 255, steps ) );
    var hex 	= hex.toString().replace( /#/g, "" );

    if ( hex.length == 3 ) {
        hex = 
        hex.substring( 0, 1 ) + hex.substring( 0, 1 ) +
        hex.substring( 1, 2 ) + hex.substring( 1, 2 ) +
        hex.substring( 2, 3 ) + hex.substring( 2, 3 );
    }

    var r = parseInt( hex.substring( 0, 2 ).toString() , 16 );
    var g = parseInt( hex.substring( 2, 4 ).toString() , 16 );
    var b = parseInt( hex.substring( 4, 6 ).toString() , 16 );

    r = Math.max( 0, Math.min( 255, r + steps ) ).toString(16).toUpperCase();
    g = Math.max( 0, Math.min( 255, g + steps ) ).toString(16).toUpperCase();  
    b = Math.max( 0, Math.min( 255, b + steps ) ).toString(16).toUpperCase();

	var r_hex = Array( 3 - r.length ).join( '0' ) + r;
	var g_hex = Array( 3 - g.length ).join( '0' ) + g;
	var b_hex = Array( 3 - b.length ).join( '0' ) + b;

    return '#' + r_hex + g_hex + b_hex;
}


(function($){

    //- SITE COLOR -//
    //- COLOR 1 -//
    wp.customize( 'mythemes-color-1' , function( value ){
        value.bind(function( newval ){
            jQuery( 'style#mythemes-color-1' ).html(
                'article a.more-link,' +
                'body.single section div.post-meta-tags span,' +
                'body.single section div.post-meta-tags a:hover,' +
                'div.pagination nav a:hover,' +
                'div.mythemes-paged-post > a:hover > span,' +
                'div.error-404-search button,' +
                'div.comments-list div.mythemes-comments > ol li.comment header span.comment-meta span.comment-replay a:hover,' +
                'div.comment-respond h3.comment-reply-title small a,' +
                '.mythemes-button.second,' +
                '.header-button-wrapper a.btn.first-btn.header-button,' +
                'div.mythemes-topper div.mythemes-header-antet button.btn-collapse,' +
                'div.widget_search button[type="submit"],' +
                'div.widget_post_tags div.tagcloud a:hover,' +
                'div.widget_tag_cloud div.tagcloud a:hover{' +
                'background-color: ' + newval + ';' +
                '}' +

                '@media ( min-width: 1025px ) {' +
                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li.current-menu-ancestor > a,' +
                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li.current-menu-item > a,' +
                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul:before,' +
                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul::before{' +
                'background-color: ' + newval + ';' +
                '}' +

                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul:after,' +
                'div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul::after{' +
                'border-color: ' + newval + ';' +
                '}' +
                '}' +

                '@media ( max-width: 1024px ){' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children span.menu-arrow:before,' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children span.menu-arrow::before{' +
                'background-color: ' + newval + ';' +
                '}' +
                '}' +

                'div.widget_post_tags div.tagcloud a,' +
                'div.widget_tag_cloud div.tagcloud a{' +
                'border-color: ' + newval + ';' +
                '}' +

                'a:hover,' +
                'div.widget_post_tags div.tagcloud a,' +
                'div.widget_tag_cloud div.tagcloud a{' +
                'color: ' + newval + ';' +
                '}'
            );
        });
    });

    //- COLOR 2 -//
    wp.customize( 'mythemes-color-2' , function( value ){
        value.bind(function( newval ){
            jQuery( 'style#mythemes-color-2' ).html(
                'article a.more-link:hover,' +
                'body.single section div.post-meta-tags span:hover,' +
                'body.single section div.post-meta-tags a,' +
                'div.error-404-search button:hover,' +
                'div.comments-list div.mythemes-comments > ol li.comment header span.comment-meta span.comment-replay a,' +
                'div.comment-respond h3.comment-reply-title small a:hover,' +
                '.mythemes-button.second:hover,' +
                '.header-button-wrapper a.btn.first-btn.header-button:hover,' +
                'div.mythemes-topper div.mythemes-header-antet button.btn-collapse:focus,' +
                'div.mythemes-topper div.mythemes-header-antet button.btn-collapse:hover,' +

                'div.widget_search button[type="submit"]:hover,' +
                'div.widget_calendar table th,' +
                'footer aside div.widget_calendar table th{' +
                'background-color: ' + newval + ';' +
                '}' +

                '@media ( max-width: 1024px ) {' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children:hover > span.menu-arrow:before,' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children:hover > span.menu-arrow::before,' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children.collapsed > span.menu-arrow:before,' +
                'div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children.collapsed > span.menu-arrow::before {' +
                'background-color: ' + newval + ';' +
                '}' +
                '}' +

                'a,' +
                'div.widget a:hover,' +
                'div.widget_rss ul li a.rsswidget:hover{' +
                'color: ' + newval + ';' +
                '}'
            );
        });
    });


    //- SITE IDENTITY -//
    wp.customize( 'blogname' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( 'div.mythemes-header-antet a.mythemes-blog-title' ).html( newval );
            }
        });
    });

    wp.customize( 'description' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( 'div.mythemes-header-antet a.mythemes-blog-description' ).html( newval );
            }
        });
    });

    wp.customize( 'mythemes-logo' , function( value ){
        value.bind(function( newval ){

        	if( newval.length ){
        		if( jQuery( 'div.mythemes-header-antet a.mythemes-logo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-header-antet a.mythemes-logo' ).removeClass( 'hidden' );
        		}

        		if( jQuery( 'div.mythemes-header-antet a.mythemes-logo img' ).length ){
        			jQuery( 'div.mythemes-header-antet a.mythemes-logo img' ).attr( 'src' , newval );	
        		}
        		else{
        			jQuery( '<img src="' + newval + '"/>' ).appendTo( 'div.mythemes-header-antet a.mythemes-logo' );
        		}

                if( !jQuery( 'div.mythemes-header-antet a.mythemes-blog-title' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-header-antet a.mythemes-blog-title' ).addClass( 'hidden' );    
                }

                if( !jQuery( 'div.mythemes-header-antet a.mythemes-blog-description' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-header-antet a.mythemes-blog-description' ).addClass( 'hidden' );
                }
        		
        	}
        	else{
				if( !jQuery( 'div.mythemes-header-antet a.mythemes-logo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-header-antet a.mythemes-logo' ).addClass( 'hidden' );
        		}

                if( jQuery( 'div.mythemes-header-antet a.mythemes-blog-title' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-header-antet a.mythemes-blog-title' ).removeClass( 'hidden' );    
                }

                if( jQuery( 'div.mythemes-header-antet a.mythemes-blog-description' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.mythemes-header-antet a.mythemes-blog-description' ).removeClass( 'hidden' );
                }
        	}
        });
    });


    /* HEADER */
    wp.customize( 'mythemes-header-height' , function( value ){
        value.bind(function( newval ){
            jQuery( 'div.mythemes-header.parallax-container' ).css( 'height' , parseInt( newval ).toString() + 'px' );
        });
    });

    wp.customize( 'mythemes-header-background-color' , function( value ){
        value.bind(function( newval ){
            jQuery( 'body' ).css( 'background-color' , newval );
            jQuery( 'body' ).css( 'backgroundColor' , newval );
        });
    });

    wp.customize( 'mythemes-header-mask-color' , function( value ){
        value.bind(function( newval ){
            var opacity = parseFloat( wp.customize.instance( 'mythemes-header-mask-opacity' ).get() / 100 ).toString();
            jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( newval ) + ' , ' + opacity + ')' );
        });
    });

    wp.customize( 'mythemes-header-mask-opacity' , function( value ){
        value.bind(function( newval ){
            var opacity = parseFloat( newval / 100 ).toString();
            var color   = wp.customize.instance( 'mythemes-header-mask-color' ).get().toString();
            jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( color ) + ' , ' + opacity + ')' );
        });
    });

    /* CONTENT */
    wp.customize( 'mythemes-header-title-label' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( '.mythemes-header a.header-title' ).html( newval );
            }
        });
    });

    wp.customize( 'mythemes-header-title-color' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( 'style#mythemes-header-title-color').html(
                    'div.mythemes-header a.header-title{' +
                    'color: ' + newval + ';' +
                    '}'
                );
            }
        });
    });

    wp.customize( 'mythemes-header-description-color' , function( value ){
        value.bind(function( newval ){
            if( newval ){

                var hex    = newval;
                var rgba1  = 'rgba( ' + mythemes_hex2rgb( hex ) + ', 0.75 )';
                var rgba2  = 'rgba( ' + mythemes_hex2rgb( hex ) + ', 1.0 )';

                jQuery( 'style#mythemes-header-description-color').html(
                    'div.mythemes-header a.header-description{' +
                    'color: ' + rgba1 + ';' +
                    '}' +

                    'div.mythemes-header a.header-description:hover{' +
                    'color: ' + rgba2 + ';' +
                    '}'
                );
            }
        });
    });

    wp.customize( 'mythemes-header-title' , function( value ){
        value.bind(function( newval ){
        	if( newval ){
        		if( jQuery( '.mythemes-header a.header-title' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-title' ).removeClass( 'hidden' );
        		}
        	}
        	else{
        		if( !jQuery( '.mythemes-header a.header-title' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-title' ).addClass( 'hidden' );
        		}	
        	}
        });
    });

    wp.customize( 'mythemes-header-description-label' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                jQuery( '.mythemes-header a.header-description' ).html( newval );
            }
        });
    });

    wp.customize( 'mythemes-header-description' , function( value ){
        value.bind(function( newval ){
        	if( newval ){
        		if( jQuery( '.mythemes-header a.header-description' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-description' ).removeClass( 'hidden' );
        		}
        	}
        	else{
        		if( !jQuery( '.mythemes-header a.header-description' ).hasClass( 'hidden' ) ){
        			jQuery( '.mythemes-header a.header-description' ).addClass( 'hidden' );
        		}	
        	}
        });
    });


    /* FIRST BUTTON */
    wp.customize( 'mythemes-first-btn' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                if( jQuery( 'div.header-button-wrapper a.first-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.first-btn' ).removeClass( 'hidden' );
                }
            }
            else{
                if( !jQuery( 'div.header-button-wrapper a.first-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.first-btn' ).addClass( 'hidden' );
                }   
            }
        });
    });
    
    wp.customize( 'mythemes-first-btn-url' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).attr( 'href' , newval );
        });
    });
    
    wp.customize( 'mythemes-first-btn-label' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).html( newval );
        });
    });
    
    wp.customize( 'mythemes-first-btn-description' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.first-btn' ).attr( 'title' , newval );
        });
    });

    //-  BACKGROUND COLOR -//
    wp.customize( 'mythemes-first-btn-bkg-color' , function( value ){
        value.bind(function( newval ){

            var hover   = wp.customize.instance( 'mythemes-first-btn-bkg-h-color' ).get().toString();
            var cnt     = '';

            if( newval.length ){
                cnt = '.header-button-wrapper a.btn.first-btn.header-button{' +
                'background-color: ' + newval + ';' +
                '}';
            }

            if( hover.length ){
                cnt += '.header-button-wrapper a.btn.first-btn.header-button:hover{' +
                'background-color: ' + hover + ';' +
                '}';
            }

            jQuery( 'style#mythemes-first-btn-bkg-color' ).html( cnt );
        });
    });

    wp.customize( 'mythemes-first-btn-bkg-h-color' , function( value ){
        value.bind(function( newval ){
            var color   = wp.customize.instance( 'mythemes-first-btn-bkg-color' ).get().toString();
            var cnt     = '';

            if( color.length ){
                cnt = '.header-button-wrapper a.btn.first-btn.header-button{' +
                'background-color: ' + color + ';' +
                '}';
            }

            if( newval.length ){
                cnt += '.header-button-wrapper a.btn.first-btn.header-button:hover{' +
                'background-color: ' + newval + ';' +
                '}';
            }

            jQuery( 'style#mythemes-first-btn-bkg-color' ).html( cnt );
        });
    });

    /* SECOND BUTTON */
    wp.customize( 'mythemes-second-btn' , function( value ){
        value.bind(function( newval ){
            if( newval ){
                if( jQuery( 'div.header-button-wrapper a.second-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.second-btn' ).removeClass( 'hidden' );
                }
            }
            else{
                if( !jQuery( 'div.header-button-wrapper a.second-btn' ).hasClass( 'hidden' ) ){
                    jQuery( 'div.header-button-wrapper a.second-btn' ).addClass( 'hidden' );
                }   
            }
        });
    });
    
    wp.customize( 'mythemes-second-btn-url' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).attr( 'href' , newval );
        });
    });
    
    wp.customize( 'mythemes-second-btn-label' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).html( newval );
        });
    });
    
    wp.customize( 'mythemes-second-btn-description' , function( value ){
        value.bind(function( newval ){
            jQuery( '.header-button-wrapper a.second-btn' ).attr( 'title' , newval );
        });
    });


    //- BACKGROUND COLOR -//
    wp.customize( 'mythemes-second-btn-bkg-color' , function( value ){
        value.bind(function( newval ){
            var hover = wp.customize.instance( 'mythemes-second-btn-bkg-h-color' ).get().toString();
            jQuery( 'style#mythemes-second-btn-bkg-color' ).html(
                '.header-button-wrapper a.btn.second-btn.header-button{' +
                'background-color: ' + newval + ';' +
                '}' +

                '.header-button-wrapper a.btn.second-btn.header-button:hover{' +
                'background-color: ' + hover + ';' +
                '}'
            );
        });
    });

    wp.customize( 'mythemes-second-btn-bkg-h-color' , function( value ){
        value.bind(function( newval ){
            var color = wp.customize.instance( 'mythemes-second-btn-bkg-color' ).get().toString();
            jQuery( 'style#mythemes-second-btn-bkg-color' ).html(
                '.header-button-wrapper a.btn.second-btn.header-button{' +
                'background-color: ' + color + ';' +
                '}' +

                '.header-button-wrapper a.btn.second-btn.header-button:hover{' +
                'background-color: ' + newval + ';' +
                '}'
            );
        });
    });


    /* BREADCRUMBS */
    wp.customize( 'mythemes-home-label' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header li#home-label a span' ).html( newval );
        });
    });

    wp.customize( 'mythemes-home-link-description' , function( value ){
        value.bind(function( newval ){
            jQuery( 'div.mythemes-page-header li#home-label a' ).attr( 'title' , newval );
        });
    });

    wp.customize( 'mythemes-breadcrumbs-space' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header' ).css({ 'padding-top' : newval + 'px' , 'padding-bottom' : newval + 'px' });
        });
    });


    /* ADDITIONAL */
    wp.customize( 'mythemes-blog-title' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-page-header h1#blog-title' ).html( newval );
        });
    });
    

    /* SOCIAL */
    wp.customize( 'mythemes-vimeo' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-vimeo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-vimeo' ).removeClass( 'hidden' );	
        		}
        		
        		jQuery( 'div.mythemes-social a.mythemes-icon-vimeo' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-vimeo' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-vimeo' ).addClass( 'hidden' );	
        		}
        	}
        });
    });

    wp.customize( 'mythemes-twitter' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-twitter' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-twitter' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-twitter' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-twitter' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-twitter' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-skype' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-skype' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-skype' ).removeClass( 'hidden' );	
        		}
        		
        		jQuery( 'div.mythemes-social a.mythemes-icon-skype' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-skype' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-skype' ).addClass( 'hidden' );	
        		}
        	}
        });
    });

    wp.customize( 'mythemes-renren' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-renren' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-renren' ).removeClass( 'hidden' );
        		}
        		
        		jQuery( 'div.mythemes-social a.mythemes-icon-renren' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-renren' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-renren' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-github' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-github' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-github' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-github' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-github' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-github' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-rdio' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-rdio' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-rdio' ).removeClass( 'hidden' );
        		}
        		
        		jQuery( 'div.mythemes-social a.mythemes-icon-rdio' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-rdio' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-rdio' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-linkedin' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-linkedin' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-linkedin' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-linkedin' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-linkedin' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-linkedin' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-behance' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-behance' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-behance' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-behance' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-behance' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-behance' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-dropbox' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-dropbox' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-dropbox' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-dropbox' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-dropbox' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-dropbox' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-flickr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-flickr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-flickr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-flickr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-flickr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-flickr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-tumblr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-tumblr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-tumblr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-tumblr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-tumblr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-tumblr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-instagram' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-instagram' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-instagram' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-instagram' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-instagram' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-instagram' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-vkontakte' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-vkontakte' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-vkontakte' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-vkontakte' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-vkontakte' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-vkontakte' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-facebook' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-facebook' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-facebook' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-facebook' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-facebook' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-facebook' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-evernote' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-evernote' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-evernote' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-evernote' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-evernote' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-evernote' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-flattr' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-flattr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-flattr' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-flattr' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-flattr' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-flattr' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-picasa' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-picasa' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-picasa' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-picasa' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-picasa' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-picasa' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-dribbble' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-dribbble' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-dribbble' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-dribbble' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-dribbble' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-dribbble' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-mixi' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-mixi' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-mixi' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-mixi' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-mixi' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-mixi' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-stumbleupon' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-stumbleupon' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-stumbleupon' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-stumbleupon' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-stumbleupon' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-stumbleupon' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-lastfm' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-lastfm' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-lastfm' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-lastfm' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-lastfm' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-lastfm' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-gplus' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-gplus' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-gplus' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-gplus' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-gplus' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-gplus' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-google-circles' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-google-circles' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-google-circles' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-google-circles' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-google-circles' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-google-circles' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-pinterest' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-pinterest' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-pinterest' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-pinterest' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-pinterest' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-pinterest' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-smashing' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-smashing' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-smashing' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-smashing' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-smashing' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-smashing' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-soundcloud' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-soundcloud' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-soundcloud' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-soundcloud' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-soundcloud' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-soundcloud' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    wp.customize( 'mythemes-rss' , function( value ){
        value.bind(function( newval ){
        	if( newval.length ){
        		if( jQuery( 'div.mythemes-social a.mythemes-icon-rss' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-rss' ).removeClass( 'hidden' );
        		}

        		jQuery( 'div.mythemes-social a.mythemes-icon-rss' ).attr( 'href' , newval );
        	}
        	else{
        		if( !jQuery( 'div.mythemes-social a.mythemes-icon-rss' ).hasClass( 'hidden' ) ){
        			jQuery( 'div.mythemes-social a.mythemes-icon-rss' ).addClass( 'hidden' );
        		}
        	}
        });
    });

    /* OTHERS */
    wp.customize( 'mythemes-copyright' , function( value ){
        value.bind(function( newval ){
        	jQuery( 'div.mythemes-copyright span.copyright' ).html( newval );
        });
    });

    /* COLORS */
    wp.customize( 'background_color' , function( value ){
        value.bind(function( newval ){

            var bg_color        = newval;
            var bg_color_rgba   = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.91 )';
            jQuery( 'style#mythemes-custom-style-background' ).html(

                /* BACKGROUND COLOR */
                'body div.content.main-content{' +
                'background-color: ' + bg_color + ';' +
                '}'
            );
        });
    });

    /* BACKGROUND IMAGE */
    wp.customize( 'background_image' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body div.content.main-content' ).css( 'background-image' , 'url(' + newval + ')' );
        });
    });

    wp.customize( 'background_repeat' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body div.content.main-content' ).css( 'background-repeat' , newval );
        });
    });

    wp.customize( 'background_position_x' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body div.content.main-content' ).css( 'background-position' , newval );
        });
    });

    wp.customize( 'background_attachment' , function( value ){
        value.bind(function( newval ){
            console.log( newval );
            jQuery( 'body div.content.main-content' ).css( 'background-attachment' , newval );
        });
    });

})(jQuery);