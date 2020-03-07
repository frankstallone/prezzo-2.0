<?php
/**
 * The template used for displaying portfolio post content
 *
 * @package progression
 * @since progression 1.0
 */
?>
<div class="content-container aligncenter">
	
	<?php if(get_post_meta($post->ID, 'portfoliooptions_twitter_text', true)): ?>
		<!-- Twitter Embed -->
			<div class="twitter-post">
				<div class="twitter-text">
					<?php
					$values = get_post_custom_values('portfoliooptions_twitter_text');
					$shortcode_output = do_shortcode($values[0]);
					print $shortcode_output;										
					?>
				</div>
				<div class="twitter-time-stamp"></div>
			</div><!-- close .twitter-post -->
	<?php else: ?>
		
		<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
			
			<?php if(get_post_meta($post->ID, 'portfoliooptions_text_link', true)): ?>
				<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_text_link', true) ?>" class="hover-icon">
				<div class="zoom-icon article-icon">External Link</div>
			<?php else: ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_text', true)): ?>
				<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_text', true) ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon">
				<div class="zoom-icon video-icon">Video Link</div>
			<?php else: ?>
				<a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon">
				<div class="zoom-icon">Default Zoom</div>
			<?php endif; ?>
			<?php endif; ?>
					<div class="item-load"><?php the_post_thumbnail('progression-portfolio-thumb'); ?></div>
				</a>
		<?php else: ?>
			<?php if(get_post_meta($post->ID, 'portfoliooptions_textarea', true)): ?>
				<!-- iFrame Video Here --><div class="video-container"><?php echo get_post_meta($post->ID, 'portfoliooptions_textarea', true) ?></div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(get_post_meta($post->ID, 'portfoliooptions_text_link', true)): ?>
			<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_text_link', true) ?>">
		<?php else: ?>
			<a href="<?php the_permalink(); ?>">
		<?php endif; ?>
			<div class="content-container-spacing">
				<?php if(get_post_meta($post->ID, 'portfoliooptions_subheadline', true)): ?>
				<h6 class="post-type-header"><?php echo get_post_meta($post->ID, 'portfoliooptions_subheadline', true) ?></h6>
				<?php endif; ?>
				<h4><?php the_title(); ?></h4>
			</div><!-- close .content-container-spacing -->
		</a>
		
	<?php endif; ?>
</div><!-- close .content-container -->