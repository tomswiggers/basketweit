<?php
if( !class_exists( 'mythemes_post' ) ){

class mythemes_post
{
	static function title( $post_id, $is_attr = false )
	{
		$rett = '';

		if( $is_attr ){
			$rett = esc_attr( get_the_title( $post_id ) );
		}
		else{
			$rett = esc_html( get_the_title( $post_id ) );
		}

		return $rett;
	}
}

}	/* END IF CLASS EXISTS */
?>