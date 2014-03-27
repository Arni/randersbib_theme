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
			// We just want to render the fields of the field collection
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
	$type = $variables['elements']['#entity_type'];
	$bundle = $variables['elements']['#bundle'];
	$content = $variables['content'];
	// Special handling if this entity is a Fakta box field collection.
	if ($type == 'field_collection_item' && $bundle == 'field_collection_fakta_box') {
		// Find out if we should show the fakta box.
		$items = field_get_items('field_collection_item', $entity, 'field_ding_fakta_box_show');
		$show = $items[0]['value'];
		if ($show) {
			$show = isset($content['field_ding_fakta_box_title']) && 
				isset($content['field_ding_fakta_box_content']);
		}
		$variables['show'] = $show;
	}
}