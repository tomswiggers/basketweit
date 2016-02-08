<?php
if( !class_exists( 'mythemes_ahtml' ) ){

class mythemes_ahtml
{
    /* DEFAULT */
    /* IMAGE SELECT */
    private static $image_select_ext    = 'png';
    private static $image_select_cols   = 3;
    private static $image_select_pos    = 'right';
    private static $image_select_path   = '/media/_backend/img/';

    /* ID */
    static function id( $sett )
    {
        if( isset( $sett[ 'inputID' ] ) && !empty( $sett[ 'inputID' ] ) )
            return  esc_attr( $sett[ 'inputID' ] );
        
        if( isset( $sett[ 'slug' ] ) && !empty( $sett[ 'slug' ] ) )
            return 'mythemes-' . esc_attr( $sett[ 'slug' ] );
        
        return null;
    }
    
    /* NAME */
    static function name( $sett )
    {
        if( isset( $sett[ 'inputName' ] ) && !empty( $sett[ 'inputName' ] ) )
            return  esc_attr( $sett[ 'inputName' ] );
        
        if( isset( $sett[ 'slug' ] ) && !empty( $sett[ 'slug' ] ) )
            return 'mythemes-' . esc_attr( $sett[ 'slug' ] );
        
        return null;
    }
    
    /* CLASS */
    static function classes( $sett )
    {
        $rett = '';
        
        if( isset( $sett[ 'inputClass' ] ) && !empty( $sett[ 'inputClass' ] ) )
            $rett = esc_attr( $sett[ 'inputClass' ] );
        
        if( isset( $sett[ 'slug' ] ) && !empty( $sett[ 'slug' ] ) )
            $rett .= ' mythemes-' . esc_attr( $sett[ 'slug' ] );
        
        return $rett;
    }

    static function type( $sett )
    {
        $rett = '';

        if( isset( $sett[ 'type' ] ) && isset( $sett[ 'type' ][ 'input' ] ) )
            $rett = esc_attr( $sett[ 'type' ][ 'input' ] );

        return $rett;
    }
    
    /* ATTR FOR ID, NAME, CLASS */
    static function attr( $sett , $attr )
    {
        $value = null;
        
        switch( $attr ){
            case 'for':
            case 'id' :{
                $value = self::id( $sett );
                break;
            }
            case 'name' :{
                $value = self::name( $sett );
                break;
            }
            case 'class' :{
                $value = self::classes( $sett );
                break;
            }
            case 'data-default-color' :{

                if( isset( $sett[ 'default' ] ) ){
                    $value = $sett[ 'default' ];
                }
                break;
            }
        }
        
        if( isset( $sett[ 'type' ][ 'input' ] ) &&  $sett[ 'type' ][ 'input' ] == 'mselect' )
            $value .= '[]';
        
        $rett = null;
        if( !empty( $value ) )
            $rett = $attr . '="' . $value . '"';
        
        return $rett;
    }

    /* BOX */
    static function box( $box , $sett )
    {
        if( isset( $box[ 'inputClass' ] ) ){
            $box[ 'inputClass' ] .= ' mythemes-box';
        }
        else{
            $box[ 'inputClass' ] = 'mythemes-box';
        }

        /* HTML */
        $rett  = '<div ' . self::attr( $box , 'id' ) . ' ' . self::attr( $box , 'class' ) . ' ' . self::boxStyle( $box ) . '>';

        $rett .= self::boxTitle( $box );

        $rett .= '<div class="mythemes-box-content">';

        foreach( $box[ 'sett' ] as $slug ){

            /* GET FIELDS */
            if( isset( $sett[ $slug ] ) ){
                $sett[ $slug ][ 'slug' ]    = $slug;
                $sett[ $slug ][ 'default' ] = mythemes_options::def( $slug );
                $sett[ $slug ][ 'value' ]   = mythemes_options::set_validate( $sett[ $slug ] , mythemes_options::val( $slug ) );

                $rett .= self::field( $sett[ $slug ] );
            }

            /* IF NOT EXISTS SLUG */
            else{
                ob_start();
                print_r( $sett );
                $data = ob_get_clean();
            
                $bt = debug_backtrace();
                $caller = array_shift( $bt );
            
                $result  = '<prestyle="color: #990000;">' . $caller[ 'file' ] . ' : ' . $caller[ 'line' ];
                $result .= '<br>Field not exist : [ ' . $slug . ' ]';
                $result .= '<br>' . $data .'</pre>';
            }
        }

        $rett .= '</div>';
        $rett .= '</div>';

        return $rett;
    }

    static function boxTitle( $box )
    {
        $rett = '';

        if( isset( $box[ 'title' ] ) ){
            $rett .= '<div class="mythemes-box-header">';
            $rett .= '<h3>' . $box[ 'title' ] . '</h3>';
            $rett .= '</div>';
        }

        return $rett;
    }

    static function boxStyle( $box )
    {
        $rett = '';

        if( isset( $box[ 'top' ] ) ){
            $rett = 'margin-top: ' . $box[ 'top' ] . 'px;';
        }

        if( isset( $box[ 'bottom' ] ) ){
            $rett .= 'margin-bottom: ' . $box[ 'bottom' ] . 'px;';
        }

        if( !empty( $rett ) ){
            $rett = ' style="' . $rett . '"';
        }

        return $rett;
    }

    /* FIELD */
    static function field( $sett )
    {
        if( isset( $sett[ 'type' ][ 'field' ] ) && method_exists( new mythemes_ahtml() , $sett[ 'type' ][ 'field' ] ) ) {
            return call_user_func_array( array( new mythemes_ahtml() , $sett[ 'type' ][ 'field' ] ) , array( $sett ) );
        }
        else{
            ob_start();
            print_r( $sett );
            $data = ob_get_clean();
            
            $bt = debug_backtrace();
            $caller = array_shift( $bt );
            
            $result  = '<pre>' . $caller[ 'file' ] . ' : ' . $caller[ 'line' ];
            $result .= '<br>Field not exist : [ ' . self::name( $sett ) . ' ]';
            $result .= '<br>' . $data .'</pre>';
            return $result;
        }
    }
    
    /* FIELD ID */
    static function fieldID( $sett )
    {
        if( isset( $sett[ 'fieldID' ] ) && !empty( $sett[ 'fieldID' ] ) )
            return  $sett[ 'fieldID' ];
        
        if( isset( $sett[ 'slug' ] ) && !empty( $sett[ 'slug' ] ) )
            return 'mythemes-field-' . $sett[ 'slug' ];
        
        return null;
    }
    
    /* FIELD CLASS */
    static function fieldClasses( $sett )
    {
        $rett = 'mythemes-' . self::type( $sett );

        if( isset( $sett[ 'fieldClass' ] ) && !empty( $sett[ 'fieldClass' ] ) )
            $rett .= ' ' . $sett[ 'fieldClass' ];
        
        if( isset( $sett[ 'slug' ] ) && !empty( $sett[ 'slug' ] ) )
            $rett .= ' mythemes-' . $sett[ 'slug' ];
        
        return $rett;
    }

    /* ALERT */
    static function inlist( $sett )
    {
        $type = null;
        if( method_exists( new mythemes_ahtml() , $sett[ 'type' ][ 'input' ] ) )
                $type = $sett[ 'type' ][ 'input' ];
        
        $rett = '';
        
        if( !empty( $type ) ){
            $rett .= '<div class="mythemes-field-inlist ' . self::fieldClasses( $sett ) . '">';
            
            $rett .= '<div class="mythemes-field-label">';
            $rett .= self::label( $sett );
            $rett .= self::hint( $sett );
            $rett .= '</div>';

            $rett .= '<div class="mythemes-field-input">';
            $rett .= call_user_func_array( array( new mythemes_ahtml() , $type ) , array( $sett ) );
            $rett .= '</div>';

            $rett .= '<div class="clear"></div>';

            $rett .= '</div>';
        }
        
        return $rett;
    }
    
    static function inline( $sett )
    {
        $type = null;
        if( method_exists( new mythemes_ahtml() , $sett[ 'type' ][ 'input' ] ) )
                $type = $sett[ 'type' ][ 'input' ];
        
        $rett = '';
        
        if( !empty( $type ) ){
            $rett .= '<div class="mythemes-field-inline ' . self::fieldClasses( $sett ) . '">';
            
            $rett .= '<div class="mythemes-field-label">';
            $rett .= self::label( $sett );
            $rett .= self::hint( $sett );
            $rett .= '</div>';

            $rett .= '<div class="mythemes-field-input">';
            $rett .= call_user_func_array( array( new mythemes_ahtml() , $type ) , array( $sett ) );
            $rett .= '</div>';

            $rett .= '<div class="clear"></div>';

            $rett .= '</div>';
        }
        
        return $rett;
    }

    static function social( $sett )
    {
        $type = null;
        if( method_exists( new mythemes_ahtml() , $sett[ 'type' ][ 'input' ] ) )
                $type = $sett[ 'type' ][ 'input' ];
        
        $rett = '';
        
        if( !empty( $type ) ){
            $rett .= '<div class="mythemes-field-social ' . self::fieldClasses( $sett ) . '">';
            
            $rett .= '<div class="mythemes-field-icon">';
            $rett .= '<i class="mythemes-mythemes-icon-' . $sett[ 'slug' ] . ' mythemes-icon-' . $sett[ 'slug' ] . '"></i>';
            $rett .= '</div>';

            $rett .= '<div class="mythemes-field-input">';
            $rett .= call_user_func_array( array( new mythemes_ahtml() , $type ) , array( $sett ) );
            $rett .= '</div>';

            $rett .= '<div class="clear"></div>';

            $rett .= '</div>';
        }
        
        return $rett;
    }
    
    static function none( $sett )
    {
        $rett = null;
        if( isset( $sett[ 'content' ] ) )
            $rett = $sett[ 'content' ];
        
        return $rett;
    }
    
    static function label( $sett )
    {   
        $rett = '';
        
        if( isset( $sett[ 'label' ] ) )
            $rett = '<label ' . self::attr( $sett, 'for' ) . '>' . $sett[ 'label' ] . '</label>';
        
        return $rett;
    }
    
    static function hint( $sett )
    {
        if( isset( $sett[ 'hint' ] ) && !empty( $sett[ 'hint' ] ) ){
            return '<small class="mythemes-hint">' . $sett[ 'hint' ] . '</small>';
        }
    }

    /* ALERT */
    static function alert( $sett ){

        $title      = '';
        $content    = '';

        if( isset( $sett[ 'title' ]  ) ){
            $title = '<strong>' . esc_html( $sett[ 'title' ] ) . '</strong>';
        }

        if( isset( $sett[ 'content' ]  ) ){
            $content = '<p>' . strip_tags( $sett[ 'content' ] , '<a><span><em><i><br>' ) . '</p>';
        }

        $classes = 'mythemes-flat-alert';

        if( isset( $sett[ 'type' ][ 'style' ] ) ){
            $classes .= ' ' . esc_attr( $sett[ 'type' ][ 'style' ] );
        }

        return '<div ' 
                . self::attr( $sett , 'id' ) . ' '
                . 'class="' . $classes . '">'
                . $title
                . $content
                . '</div>'; 
    }
    
    /* URL */
    static function url( $sett )
    {
        return '<input type="url" '
                . self::attr( $sett , 'id' ) . ' '
                . self::attr( $sett , 'class' ) . ' '
                . self::attr( $sett , 'name' ) . ' '
                . self::urlValue( $sett ) . ' >';
    }

    static function urlValue( $sett )
    {
        $value = null;

        if( isset( $sett[ 'value' ] ) )
            $value = esc_url( $sett[ 'value' ] );
        
        return 'value="' . $value . '"';
    }

    /* TEXT */
    static function text( $sett )
    {
        return '<input type="text" '
                . self::attr( $sett , 'id' ) . ' '
                . self::attr( $sett , 'class' ) . ' '
                . self::attr( $sett , 'name' ) . ' '
                . self::textValue( $sett ) . ' >';
    }
    
    static function textValue( $sett )
    {
        $value = null;

        if( isset( $sett[ 'value' ] ) )
            $value = esc_attr( $sett[ 'value' ] );
        
        return 'value="' . $value . '"';
    }
    
    /* TEXTAREA */
    static function textarea( $sett )
    {
        return '<textarea '
                . self::attr( $sett , 'id' ) . ' '
                . self::attr( $sett , 'class' ) . ' '
                . self::attr( $sett , 'name' ) . '>'
                . self::textareaValue( $sett ) 
                . '</textarea>';
    }
    
    /* TO DO : GET VALIDATOR TYPE */
    static function textareaValue( $sett )
    {
        $value = null;
        
        if( isset( $sett[ 'value' ] ) )
            $value = $sett[ 'value' ];
        
        return $value;
    }
    
    /* MULTIPLE SELECT */
    static function mselect( $sett )
    {
        return '<select '
            . self::attr( $sett , 'id' ) . ' '
            . self::attr( $sett , 'class' ) . ' '
            . self::attr( $sett , 'name' ) .  ' multiple="multiple">'
            . self::mselectValue( $sett ) 
            . '</select>';
    }
    
    static function mselectValue( $sett )
    {
        $values = array();
        
        if( isset( $sett[ 'value' ] ) )
            $values = (array)$sett[ 'value' ];
        
        $rett = '';
        if( isset( $sett[ 'values' ] ) )
            foreach( $sett[ 'values' ] as $index => $v ){
                if( in_array( $index , $values ) ){
                    $rett .= '<option value="' . $index . '" ' . selected( $index , $index , false ) . '>' . $v . '</option>';
                }else{
                    $rett .= '<option value="' . $index . '">' . $v . '</option>';
                }
            }
            
            
        return $rett;
    }
    
    /* SELECT */
    static function select( $sett )
    {
        return '<select '
                . self::attr( $sett , 'id' ) . ' '
                . self::attr( $sett , 'class' ) . ' '
                . self::attr( $sett , 'name' ) .  ' '
                . self::selectAction($sett) . '>'
                . self::selectValue( $sett ) 
                . '</select>';
    }
    
    static function selectValue( $sett )
    {
        $value = null;
        
        if( isset( $sett[ 'value' ] ) )
            $value = $sett[ 'value' ];
        
        $rett = '';
        if( isset( $sett[ 'values' ] ) )
            foreach( $sett[ 'values' ] as $index => $v ){
                $rett .= '<option value="' . esc_attr( $index ) . '" ' . selected( $value , $index , false ) . '>' . esc_html( $v ) . '</option>';
            }
            
        return $rett;
    }

    static function selectAction( $sett )
    {
        $action = '';
        
        if( isset( $sett[ 'action' ] ) )
            $action = "onchange='javascript:mythemes_ahtml.is_selected( this , " . json_encode( $sett[ 'action' ] ) . ");'";
        
        if( isset( $sett[ 'ajax' ] ) )
            $action = "onchange='javascript:" . $sett[ 'ajax' ] . "'";
        
        return $action;
    }

    /* ICON SELECT */
    
    /* LOGIC */
    static function logic( $sett )
    {
        $classes = 'is-off';

        if( isset( $sett[ 'value' ] ) && absint( $sett[ 'value' ] ) )
            $classes = 'is-on';

        if( !isset( $sett[ 'inputClass' ] ) ){
            $sett[ 'inputClass' ] = 'mythemes-input-logic ' . $classes;
        }
        else{
            $sett[ 'inputClass' ] .= 'mythemes-input-logic ' . $classes;
        }

        return '<div '
                . self::attr( $sett , 'id' ) . ' '
                . self::attr( $sett , 'class' ) . ' '
                . self::logicAction( $sett ) . '>'

                . '<span class="mythemes-state">'
                . '<span class="mythemes-on">' . __( 'On' , 'cannyon' ) . '</span>'
                . '<span class="mythemes-off">' . __( 'Off' , 'cannyon' ) . '</span>'
                . '</span>'

                . '<div class="mythemes-state-bkg">'
                . '<div class="mythemes-on"></div>'
                . '<div class="mythemes-null"></div>'
                . '<div class="mythemes-off"></div>'
                . '</div>'

                . '<input type="hidden" '
                . self::attr( $sett , 'name' ) . ' '
                . self::logicValue( $sett ) . '/>'

                . '</div>';
    }

    static function logicValue( $sett )
    {
        $value = 0;

        if( isset( $sett[ 'value' ] ) )
            $value = absint( $sett[ 'value' ] );
        
        return 'value="' . $value . '"';
    }
    
    
    static function logicAction( $sett )
    {
        $action = '';
        
        if( isset( $sett[ 'action' ] ) )
            $action = 'data-action="' . $sett[ 'action' ] . '"';
        
        return $action;
    }
    
    /* COLOR */
    static function color( $sett )
    {
        if( isset( $sett[ 'inputClass' ] ) )
            $sett[ 'inputClass' ] .= ' mythemes-pickcolor';
        else
            $sett[ 'inputClass' ] = 'mythemes-pickcolor';
     
        $inputName = self::name( $sett );
        
        return '<input type="text" '
            . self::attr( $sett , 'id' ) . ' '
            . self::attr( $sett , 'class' ) . ' '
            . self::attr( $sett , 'name' ) . ' '
            . self::attr( $sett , 'data-default-color' ) . ' '
            . self::textValue( $sett ) . '/>';
    }
    
    /* UPLOAD */
    static function upload( $sett )
    {
        /* UPLOAD URL / FILE PATH */
        return '<input type="url" '
            . self::attr( $sett , 'id' ) . ' '
            . self::attr( $sett , 'class' ) . ' '
            . self::attr( $sett , 'name' ) . ' '
            . self::textValue( $sett ) . '>'
        
            /* UPLOAD BUTTON */
            . '<input type="button" class="mythemes-button" '
            . ' value="' . __( 'Choose File' , 'cannyon' ) . '" '
            . ' onclick="javascript:mythemes_ahtml.uploader( this );"/>';
    }

    /* IMAGE SELECT */
    static function image_select( $sett )
    {
        /* DEFAULT PATH */
        if( !isset( $sett[ 'path' ] ) || empty( $sett[ 'path' ] ) ){
            $sett[ 'path' ] = get_template_directory_uri() . self::$image_select_path;
        }

        /* DEFAULT EXT */
        if( !isset( $sett[ 'ext' ] ) || empty( $sett[ 'ext' ] ) ){
            $sett[ 'ext' ] = self::$image_select_ext;
        }

        /* DEFAULT COLS */
        if( !isset( $sett[ 'cols' ] ) || empty( $sett[ 'cols' ] ) ){
            $sett[ 'cols' ] = self::$image_select_cols;
        }

        /* DEFAULT POSITION */
        if( !isset( $sett[ 'pos' ] ) || empty( $sett[ 'pos' ] ) ){
            $sett[ 'pos' ] = self::$image_select_pos;
        }

        /* ADD COLS CLASS */
        if( !isset( $sett[ 'inputClass' ] ) ){
            $sett[ 'inputClass' ] = 'mythemes-input-image-select mythemes-image-select-cols-' . absint( $sett[ 'cols' ] ) . ' '
                                    . 'mythemes-image-select-pos-' . esc_attr( $sett[ 'pos' ] );
        }

        else{
            $sett[ 'inputClass' ] .= ' mythemes-input-image-select mythemes-image-select-cols-' . absint( $sett[ 'cols' ] ) . ' '
                                    . 'mythemes-image-select-pos-' . esc_attr( $sett[ 'pos' ] );
        }

        /* INPUT */
        return '<div ' 
            . self::attr( $sett , 'id' ) . ' '
            . self::attr( $sett , 'class' ) . '>'

            . '<input type="hidden" '
            . self::attr( $sett , 'name' ) . ' '
            . self::textValue( $sett ) . '/>'

            . '<div class="mythemes-image-select-value">'
            . self::image_select_value( $sett )
            . '</div>'

            . '<div class="mythemes-image-select-values">'
            . self::image_select_values( $sett )
            . '</div>'

            . '</div>';
    }

    static function image_select_value( $sett )
    {
        $value = null;
        
        if( isset( $sett[ 'value' ] ) )
            $value = $sett[ 'value' ];

        if( empty( $value ) )
            return '';

        return '<img src="' . esc_url( $sett[ 'path' ] . $value . '.' . $sett[ 'ext' ] ) . '" data-value="' . esc_attr( $value ) . '"/>';
    }

    static function image_select_values( $sett )
    {
        $rett   = '';
        $value  = null;
        
        if( isset( $sett[ 'value' ] ) )
            $value = esc_attr( $sett[ 'value' ] );

        if( isset( $sett[ 'values' ] ) && !empty( $sett[ 'values' ] ) ){
            foreach( $sett[ 'values' ] as $v ){

                $action = '';

                if( isset( $sett[ 'action' ] ) && isset( $sett[ 'action' ][ $v ] ) ){
                    $action = 'data-action="' . esc_attr( $sett[ 'action' ][ $v ] ) . '"';
                }

                if( $value == $v ){

                    $rett .= '<div class="mythemes-image-select-option selected">';
                    $rett .= '<img src="' . esc_url( $sett[ 'path' ] . $v . '.' . $sett[ 'ext' ] ) . '" data-value="' . esc_attr( $v ) . '" ' . $action . '/>';
                    $rett .= '</div>';
                }

                else{
                    $rett .= '<div class="mythemes-image-select-option">';
                    $rett .= '<img src="' . esc_url( $sett[ 'path' ] . $v . '.' . $sett[ 'ext' ] ) . '" data-value="' . esc_attr( $v ) . '" ' . $action . '/>';
                    $rett .= '</div>';
                }
            }
        }

        return $rett;
    }
    
    /* ORIZONTAL TABBER */
    static function tabber( $sett )
    {
        $rett = '';
        $content = '';
        
        $rett .= '<div class="mythemes-tabber">';
        
        $rett .= '<div class="mythemes-tabber-header">';
        $rett .= '<nav>';
        $rett .= '<ul>';
        
        foreach( $sett as $k => $s ){
            $classes = '';
            if( isset( $s[ 'current' ] ) && $s[ 'current' ] )
                $classes = 'current';
            
            $rett .= '<li class="' . $classes . '">' . $s[ 'title' ] . '</li>';
            $content .= '<div class="mythemes-tabber-item ' . $classes . '">';
            $content .= $s[ 'content' ];
            $content .= '</div>';
        }
        
        $rett .= '</ul>';
        $rett .= '</nav>';
        $rett .= '</div>';
        
        $rett .= '<div class="mythemes-tabber-content">';
        $rett .= $content;
        $rett .= '</div>';
        
        $rett .= '</div>';
        
        return $rett;
    }
}

} /* END IF CLASS EXISTS */
?>