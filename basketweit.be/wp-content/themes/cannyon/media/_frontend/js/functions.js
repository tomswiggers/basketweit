/* PARALLAX */
;(function($){

    $.fn.parallax = function () {
        var window_width = $(window).width();
        // Parallax Scripts
        return this.each(function(i) {
            var $this = $(this);
            $this.addClass('parallax');

            function updateParallax(initial) {
                var container_height;
                if (window_width < 601) {
                    container_height = ($this.height() > 0) ? $this.height() : $this.children("img").height();
                }
                else {
                    container_height = ($this.height() > 0) ? $this.height() : 500;
                }

                var $img = $this.children("img").first();
                var img_height = $img.height();
                var parallax_dist = img_height - container_height;
                var bottom = $this.offset().top + container_height;
                var top = $this.offset().top;
                var scrollTop = $(window).scrollTop();
                var windowHeight = window.innerHeight;
                var windowBottom = scrollTop + windowHeight;
                var percentScrolled = (windowBottom - top) / (container_height + windowHeight);
                var parallax = Math.round((parallax_dist * percentScrolled));

                if (initial) {
                    $img.css('display', 'block');
                }

                if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {
                    $img.css('transform', "translate3D(-50%," + parallax + "px, 0)");
                }
            }

            //- Wait for image load -//
            $this.children("img").one("load", function() {
                updateParallax(true);
            }).each(function() {
                if(this.complete) $(this).load();
            });

            $(window).scroll(function() {
                window_width = $(window).width();
                updateParallax(false);
            });

            $(window).resize(function() {
                window_width = $(window).width();
                updateParallax(false);
            });
        });
    };
}(jQuery));

(function($){
    $(function(){
        $('.parallax').parallax();
    });
})(jQuery);


/* PRELOADER */
var mythemes_masonry = {
    _class : function(){
        this.init = function( el, callback ){
            var total = jQuery( el ).find( 'img' ).length;

            jQuery( el ).find( 'img' ).each(function(){
                var image = new Image();

                image.onload = function(){
                    total--;

                    if( total == 0 ){
                        callback();
                    }
                }

                image.src = jQuery( this ).attr( 'src' );
            });
        }
    }
};

var _mythemes_masonry = new mythemes_masonry._class();
var jspane;

