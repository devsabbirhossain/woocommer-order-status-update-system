<?php

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}


add_action('woocommerce_order_status_changed','woo_order_status_change_custom2', 10, 3);
function woo_order_status_change_custom2($order_id, $old_status, $new_status){
    
    $order = wc_get_order( $order_id );
    $order_data = $order->get_data(); //order all information
    $order_status = $order_data['status'];
    $order_billing_first_name = $order_data['billing']['first_name'];

    if(substr($order_billing_phone, 0, 3) != '+82'){
      $order_billing_phone = '+82'.$order_data['billing']['phone'];
    }
    else{
      $order_billing_phone = $order_data['billing']['phone'];
    }


    $order_status = wc_get_order_statuses();
    foreach ($order_status as $key=>$status){
        if($key == 'wc-'.$new_status){
          $msg = get_post_meta(654200, $key.'stit', true);
          $message  = 'Hello '.$order_billing_first_name.', Your Order ID#'.$order_id.' '.$msg;
          do_action('danbisms_send', $order_billing_phone, 'Hi', $message);
        }
    }
}