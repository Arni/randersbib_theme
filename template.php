<?php

/**
 * @file
 *
 * Preprocess and process functions.
 */

/**
 * Node preprocess function.
 */
function randersbib_theme_preprocess_node(&$variables) {
	$node = $variables['node'];
	// If the node has the fakta-box field prepare its render array.
	if (field_info_instance('node', 'field_collection_fakta_box', $node->type)) {
		$items = field_get_items('node', $node, 'field_collection_fakta_box');
		$fakta_box = field_view_value('node', $node, 'field_collection_fakta_box', $items[0], array(
			'label' => 'hidden',
			'type' => 'field_collection_fields',
		));
		$variables['ding_fakta_box'] = drupal_render($fakta_box);	
	}
}

/**
 * Entity preprocess function.
 */
function randersbib_theme_preprocess_entity(&$variables) {
	$entity = $variables['elements']['#entity'];
	// Special handling if this entity is a Fakta box field collection.
	if (isset($entity->field_name) && $entity->field_name == 'field_collection_fakta_box') {
		file_put_contents("/home/drupalpro/debug/debug.txt", print_r($entity->field_name , TRUE), FILE_APPEND);
	}
}