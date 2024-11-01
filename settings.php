<?php

add_action( 'admin_menu', 'wat_add_admin_menu' );
add_action( 'admin_init', 'wat_settings_init' );

function wat_add_admin_menu(  ) { 

	add_options_page( 'Wave Admin Theme', 'Wave Admin Theme', 'manage_options', 'wave_admin_theme', 'wave_admin_theme_options_page' );

}

function wat_settings_exist(  ) { 

	if( false == get_option( 'wave_admin_theme_settings' ) ) { 

		add_option( 'wave_admin_theme_settings' );

	}

}

function wat_settings_init(  ) { 

	register_setting( 'pluginPage', 'wat_settings' );

	add_settings_section(
		'wat_pluginPage_section', 
		__( 'Settings', 'wave-admin-theme' ), 
		'wat_settings_section_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'wat_checkbox_field_7', 
		__( 'WordPress Logo', 'wave-admin-theme' ), 
		'wat_checkbox_field_7_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);

	add_settings_field( 
		'wat_checkbox_field_5', 
		__( 'Screen Options Tab', 'wave-admin-theme' ), 
		'wat_checkbox_field_5_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);
	
	add_settings_field( 
		'wat_checkbox_field_4', 
		__( 'Help Tab', 'wave-admin-theme' ), 
		'wat_checkbox_field_4_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);	

	add_settings_field( 
		'wat_text_field_0', 
		__( 'Left Footer Text', 'wave-admin-theme' ), 
		'wat_text_field_0_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);

	add_settings_field( 
		'wat_text_field_1', 
		__( 'Right Footer Text', 'wave-admin-theme' ), 
		'wat_text_field_1_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);

	add_settings_field( 
		'wat_checkbox_field_6', 
		__( 'Color Scheme Picker', 'wave-admin-theme' ), 
		'wat_checkbox_field_6_render', 
		'pluginPage', 
		'wat_pluginPage_section' 
	);

}

function wat_checkbox_field_7_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='checkbox' name='wat_settings[wat_checkbox_field_7]' <?php checked( $options['wat_checkbox_field_7'], 1 ); ?> value='1'> 
	Remove the WordPress Logo from the toolbar
	<?php

}

function wat_checkbox_field_5_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='checkbox' name='wat_settings[wat_checkbox_field_5]' <?php checked( $options['wat_checkbox_field_5'], 1 ); ?> value='1'> 
	Hiding the Screen Options Tab
	<?php

}

function wat_checkbox_field_6_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='checkbox' name='wat_settings[wat_checkbox_field_6]' <?php checked( $options['wat_checkbox_field_6'], 1 ); ?> value='1'> 
	Remove the Admin Color Scheme Picker from the profile page
	<?php

}

function wat_text_field_0_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='text' name='wat_settings[wat_text_field_0]' value='<?php echo $options['wat_text_field_0']; ?>' class='regular-text'> 
	<?php

}

function wat_text_field_1_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='text' name='wat_settings[wat_text_field_1]' value='<?php echo $options['wat_text_field_1']; ?>' class='regular-text'>
	<?php

}

function wat_checkbox_field_4_render(  ) { 

	$options = get_option( 'wat_settings' );
	?>
	<input type='checkbox' name='wat_settings[wat_checkbox_field_4]' <?php checked( $options['wat_checkbox_field_4'], 1 ); ?> value='1'> 
	Hide Admin Help Tab
	<?php

}

function wat_settings_section_callback(  ) { 

	echo __( 'Customize the WordPress admin theme.', 'wave-admin-theme' );

}

function wave_admin_theme_options_page(  ) { 

	?>
	<div class="wrap">
	<h2>Wave Admin Theme</h2>
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	</div>
	<?php

}

?>