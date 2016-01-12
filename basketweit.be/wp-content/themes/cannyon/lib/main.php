<?php
/* INCLUDE CLASSES DEBUG, CONFIG AND CORE */
get_template_part( 'lib/mythemes.deb.class' );
get_template_part( 'lib/mythemes.cfg.class' );
get_template_part( 'lib/mythemes.core.class' );


/* INCLUDE INPUT / OUTPUT */
get_template_part( 'lib/mythemes.meta.class' );
get_template_part( 'lib/mythemes.options.class' );

get_template_part( 'lib/mythemes.tools.class' );

/* INCLUDE CONFIGS */
get_template_part( 'cfg/main' );

if( is_admin() ){
	
	/* INCLUDE RESOURCES */
	get_template_part( 'lib/mythemes.ahtml.class' );
	get_template_part( 'lib/mythemes.admin.class' );
}

get_template_part( 'lib/mythemes.setup.class' );	
get_template_part( 'lib/mythemes.post.class' );
get_template_part( 'lib/mythemes.scripts.class' );

get_template_part( 'lib/mythemes.gallery.class' );

get_template_part( 'lib/mythemes.layouts.class' );
get_template_part( 'lib/mythemes.header.class' );
get_template_part( 'lib/mythemes.breadcrumbs.class' );
get_template_part( 'lib/mythemes.comments.class' );

?>