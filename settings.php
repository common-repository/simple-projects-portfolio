<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

defined( 'ABSPATH' ) or die( 'Direct access to this code is not allowed.' );

/**
 * custom option and settings
 */
function simple_pp_settings_init() {
	// register a new setting for "simple_pp" page
	register_setting( 'simple_pp', 'simple_pp_options' );
	
	// register a new section in the "simple_pp" page
	add_settings_section(
			'simple_pp_section_developers',
			'Layout 1',
			'simple_pp_section_developers_cb',
			'simple_pp'
	);
	
	add_settings_section(
			'simple_pp_section_developers_2',
			'Layout 2',
			'simple_pp_section_developers_cb',
			'simple_pp'
	);
	
	/****************************************************************
	 * Layout 1
	 ****************************************************************/
	
	// space between
	add_settings_field(
			'simple_pp_field_has_space', 
			// use $args' label_for to populate the id inside the callback
			'Put space between sections?',
			'simple_pp_field_has_space_cb',
			'simple_pp',
			'simple_pp_section_developers',
			[
					'label_for' => 'simple_pp_field_has_space',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// text
	add_settings_field(
			'simple_pp_field_layout1_text',
			// use $args' label_for to populate the id inside the callback
			'Custom Title (leave blank to hide)',
			'simple_pp_field_custom_text_cb',
			'simple_pp',
			'simple_pp_section_developers',
			[
					'label_for' => 'simple_pp_field_layout1_text',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// text background color
	add_settings_field(
			'simple_pp_field_layout1_text_color',
			// use $args' label_for to populate the id inside the callback
			'Title Background Color (accepts colors such as "red" or "blue", and accepts hexidecimal colors, such as "#FF4500")',
			'simple_pp_field_custom_text_color',
			'simple_pp',
			'simple_pp_section_developers',
			[
					'label_for' => 'simple_pp_field_layout1_text_color',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// height
	add_settings_field(
			'simple_pp_field_layout1_height',
			// use $args' label_for to populate the id inside the callback
			'Height (in pixels)',
			'simple_pp_field_custom_layout1_height',
			'simple_pp',
			'simple_pp_section_developers',
			[
					'label_for' => 'simple_pp_field_layout1_height',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// word count
	add_settings_field(
			'simple_pp_field_layout1_wordcount',
			// use $args' label_for to populate the id inside the callback
			'Word Count (content will be stripped to this amount of words)',
			'simple_pp_field_custom_layout1_wordcount',
			'simple_pp',
			'simple_pp_section_developers',
			[
					'label_for' => 'simple_pp_field_layout1_wordcount',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);

	/**********************************************************************************
	 * Layout 2
	 *********************************************************************************/
	
	// height
	add_settings_field(
			'simple_pp_field_layout2_height',
			'Height (in pixels)',
			'simple_pp_field_custom_layout2_height',
			'simple_pp',
			'simple_pp_section_developers_2',
			[
					'label_for' => 'simple_pp_field_layout2_height',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// word count
	add_settings_field(
			'simple_pp_field_layout2_wordcount',
			'Word Count (content will be stripped to this amount of words)',
			'simple_pp_field_custom_layout2_wordcount',
			'simple_pp',
			'simple_pp_section_developers_2',
			[
					'label_for' => 'simple_pp_field_layout2_wordcount',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);
	
	// background color
	add_settings_field(
			'simple_pp_field_layout2_color',
			// use $args' label_for to populate the id inside the callback
			'Hover Background Color (accepts colors such as "red" or "blue", and accepts hexidecimal colors, such as "#FF4500")',
			'simple_pp_field_custom_layout2_color',
			'simple_pp',
			'simple_pp_section_developers_2',
			[
					'label_for' => 'simple_pp_field_layout2_color',
					'class' => 'simple_pp_row',
					'simple_pp_custom_data' => 'custom',
			]
	);	
}

/**
 * register our simple_pp_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'simple_pp_settings_init' );



/**********************************************************************************
 * Layout 1
 *********************************************************************************/
function simple_pp_section_developers_cb( $args ) {
	//echo 'These settings are for the [spp_layout1] shortcode. If you are changing the height and word count from their defaults, make sure you test your projects.';
}
 

function simple_pp_field_has_space_cb( $args ) {
	// get the value of the setting we've registered with register_setting()
	$options = get_option( 'simple_pp_options' );
	// output the field
	?>
	<select id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
	 	
		<option value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], '1', false ) ) : ( '' ); ?>>Yes</option>
		<option value="0" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], '0', false ) ) : ( '' ); ?>>No</option>
		 
	</select>
	<?php
}

function simple_pp_field_custom_text_cb( $args ) {
	
	$options = get_option('simple_pp_options' );
	
	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="text" 
		value="<?php echo ( isset( $options['simple_pp_field_layout1_text'] ) ? $options['simple_pp_field_layout1_text'] : '' ); ?>"
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

function simple_pp_field_custom_text_color($args) {
	$options = get_option('simple_pp_options' );
	
	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="text" 
		value="<?php echo ( isset( $options['simple_pp_field_layout1_text_color'] ) ? $options['simple_pp_field_layout1_text_color'] : '' ); ?>"
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

function simple_pp_field_custom_layout1_height( $args ) {
	
	$options = get_option('simple_pp_options' );
	
	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="number" 
		min="1"
		value="<?php echo (empty($options['simple_pp_field_layout1_height']) ? 500 : $options['simple_pp_field_layout1_height']); ?>"
		step="1" 
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

function simple_pp_field_custom_layout1_wordcount( $args ) {
	
	$options = get_option('simple_pp_options' );

	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="number" 
		value="<?php echo (empty($options['simple_pp_field_layout1_wordcount']) ? 40 : $options['simple_pp_field_layout1_wordcount']); ?>"
		min="0"
		step="1"
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

/**********************************************************************************
 * Layout 2
 *********************************************************************************/
function simple_pp_field_custom_layout2_height( $args ) {
	
	$options = get_option('simple_pp_options' );
	
	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="number" 
		min="1"
		value="<?php echo (empty($options['simple_pp_field_layout2_height']) ? 500 : $options['simple_pp_field_layout2_height']); ?>"
		step="1" 
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

function simple_pp_field_custom_layout2_wordcount( $args ) {
	
	$options = get_option('simple_pp_options' );

	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="number" 
		value="<?php echo (empty($options['simple_pp_field_layout2_wordcount']) ? 40 : $options['simple_pp_field_layout2_wordcount']); ?>"
		min="0"
		step="1"
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}

function simple_pp_field_custom_layout2_color ( $args ) {
	$options = get_option('simple_pp_options' );
	
	?>
	<input 
		id="<?php echo esc_attr( $args['label_for'] ); ?>" 
		type="text" 
		value="<?php echo ( isset( $options['simple_pp_field_layout2_color'] ) ? $options['simple_pp_field_layout2_color'] : '' ); ?>"
		data-custom="<?php echo esc_attr( $args['simple_pp_custom_data'] ); ?>" 
		name="simple_pp_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	/>
	<?php
}






/**
 * top level menu
 */
function simple_pp_options_page() {
 	// add top level menu page
	add_menu_page(
	 	'Simple Projects Portfolio - Options',
	 	'SPP Options',
	 	'manage_options',
	 	'simple_pp',
	 	'simple_pp_options_page_html'
 	);
}
 
/**
 * register our simple_pp_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'simple_pp_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function simple_pp_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	 
	// add error/update messages
	 
	// check if the user have submitted the settings
	// wordpress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
	// add settings saved message with the class of "updated"
		add_settings_error( 'simple_pp_messages', 'simple_pp_message','Settings Saved', 'updated' );
	}
	 
	// show error/update messages
	settings_errors( 'simple_pp_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		 
			<?php
			// output security fields for the registered setting "simple_pp"
			settings_fields( 'simple_pp' );
			// output setting sections and their fields
			// (sections are registered for "simple_pp", each field is registered to a specific section)
			do_settings_sections( 'simple_pp' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
		 
		</form>
	</div>
	<?php
}