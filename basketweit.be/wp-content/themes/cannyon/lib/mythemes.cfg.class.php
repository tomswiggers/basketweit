<?php
if( !class_exists( 'mythemes_cfg' ) ){

class mythemes_cfg
{
    /* CONFIG */
    private static $cfgs            = array();

    private static $actions         = array();

    /* RESOURCES */
    private static $posts           = array();
    private static $boxes           = array();
    private static $taxonomies      = array();
    
    /* OPTIONS */
    private static $pages           = array();
    private static $sett            = array();
    private static $def             = array(); 

    /* GET AND SET CONFIGS */
    public static function get( $key = null )
    {
        $rett = self::$cfgs;

        if( !empty( $key ) )
            $rett = self::$cfgs[ $key ];

        return $rett;
    }

    public static function set( $cfgs )
    {
        self::$cfgs = $cfgs;
    }

    /* GET AND SET ACTIONS */
    public static function get_actions()
    {
        return self::$actions;
    }

    public static function add_action( $action )
    {
        self::$actions[] = $action;
    }

    /* GET AND SET CUSTOM POSTS */
    public static function get_posts()
    {
        return self::$posts;
    }

    public static function set_posts( $posts )
    {
        self::$posts = $posts;
    }

    /* GET AND SET META BOXES FOR STANDARD AND CUSTOM POSTS */
    public static function get_boxes()
    {
        return self::$boxes; 
    }

    public static function set_boxes( $boxes )
    {
        self::$boxes = $boxes;
    }

    /* GET AND SET TAXONOMIES FOR CUSTOM POSTS */
    public static function get_taxonomies()
    {
        return self::$taxonomies; 
    }

    public static function set_taxonomies( $taxonomies )
    {
        self::$taxonomies = $taxonomies;
    }


    /* GET AND SET PAGES */
    public static function get_pages()
    {
        return self::$pages; 
    }

    public static function set_pages( $pages )
    {
        self::$pages = $pages;
    }

    /* GET AND SET OPTIONS */
    public static function get_sett()
    {
        return self::$sett;
    }

    public static function set_sett( $sett )
    {
        self::$sett = $sett;
    }

    /* GET AND SET DEFAULT & VALUES FOR META AND OPTIONS */
    public static function get_def()
    {
        return self::$def; 
    }

    public static function set_def( $def )
    {
        self::$def = $def;
    }
}

} /* END IF CLASS EXISTS */
?>