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
    $variables['randerbib_theme_ding_eresource_link_url'] = $items[0]['url'];
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

/**
 * Implements hook_preprocess_ting_object().
 *
 * Adds wrapper classes to the different groups on the ting object.
 */
function randersbib_theme_preprocess_ting_object(&$vars) {
  if (isset($vars['elements']['#view_mode']) && $vars['elements']['#view_mode'] == 'full') {
    switch ($vars['elements']['#entity_type']) {
      case 'ting_object':
        $content = $vars['content'];
        $vars['content'] = array();

        if (isset($content['group_ting_object_left_column']) && $content['group_ting_object_left_column']) {
          $vars['content']['ting-object'] = array(
            '#prefix' => '<div class="ting-object-wrapper">',
            '#suffix' => '</div>',
            'content' => array(
              '#prefix' => '<div class="ting-object-inner-wrapper">',
              '#suffix' => '</div>',
              'left_column' => $content['group_ting_object_left_column'],
              'right_column' => $content['group_ting_object_right_column'],
            ),
          );

          unset($content['group_ting_object_left_column']);
          unset($content['group_ting_object_right_column']);
        }

        if (isset($content['group_holdings_available']) && $content['group_holdings_available']) {
          $vars['content']['holdings-available'] = array(
            '#prefix' => '<div class="ting-object-wrapper">',
            '#suffix' => '</div>',
            'content' => array(
              '#prefix' => '<div class="ting-object-inner-wrapper">',
              '#suffix' => '</div>',
              'details' => $content['group_holdings_available'],
            ),
          );
          unset($content['group_holdings_available']);
        }

        if (isset($content['group_periodical_issues']) && $content['group_periodical_issues']) {
          $vars['content']['periodical-issues'] = array(
            '#prefix' => '<div class="ting-object-wrapper">',
            '#suffix' => '</div>',
            'content' => array(
              '#prefix' => '<div class="ting-object-inner-wrapper">',
              '#suffix' => '</div>',
              'details' => $content['group_periodical_issues'],
            ),
          );
          unset($content['group_periodical_issues']);
        }

        if (isset($content['group_material_details']) && $content['group_material_details']) {
          $vars['content']['material-details'] = array(
            '#prefix' => '<div class="ting-object-wrapper">',
            '#suffix' => '</div>',
            'content' => array(
              '#prefix' => '<div class="ting-object-inner-wrapper">',
              '#suffix' => '</div>',
              'details' => $content['group_material_details'],
            ),
          );
          unset($content['group_material_details']);
        }


        if (isset($content['group_on_this_site']) && $content['group_on_this_site']) {
          $vars['content']['on_this_site'] = array(
            '#prefix' => '<div class="ting-object-wrapper">',
            '#suffix' => '</div>',
            'content' => array(
              '#prefix' => '<div id="ting_reference" class="ting-object-inner-wrapper">',
              '#suffix' => '</div>',
              'details' => $content['group_on_this_site'],
            ),
          );
          unset($content['group_on_this_site']);
        }

        if (isset($content['ting_relations']) && $content['ting_relations']) {
          $vars['content']['ting-relations'] = array(
            'content' => array(
              'details' => $content['ting_relations'],
            ),
          );
          unset($content['ting_relations']);
        }

        // Move the reset over if any have been defined in the UI.
        if (!empty($content)) {
          $vars['content'] += $content;
        }
        break;

      case 'ting_collection':
        // Assumes that field only has one value.
        foreach ($vars['content']['ting_entities'][0] as &$type) {
          $type['#prefix'] = '<div class="ting-collection-wrapper"><div class="ting-collection-inner-wrapper">' . $type['#prefix'];
          $type['#suffix'] = '</div></div>';
        }
        break;
    }
  }
}
