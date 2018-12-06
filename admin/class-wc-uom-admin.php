<?php
/**
 * The admin specific functionality for WooCommerce RRP.
 *
 * @author     Bradley Davis
 * @package    WooCommerce_RRP
 * @subpackage WooCommerce_RRP/includes
 * @since      3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly.
endif;

/**
 * Admin parent class that pulls everything together.
 *
 * @since 3.0.0
 */
class WC_UOM_Admin {
	/**
	 * The Constructor.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		$this->wc_uom_admin_activate();
	}

	/**
	 * Add all filter type actions.
	 *
	 * @since 3.0.0
	 */
	public function wc_uom_admin_activate() {
		add_action( 'woocommerce_product_options_inventory_product_data', array( $this, 'wc_uom_product_fields' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'wc_uom_save_field_input' ) );
	}

	/**
	 * Add the custom fields or the UOM to the prodcut general tab.
	 *
	 * @since 3.0.0
	 */
	public function wc_uom_product_fields() {
		echo '<div class="wc_uom_input">';
			// Woo_UOM fields will be created here.
			woocommerce_wp_text_input(
				array(
					'id'          => '_woo_uom_input',
					'label'       => __( 'Unit of Measure', 'woo_uom' ),
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __( 'Enter your unit of measure for this product here.', 'woo_uom' ),
				)
			);
		echo '</div>';
	}

	/**
	 * Update the database with the new input
	 *
	 * @since 1.0
	 */
	public function wc_uom_save_field_input( $post_id ) {
		// Woo_UOM text field.
		$woo_uom_input = $_POST['_woo_uom_input'];
		update_post_meta( $post_id, '_woo_uom_input', esc_attr( $woo_uom_input ) );
	}

}

/**
 * Instantiate the class
 *
 * @since 3.0.0
 */
$wc_uom_admin = new WC_UOM_Admin();
