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
	// Prepare fakta box render array
	if (isset($variables['field_collection_fakta_box'])) {
		$items = field_get_items('node', $node, 'field_collection_fakta_box');
		$fakta_box = field_view_value('node', $node, 'field_collection_fakta_box', $items[0], array(
			'label' => 'hidden',
			// We just want to render the fields of the field collection
			'type' => 'field_collection_fields',
		));
		$variables['ding_fakta_box'] = $fakta_box;	
	}
  // Eresource variables
  if (isset($variables['content']['#bundle']) && $variables['content']['#bundle'] == 'ding_eresource' && isset($variables['content']['field_ding_eresource_link'])) {
    $items = field_get_items('node', $node, 'field_ding_eresource_link');
    $variables['randerbib_theme_ding_eresource_link_url'] =  $items[0]['url'];
  }
}

/* Entity preprocess function.
 */
function randersbib_theme_preprocess_entity(&$variables) {
	$type = $variables['elements']['#entity_type'];
	$bundle = $variables['elements']['#bundle'];
	// Fakta box field collection
	if ($type == 'field_collection_item' && $bundle == 'field_collection_fakta_box') {
		// Find out if we should show the fakta box
		$entity = $variables['elements']['#entity'];
		$content = $variables['content'];
		$items = field_get_items('field_collection_item', $entity, 'field_ding_fakta_box_show');
		$show = $items[0]['value'];
		if ($show) {
			$show = isset($content['field_ding_fakta_box_title']) && 
				isset($content['field_ding_fakta_box_content']);
		}
		$variables['show'] = $show;
	}
}