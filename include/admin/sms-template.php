<?php


if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

/**
 * Sub menu class
 *
 * @author sabbir hossain
 */
class Sms_Template_WC {

	/**
	 * Autoload method
	 * @return void
	 */
    public $con = 0011555;

	public function __construct() {
		add_action( 'admin_menu', array(&$this, 'register_sub_menu') );
	}

	/**
	 * Register submenu
	 * @return void
	 */
	public function register_sub_menu() {
		add_submenu_page( 
			'woocommerce', 'WC SMS Template', 'WC SMS Template', 'manage_options', 'wc-sms-template', array(&$this, 'woocommerce_order_sms_template_callback')
		);
	}

	/**
	 * Render submenu
	 * @return void
	 */
	public function woocommerce_order_sms_template_callback() {
            if(isset($_POST['submit'])){
                $order_status = wc_get_order_statuses();
                foreach ($order_status as $key=>$status){
                    if($_POST['order-status-message-'.$key]){
                        update_post_meta( 654200, $key.'stit' , $_POST['order-status-message-'.$key] );
                    }
                }
            }

        ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"></div>
                <h2>Woo-Commerce Custom SMS Template</h2>
            </div>

            

            <div>
                <form action="" method="POST">
                    <div class="form-group my-3">
                        <label for="order-status" class="my-1 col-sm-2 control-label">Order Process Status</label>
                        <select name="order-status" class="form-control" id="order-status">
                            <option value="" selected>--Select Status--</option>
                            <?php
                                $order_status = wc_get_order_statuses();
                                $counter = count($order_status);
                                foreach ($order_status as $key=>$status){
                                    echo '<option value="'.$key.'">'.$status.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <?php foreach ($order_status as $key=>$status): ?>
                    <div class="form-group my-3 hide-text" id="<?php echo $key; ?>">
                        <div class="row">
                            <div class="col">
                                <label for="order-status-message-<?php echo $key; ?>" class="my-1 col-sm-2 control-label label-sms">Enter <?php echo $status; ?> SMS Text</label>
                                <textarea name="order-status-message-<?php echo $key; ?>" id="order-status-message-<?php echo $key; ?>" cols="30" rows="10" class="form-control" ><?php if(get_post_meta(654200, $key.'stit', true)){ echo get_post_meta(654200, $key.'stit', true);} ?></textarea>
                            </div>
                            <div class="col">
                                <label for="preview-sms-text" class="my-1 col-sm-2 control-label label-sms"><span class="preview">Order Status <?php echo $status; ?> SMS Preview:</span></label>
                                <textarea name="preview-sms-text" id="preview-sms-text" cols="30" rows="10" class="form-control" disabled>Hello {customer_first_name}, Your Order ID#{order_id} <?php if(get_post_meta(654200, $key.'stit', true)){ echo get_post_meta(654200, $key.'stit', true);} ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <input type="submit" name="submit" value="Save" class="btn btn-primary my-1">
                </form>
            </div>
        <?php

        
	}

}

new Sms_Template_WC();
