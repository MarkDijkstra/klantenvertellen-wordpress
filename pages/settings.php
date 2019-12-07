<?php
   
    if ( isset( $_POST['submit'] ) && !empty($_POST['xmlsource'])) {        
        
        WP_Klantenvertellen_Process::processSource($_POST['xmlsource']);

        ?>

        <div id="message" class="updated notice is-dismissible">
            <p><?php _e('Reviews opgeslagen', 'klantenvertellen'); ?></p><button type="button" class="notice-dismiss">
            <span class="screen-reader-text">Dismiss this notice.</span></button>
        </div>

<?php } ?>

<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('Settings', 'klantenvertellen'); ?>
    </h1>
    <br/>
    <br/>
    <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post">

        <div id="col-container">
            <?php 
            
                if (!ini_get('allow_url_fopen')) {

                    echo 'allow_url_fopen is not set to On, you need to change the php.ini file for this!';
                }

            
            ?>
            
            <div id="col-left">
                <div class="form-field form-required">
                    <label for="field-1">Klantenvertellen Source URL:</label>
                    <input type="text" id="field-1" name="xmlsource" value="<?= $_POST['xmlsource']?>"/>
                </div>
                <br/>
                <button type="submit" class="button button-primary" name="submit">Save</button>
            </div>
        </div>

    </form>
</div>