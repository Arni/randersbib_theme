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
	  <div class="content"<?php print $content_attributes; ?>>
	    <?php
	      print render($content);
	    ?>
	  </div>
	</div>
<?php endif; ?>
