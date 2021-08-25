<?php
/**
 * @package
 */
/*
Plugin Name: انتخاب برگه پرداخت برای محصول
Plugin URI: https://soalwp.com/
Description: با این افزونه می توانید برگه ای را برای صفحه پرداخت هر محصولی انتخاب کنید.
Version: 2.1.1
Author: مهدی قاسمی
Author URI: https://soalwp.com/
License: GPLv2
*/

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
define('SC_PATH',plugin_dir_path(__FILE__));
define('SC_DIR',plugin_dir_url(__FILE__));

new \SWPC\Course_Metabox();
new \SWPC\Action();