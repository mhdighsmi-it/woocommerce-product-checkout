<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 4/30/2021
 * Time: 6:35 PM
 */

namespace SC;


class Course_Metabox
{
    function __construct()
    {
        add_action('add_meta_boxes',function (){
            add_meta_box(
                '_product_checkout_information',       // $id
                'برگه پرداخت',                  // $title
                array($this,'product_checkout_field_cb'),  // $callback
                'product',                 // $page
                'normal',                  // $context
                'high'                     // $priority
            );
        });
        add_action( 'save_post', array($this,'learnpress_save_postdata') );

    }
    function product_checkout_field_cb($post){
        $pages =  get_posts(array(
            'post_type' => 'page',
            'numberposts' => -1,
            'post_status' => 'publish'
        ));
        $field_value = get_post_meta( $post->ID, '_checkout_page_id', true );
        ?>
        <select class=""  id="checkout-page-id" name="checkout-page-id">
            <option value="">صفحه پرداخت</option>
            <?php
            if($pages){
                foreach($pages  as $page){
                    ?>
                    <option value="<?php echo $page->ID; ?>" <?php if($field_value==$page->ID) echo 'selected="selected"'; ?>>
                        <?php
                        echo  $page->post_title;
                        ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>

        <?php
    }
    function learnpress_save_postdata( $post_id ) {

        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        // Check permissions
        if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
        }
        else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        // OK, we're authenticated: we need to find and save the data
        if ( isset ( $_POST['checkout-page-id'] ) ) {
            update_post_meta( $post_id, '_checkout_page_id', $_POST['checkout-page-id'] );
        }

    }

}