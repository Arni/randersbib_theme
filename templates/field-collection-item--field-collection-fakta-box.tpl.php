<?php

/**
 * @file
 * Theme for a fakta-box field-collection.
 *
 * Available variables:
 * - $content: The content of this fakta box. (title and main content).
 * - $show: Whether the fakta box should shown or not.
 */
?>

<?php if ($show): ?>
  <div class="<?php print $classes; ?> ding-fakta-box clearfix" <?php print $attributes; ?>>
    <div class="content-wrapper"<?php print $content_attributes; ?>>
      <div class="ding-fakta-box-title">
        <h3>
          <?php print render($content['field_ding_fakta_box_title']); ?>
        </h3>
      </div>
      <div class="ding-fakta-box-content">
        <?php print render($content['field_ding_fakta_box_content']); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
