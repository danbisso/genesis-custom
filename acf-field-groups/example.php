<?php 

/************

Fields for 'example.php' page template

************/
$slug = 'example';

acf_add_local_field_group(array (
	'key' => "group_{$slug}",
	'title' => __( 'Example Fields', 'genesis-custom' ),
	'fields' => array (
/************

Example text

************/
		array(
			'key' => "field_{$slug}_text",
			'label' => __( 'Example Text', 'genesis-custom' ),
			'name' => 'example_text',
			'type' => 'text',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'example.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));