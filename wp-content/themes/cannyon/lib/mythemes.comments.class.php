<?php
if( !class_exists( 'mythemes_comments' ) ){

class mythemes_comments
{
	/* DUSQUSE */
	/* FACEBOOK */
	/* WORDPRESS */
	static function classic( $comment, $args, $depth )
    {
        $deff = get_template_directory_uri() . '/media/_frontend/img/default-avatar.png';

        $GLOBALS['comment'] = $comment;
        switch ( $comment -> comment_type ) {
            case '' : {
                echo '<li '; comment_class(); echo' id="li-comment-'; comment_ID(); echo '">';
                echo '<div id="comment-'; comment_ID(); echo '" class="comment-box">';
                echo '<header>';
                echo get_avatar( $comment -> comment_author_email , 44  , $deff );
                echo '<span class="comment-meta">';
                echo '<time datetime="' . esc_attr( get_comment_date( 'Y-m-d' , $comment -> comment_ID ) ) . '" class="comment-time">';
                echo get_comment_date( esc_attr( get_option( 'date_format' ) ) , $comment -> comment_ID );
                echo '</time>';

                comment_reply_link( array_merge( $args , array( 
                    'reply_text'    => __( 'Reply', 'cannyon' ),
                    'before'        => '<span class="comment-replay">',
                    'after'         => '</span>',
                    'depth'         => (int)$depth 
                )));

                echo '</span>';
                echo '<cite>';
                echo get_comment_author_link( $comment -> comment_ID );
                echo '</cite>';
                echo '<div class="clear"></div>';
                echo '</header>';

                echo '<div class="comment-quote">';
                if ( $comment -> comment_approved == '0' ) {
                    echo '<em class="comment-awaiting-moderation">';
                    _e( 'Your comment is awaiting moderation.' , 'cannyon' );
                    echo '</em>';
                }
                echo get_comment_text();            
                echo '</div>';

                echo '</div>';
                break;
            }   
            default : {
                echo '<li '; comment_class(); echo' id="li-comment-'; comment_ID(); echo '">';
                echo '<div id="comment-'; comment_ID(); echo '" class="comment-box">';
                echo '<header>';
                echo '<span class="comment-meta">';
                echo '<time datetime="' . esc_attr( get_comment_date( 'Y-m-d' , $comment -> comment_ID ) ) . '" class="comment-time">';
                echo get_comment_date( esc_attr( get_option( 'date_format' ) ) , $comment -> comment_ID );
                echo '</time>';

                echo '</span>';
                echo '<cite>';
                echo get_comment_author_link( $comment -> comment_ID );
                echo '</cite>';
                echo '<div class="clear"></div>';
                echo '</header>';

                echo '<div class="comment-quote">';
                echo get_comment_text();            
                echo '</div>';
                echo '</div>';
                break;
            }
        }
    }
}

}   /* END IF CLASS EXISTS */
?>