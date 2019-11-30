<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Reviews', 'klantenvertellen'); ?></h1>
    <br/>
    <br/>
    <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post">

        <div id="col-container">
            <div id="col-left">
                <div class="form-field form-required">
                    <label for="field-1">Klantenvertellen target URL:</label>
                    <input type="text" id="field-1" name=""/>
                </div>
                <br/>
                <button type="submit" class="button button-primary">Save</button>
            </div>
        </div>

    </form>
</div>