<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="searchform">
    <fieldset>
        <div id="searchbox">
            <input type="text" name="s"  id="keywords" value="<?php _e( 'type here...' , 'cannyon' ); ?>" onfocus="if (this.value == '<?php _e( 'type here...' , 'cannyon' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'type here...' , 'cannyon' ); ?>';}">
            <button type="submit"><i class="mythemes-icon-search-5"></i></button>
        </div>
    </fieldset>
</form>