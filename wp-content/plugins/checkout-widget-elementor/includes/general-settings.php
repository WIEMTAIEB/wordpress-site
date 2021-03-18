<?php 
$prefix = 'ecw_';

			$ecw_panel = new_cmb2_box( array(
			'id'            => $prefix . 'ecw_checkout',
			'title'         => __( 'Elementor Checkout', 'ecw-checkout-widget' ),
			'object_types' => array( 'options-page' ),
			'option_key'      => 'ecw_checkout_settings', 
		    'icon_url'        => 'dashicons-layout',
			'position'        => 59,
			
			) );

			/*general setting panel*/		
					
			$ecw_panel->add_field( array(
				'name' => esc_html__( 'Skip Cart page', 'ecw-checkout-widget' ),
				'desc' => esc_html__( 'Select if you want to skip your cart page(Recommended)', 'ecw-checkout-widget' ),
				'id'   => $prefix .'skip_cart',
				'type' => 'checkbox',
	       ) );
		   
		  $installation_steps = '<h3>Installation steps</h3>
		  <p>Donot know how to setup the plugin? <h4><a href="https://blueplugins.com/docs/checkout-widgets-for-elementor-pro/installation/">Read the Installation steps here.</a></h4> 
		  IMP:-Remember to Add some products to cart before editing checkout page.</p>
		  <h3>Want to start with some dummy layouts?</h3></br>
				<a href="https://blueplugins.com/download-elementor-checkout-templates">Click here</a> to download layouts and import into your checkout page.
				 <h3>A video Tour</h3>
				 <a href="https://www.youtube.com/watch?v=KmaV9qHnqLM">Click here</a> for video demo';
		   $ecw_panel->add_field( array(
				'name' => '',
				'desc' => $installation_steps,
				'type' => 'title',
				'id'   => $prefix .'title',
			) );
			
			
		
			?>