<?php
/*
 * Plugin Name: Xunhu unionpay Payment For WooCommerce
 * Plugin URI: http://www.wpweixin.net
 * Description: Xunhu-Woo-Unionpay provide unionpay gateway for woocommerce.
 * Author: xunhuweb
 * Version: 1.0.0
 * Author URI:  http://www.wpweixin.net
 * Text Domain: woocommerce,银联网银支付,UnionPay,baifubao,百付宝,woo
 */

if (! defined ( 'ABSPATH' ))
	exit (); // Exit if accessed directly

if (! defined ( 'XH_WY_Payment' )) {define ( 'XH_WY_Payment', 'XH_WY_Payment' );} else {return;}
define ( 'XH_WY_Payment_VERSION', '1.0.2');
define ( 'XH_WY_Payment_ID', 'xh-wy-payment-wc');
define ( 'XH_WY_Payment_FILE', __FILE__);
define ( 'XH_WY_Payment_DIR', rtrim ( plugin_dir_path ( XH_WY_Payment_FILE ), '/' ) );
define ( 'XH_WY_Payment_URL', rtrim ( plugin_dir_url ( XH_WY_Payment_FILE ), '/' ) );
load_plugin_textdomain( XH_WY_Payment, false,dirname( plugin_basename( __FILE__ ) ) . '/lang/'  );

add_filter ( 'plugin_action_links_'.plugin_basename( XH_WY_Payment_FILE ),'xh_wy_payment_plugin_action_links',10,1 );
function xh_wy_payment_plugin_action_links($links) {
    return array_merge ( array (
        'settings' => '<a href="' . admin_url ( 'admin.php?page=wc-settings&tab=checkout&section='.XH_WY_Payment_ID ) . '">'.__('Settings',XH_WY_Payment).'</a>'
    ), $links );
}
if(!class_exists('WC_Payment_Gateway')){
    return;
}

require_once XH_WY_Payment_DIR.'/class-wy-wc-payment-gateway.php';
global $XH_WY_Payment_WC_Payment_Gateway;
$XH_WY_Payment_WC_Payment_Gateway= new XH_WY_Payment_WC_Payment_Gateway();

add_action('init', array($XH_WY_Payment_WC_Payment_Gateway,'notify'),10);