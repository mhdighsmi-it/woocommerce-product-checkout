<?php


namespace SC;


class Action
{
    function __construct()
    {
        add_filter( 'woocommerce_get_checkout_url', array($this,'filter_function_checkout_url'),9999999 );
    }
    function filter_function_checkout_url( $checkout_url ){
        if ( !WC()->cart->is_empty()){
           foreach ( WC()->cart->get_cart() as $cart_item ) { 
                $product_id=$cart_item['product_id'];
                $page_id= get_post_meta($product_id,'_checkout_page_id',true);
                if($page_id)
                   break;
            }
           if($page_id){
            $checkout_url=get_permalink( $page_id );
           }
        }
         return  $checkout_url; 
}
  

}