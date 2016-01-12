        <footer>
            <?php
                $are_active_sidebras =  is_active_sidebar( 'footer-first' ) ||
                                        is_active_sidebar( 'footer-second' ) ||
                                        is_active_sidebar( 'footer-third' ) ||
                                        is_active_sidebar( 'footer-fourth' );
                
                if( $are_active_sidebras || (bool)get_theme_mod( 'mythemes-default-content', true ) ){
            ?>
                    <aside class="mythemes-default-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                    <?php get_sidebar( 'footer-first' ); ?>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                    <?php get_sidebar( 'footer-second' ); ?>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                    <?php get_sidebar( 'footer-third' ); ?>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                    <?php get_sidebar( 'footer-fourth' ); ?>
                                </div>
                            </div>
                        </div>
                    </aside>
            <?php
                }
            ?>

            <div class="mythemes-dark-mask">
                <div class="container mythemes-social">
                    <div class="row">
                        <?php
                            $vimeo      = esc_url( get_theme_mod( 'mythemes-vimeo', 'http://vimeo.com/#' ) );
                            $twitter    = esc_url( get_theme_mod( 'mythemes-twitter', 'http://twitter.com/#' ) );
                            $skype      = esc_url( get_theme_mod( 'mythemes-skype' ) );
                            $renren     = esc_url( get_theme_mod( 'mythemes-renren' ) );
                            $github     = esc_url( get_theme_mod( 'mythemes-github' ) );
                            $rdio       = esc_url( get_theme_mod( 'mythemes-rdio' ) );
                            $linkedin   = esc_url( get_theme_mod( 'mythemes-linkedin' ) );
                            $behance    = esc_url( get_theme_mod( 'mythemes-behance', 'http://behance.com/#' ) );
                            $dropbox    = esc_url( get_theme_mod( 'mythemes-dropbox' ) );
                            $flickr     = esc_url( get_theme_mod( 'mythemes-flickr', 'http://flickr.com/#' ) );
                            $tumblr     = esc_url( get_theme_mod( 'mythemes-tumblr' ) );
                            $instagram  = esc_url( get_theme_mod( 'mythemes-instagram' ) );
                            $vkontakte  = esc_url( get_theme_mod( 'mythemes-vkontakte' ) );
                            $facebook   = esc_url( get_theme_mod( 'mythemes-facebook', 'http://facebook.com/#' ) );
                            $evernote   = esc_url( get_theme_mod( 'mythemes-evernote' ) );
                            $flattr     = esc_url( get_theme_mod( 'mythemes-flattr' ) );
                            $picasa     = esc_url( get_theme_mod( 'mythemes-picasa' ) );
                            $dribbble   = esc_url( get_theme_mod( 'mythemes-dribbble' ) );
                            $mixi       = esc_url( get_theme_mod( 'mythemes-mixi' ) );
                            $stumbl     = esc_url( get_theme_mod( 'mythemes-stumbleupon' ) );
                            $lastfm     = esc_url( get_theme_mod( 'mythemes-lastfm' ) );
                            $gplus      = esc_url( get_theme_mod( 'mythemes-gplus' ) );
                            $gcircle    = esc_url( get_theme_mod( 'mythemes-google-circles' ) );
                            $pinterest  = esc_url( get_theme_mod( 'mythemes-pinterest', 'http://pinterest.com/#' ) );
                            $smashing   = esc_url( get_theme_mod( 'mythemes-smashing' ) );
                            $soundcloud = esc_url( get_theme_mod( 'mythemes-soundcloud' ) );
                            $rss        = esc_url( get_theme_mod( 'mythemes-rss', esc_url( get_bloginfo('rss2_url') ) ) );

                            if( isset( $wp_customize ) ) {
                                
                                $vm_class   = empty( $vimeo ) ? 'hidden' : '';
                                $tw_class   = empty( $twitter ) ? 'hidden' : '';
                                $sk_class   = empty( $skype ) ? 'hidden' : '';
                                $rn_class   = empty( $renren ) ? 'hidden' : '';
                                $gt_class   = empty( $github ) ? 'hidden' : '';
                                $rd_class   = empty( $rdio ) ? 'hidden' : '';
                                $ln_class   = empty( $linkedin ) ? 'hidden' : '';
                                $bh_class   = empty( $behance ) ? 'hidden' : '';
                                $db_class   = empty( $dropbox ) ? 'hidden' : '';
                                $fk_class   = empty( $flickr ) ? 'hidden' : '';
                                $tm_class   = empty( $tumblr ) ? 'hidden' : '';
                                $in_class   = empty( $instagram ) ? 'hidden' : '';
                                $vk_class   = empty( $vkontakte ) ? 'hidden' : '';
                                $fb_class   = empty( $facebook ) ? 'hidden' : '';
                                $ev_class   = empty( $evernote ) ? 'hidden' : '';
                                $ft_class   = empty( $flattr ) ? 'hidden' : '';
                                $pc_class   = empty( $picasa ) ? 'hidden' : '';
                                $dr_class   = empty( $dribbble ) ? 'hidden' : '';
                                $mx_class   = empty( $mixi ) ? 'hidden' : '';
                                $st_class   = empty( $stumbl ) ? 'hidden' : '';
                                $ls_class   = empty( $lastfm ) ? 'hidden' : '';
                                $gp_class   = empty( $gplus ) ? 'hidden' : '';
                                $gc_class   = empty( $gcircle ) ? 'hidden' : '';
                                $pn_class   = empty( $pinterest ) ? 'hidden' : '';
                                $sm_class   = empty( $smashing ) ? 'hidden' : '';
                                $sc_class   = empty( $soundcloud ) ? 'hidden' : '';
                                $rs_class   = empty( $rss ) ? 'hidden' : '';

                                $vimeo      = empty( $vimeo ) ?  esc_url( home_url() ) : $vimeo;
                                $twitter    = empty( $twitter ) ? esc_url( home_url() ) : $twitter;
                                $skype      = empty( $skype ) ? esc_url( home_url() ) : $skype;
                                $renren     = empty( $renren ) ? esc_url( home_url() ) : $renren;
                                $github     = empty( $github ) ? esc_url( home_url() ) : $github;
                                $rdio       = empty( $rdio ) ? esc_url( home_url() ) : $rdio;
                                $linkedin   = empty( $linkedin ) ? esc_url( home_url() ) : $linkedin;
                                $behance    = empty( $behance ) ? esc_url( home_url() ) : $behance;
                                $dropbox    = empty( $dropbox ) ? esc_url( home_url() ) : $dropbox;
                                $flickr     = empty( $flickr ) ? esc_url( home_url() ) : $flickr;
                                $tumblr     = empty( $tumblr ) ? esc_url( home_url() ) : $tumblr;
                                $instagram  = empty( $instagram ) ? esc_url( home_url() ) : $instagram;
                                $vkontakte  = empty( $vkontakte ) ? esc_url( home_url() ) : $vkontakte;
                                $facebook   = empty( $facebook ) ? esc_url( home_url() ) : $facebook;
                                $evernote   = empty( $evernote ) ? esc_url( home_url() ) : $evernote;
                                $flattr     = empty( $flattr ) ? esc_url( home_url() ) : $flattr;
                                $picasa     = empty( $picasa ) ? esc_url( home_url() ) : $picasa;
                                $dribbble   = empty( $dribbble ) ? esc_url( home_url() ) : $dribbble;
                                $mixi       = empty( $mixi ) ? esc_url( home_url() ) : $mixi;
                                $stumbl     = empty( $stumbl ) ? esc_url( home_url() ) : $stumbl;
                                $lastfm     = empty( $lastfm ) ? esc_url( home_url() ) : $lastfm;
                                $gplus      = empty( $gplus ) ? esc_url( home_url() ) : $gplus;
                                $gcircle    = empty( $gcircle ) ? esc_url( home_url() ) : $gcircle;
                                $pinterest  = empty( $pinterest ) ? esc_url( home_url() ) : $pinterest;
                                $smashing   = empty( $smashing ) ? esc_url( home_url() ) : $smashing;
                                $soundcloud = empty( $soundcloud ) ? esc_url( home_url() ) : $soundcloud;
                                $rss        = empty( $rss ) ? esc_url( home_url() ) : $rss;
                            }
                            else{

                                $vm_class   = '';
                                $tw_class   = '';
                                $sk_class   = '';
                                $rn_class   = '';
                                $gt_class   = '';
                                $rd_class   = '';
                                $ln_class   = '';
                                $bh_class   = '';
                                $db_class   = '';
                                $fk_class   = '';
                                $tm_class   = '';
                                $in_class   = '';
                                $vk_class   = '';
                                $fb_class   = '';
                                $ev_class   = '';
                                $ft_class   = '';
                                $pc_class   = '';
                                $dr_class   = '';
                                $mx_class   = '';
                                $st_class   = '';
                                $ls_class   = '';
                                $gp_class   = '';
                                $gc_class   = '';
                                $pn_class   = '';
                                $sm_class   = '';
                                $sc_class   = '';
                                $rs_class   = '';
                            }
                        ?>
                        <div class="col-lg-12">
                            <?php
                                if( !empty( $vimeo ) ){
                                    echo '<a href="' . $vimeo . '" class="mythemes-icon-vimeo ' . esc_attr( $vm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $twitter ) ){
                                    echo '<a href="' . $twitter . '" class="mythemes-icon-twitter ' . esc_attr( $tw_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $skype ) ){
                                    echo '<a href="' . $skype . '" class="mythemes-icon-skype ' . esc_attr( $sk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $renren ) ){
                                    echo '<a href="' . $renren . '" class="mythemes-icon-renren ' . esc_attr( $rn_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $github ) ){
                                    echo '<a href="' . $github . '" class="mythemes-icon-github ' . esc_attr( $gt_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $rdio ) ){
                                    echo '<a href="' . $rdio . '" class="mythemes-icon-rdio ' . esc_attr( $rd_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $linkedin ) ){
                                    echo '<a href="' . $linkedin . '" class="mythemes-icon-linkedin ' . esc_attr( $ln_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $behance ) ){
                                    echo '<a href="' . $behance . '" class="mythemes-icon-behance ' . esc_attr( $bh_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $dropbox ) ){
                                    echo '<a href="' . $dropbox . '" class="mythemes-icon-dropbox ' . esc_attr( $db_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $flickr ) ){
                                    echo '<a href="' . $flickr . '" class="mythemes-icon-flickr ' . esc_attr( $fk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $tumblr ) ){
                                    echo '<a href="' . $tumblr . '" class="mythemes-icon-tumblr ' . esc_attr( $tm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $instagram ) ){
                                    echo '<a href="' . $instagram . '" class="mythemes-icon-instagram ' . esc_attr( $in_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $vkontakte ) ){
                                    echo '<a href="' . $vkontakte . '" class="mythemes-icon-vkontakte ' . esc_attr( $vk_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $facebook ) ){
                                    echo '<a href="' . $facebook . '" class="mythemes-icon-facebook ' . esc_attr( $fb_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $evernote ) ){
                                    echo '<a href="' . $evernote . '" class="mythemes-icon-evernote ' . esc_attr( $ev_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $flattr ) ){
                                    echo '<a href="' . $flattr . '" class="mythemes-icon-flattr ' . esc_attr( $ft_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $picasa ) ){
                                    echo '<a href="' . $picasa . '" class="mythemes-icon-picasa ' . esc_attr( $pc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $dribbble ) ){
                                    echo '<a href="' . $dribbble . '" class="mythemes-icon-dribbble ' . esc_attr( $dr_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $mixi ) ){
                                    echo '<a href="' . $mixi . '" class="mythemes-icon-mixi ' . esc_attr( $mx_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $stumbl ) ){
                                    echo '<a href="' . $stumbl . '" class="mythemes-icon-stumbleupon ' . esc_attr( $st_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $lastfm ) ){
                                    echo '<a href="' . $lastfm . '" class="mythemes-icon-lastfm ' . esc_attr( $ls_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $gplus ) ){
                                    echo '<a href="' . $gplus . '" class="mythemes-icon-gplus ' . esc_attr( $gp_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $gcircle ) ){
                                    echo '<a href="' . $gcircle . '" class="mythemes-icon-google-circles ' . esc_attr( $gc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $pinterest ) ){
                                    echo '<a href="' . $pinterest . '" class="mythemes-icon-pinterest ' . esc_attr( $pn_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $smashing ) ){
                                    echo '<a href="' . $smashing . '" class="mythemes-icon-smashing ' . esc_attr( $sm_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $soundcloud ) ){
                                    echo '<a href="' . $soundcloud . '" class="mythemes-icon-soundcloud ' . esc_attr( $sc_class ) . '" target="_blank"></a>';
                                }
                                if( !empty( $rss ) ){
                                    echo '<a href="' . $rss . '" class="mythemes-icon-rss ' . esc_attr( $rs_class ) . '" target="_blank"></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="mythemes-copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                    <span class="copyright"><?php echo mythemes_validate_copyright( get_theme_mod( 'mythemes-copyright' , sprintf( __( 'Copyright &copy; %s %s. Powered by %s.' , 'cannyon' ) , date( 'Y' ) , esc_html( get_bloginfo( 'name' ) ) , '<a href="http://wordpress.org/">WordPress</a>' ) ) ); ?></span>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

        <?php wp_footer(); ?>

    </body>
</html>