function mythemes_jscrollpanel(){
    jQuery(function(){

        if( jQuery('div.mythemes-visible-navigation').css('display') !== 'none' ){
            jspane = jQuery( 'div.mythemes-topper nav.header-menu.in div.menu-list-wrapper').jScrollPane();
        }
        else {

            if( typeof jspane === 'object' && typeof jspane.date === 'function' ){
                var api = jspane.date('jsp');
                api.destroy();
            }

            jQuery( 'nav.header-menu' ).removeClass( 'in' );
            jQuery( 'nav.header-menu ul.mythemes-menu-list' ).parent().removeAttr( 'style' );
            jQuery( 'nav.header-menu ul.mythemes-menu-list' ).parent().parent().removeAttr( 'style' );
            jQuery( 'nav.header-menu div.menu-list-wrapper' ).removeAttr( 'style' );

            if( jQuery( 'nav.header-menu' ).hasClass( 'in' ) ){
                jQuery( 'nav.header-menu' ).removeClass( 'in' );
            }

            if( jQuery( 'div.mythemes-header-antet button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'div.mythemes-header-antet button.btn-collapse' ).removeClass( 'collapsed' );
            }

            jQuery( 'nav.header-menu, nav.header-menu ul' ).each(function(){
                jQuery( this ).removeAttr( 'style' );
            });
            if( jQuery( 'nav.header-menu button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'nav.header-menu button.btn-collapse' ).removeClass( 'collapsed' );
            }
            if( jQuery( 'nav.header-menu ul li' ).hasClass( 'collapsed' ) ){
                jQuery( 'nav.header-menu ul li' ).removeClass( 'collapsed' );
            }
        }
    });
}

jQuery(document).ready(function(){    

    /* ADD MENU ARROWS */
    jQuery('nav.header-menu ul.mythemes-menu-list li.menu-item-has-children').prepend('<span class="menu-arrow"></span>');

    /* EXPAND SUBMENUS - SMALL DEVICES */
    jQuery( 'nav.header-menu ul li span.menu-arrow' ).on( "click" , function(){
        if( jQuery( this ).parent( 'li' ).hasClass( 'collapsed' ) ){
            jQuery( this ).parent().children('ul').hide( "slow" , function(){
                jQuery( this ).removeAttr( 'style' );
            });
            jQuery( this ).parent( 'li' ).removeClass( 'collapsed' );
            mythemes_jscrollpanel();
        }
        else{
            jQuery( this ).parent( 'li' ).addClass( 'collapsed' );
            jQuery( this ).parent().children('ul').show( "slow", function(){
                mythemes_jscrollpanel();    
            });
        }
    });

    /* EXPAND MENU FROM ANTENT */
    jQuery( 'div.mythemes-header-antet button.btn-collapse' ).click(function(){
        if( jQuery( this ).hasClass( 'collapsed' ) ){
            jQuery( this ).removeClass( 'collapsed' );
            jQuery( '.nav-collapse.in' ).each(function(){
                jQuery( this ).hide( 'slow' , function(){
                    jQuery( this ).removeClass( 'in' );
                    jQuery( this ).removeAttr( 'style' );
                    var btn = jQuery( this ).find( 'button.btn-collapse' );

                    if( btn.hasClass( 'collapsed' ) ){
                        btn.removeClass( 'collapsed' );
                    }

                    jQuery( 'body' ).css({ 'overflow' : 'initial' });

                    mythemes_jscrollpanel();
                });
            });
        }
        else{
            jQuery( this ).addClass( 'collapsed' );

            jQuery( '.nav-collapse' ).show( 'slow' , function(){
                jQuery( this ).addClass( 'in' );
                jQuery( this ).removeAttr( 'style' );
                var btn = jQuery( this ).find( 'button.btn-collapse' );

                if( !btn.hasClass( 'collapsed' ) ){
                    btn.addClass( 'collapsed' );
                }

                jQuery( 'body' ).css({ 'overflow' : 'hidden' });

                mythemes_jscrollpanel();
            });
        }
    });

    /* EXPAND FROM MENU */
    jQuery( 'nav.header-menu button.btn-collapse' ).click(function(){
        if( jQuery( this ).hasClass( 'collapsed' ) ){
            jQuery( this ).removeClass( 'collapsed' );
            jQuery( '.nav-collapse.in' ).each(function(){
                jQuery( this ).hide( 'slow' , function(){
                    jQuery( this ).removeClass( 'in' );
                    jQuery( this ).removeAttr( 'style' );
                    mythemes_jscrollpanel();
                });
            });

            if( jQuery( 'div.mythemes-header-antet button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'div.mythemes-header-antet button.btn-collapse' ).removeClass( 'collapsed' );
            }

            jQuery( 'body' ).css({ 'overflow' : 'initial' });
        }
        else{
            jQuery( this ).addClass( 'collapsed' );

            if( !jQuery( 'div.mythemes-header-antet button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'div.mythemes-header-antet button.btn-collapse' ).addClass( 'collapsed' );
            }

            jQuery( '.nav-collapse' ).show( 'slow' , function(){
                jQuery( this ).addClass( 'in' );
                jQuery( this ).removeAttr( 'style' );
                mythemes_jscrollpanel();
            });

            jQuery( 'body' ).css({ 'overflow' : 'hidden' });
        }
    });

    /* GALLERY WITH MASONRY */
    _mythemes_masonry.init( '.mythemes-gallery', function(){
        jQuery( '.mythemes-gallery' ).masonry();
    });

    /* NAVIGATION POSITION FIXED */
    jQuery( window ).scroll(function(){
        var top = jQuery( window ).scrollTop();
        if( top > 46 ){
            if( !jQuery( 'body' ).hasClass( 'scrolled-46' ) ){
                jQuery( 'body' ).addClass( 'scrolled-46' );
            }
        }

        else{
            if( jQuery( 'body' ).hasClass( 'scrolled-46' ) ){
                jQuery( 'body' ).removeClass( 'scrolled-46' );
            }
        }
    });

    var parallax_img    = jQuery( 'div.parallax-container .parallax img' );

    var img_height      = parseInt( jQuery( parallax_img ).height() );
    var img_width       = parseInt( jQuery( parallax_img ).width() );

    function mythemes_parallax_cover()
    {
        var window_height   = parseInt( jQuery( window ).height() );
        var window_width    = parseInt( jQuery( window ).width() );

        var r_height        = parseInt( img_height * window_width / img_width );

        jQuery( 'div.parallax-container .parallax img' ).css({ 'height' : 'auto' });
        jQuery( 'div.parallax-container .parallax img' ).css({ 'width' : 'auto' });

        if( r_height < window_height ){

            var width = parseInt( img_width * window_height / img_height );

            jQuery( 'div.parallax-container .parallax img' ).css({ 'height' : window_height + 'px' });
            jQuery( 'div.parallax-container .parallax img' ).css({ 'width'  : width + 'px' });
        }
        else{
            jQuery( 'div.parallax-container .parallax img' ).css({ 'width' : window_width + 'px' });
            jQuery( 'div.parallax-container .parallax img' ).css({ 'height' : 'auto' });
        }
    }

    _mythemes_masonry.init( 'div.parallax-container .parallax', function(){
        mythemes_parallax_cover();
        jQuery('.parallax').parallax();
    });


    /* CHANGE BORDER BOTTOM ON WINDOW RESIZE */
    jQuery( window ).resize(function() {

        jQuery( 'nav.base-nav ul span.menu-plus' ).removeClass( 'collapsed' );
        jQuery( 'nav.base-nav ul li ul' ).removeAttr( 'style' );

        if( jQuery( '.mythemes-gallery' ).length ){
            jQuery( '.mythemes-gallery' ).masonry();    
        }

        mythemes_jscrollpanel();
        mythemes_parallax_cover();
    });
});