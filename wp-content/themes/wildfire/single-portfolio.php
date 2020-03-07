<?php get_header(); ?>

<?php
while(have_posts()): the_post();
?>

</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">

<?php if(of_get_option('portfolio_sidebar_single', '0')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
	<div class="content-container">
		
		<?php if(get_post_meta($post->ID, 'portfoliooptions_textarea', true)): ?>
		<div class="flexslider">
			<ul class="slides">
				<!-- iFrame Video Here --><li><?php echo get_post_meta($post->ID, 'portfoliooptions_textarea', true) ?></li>
			</ul>
	    </div>
		<?php else: ?>
			<?php
			$args = array(
			    'post_type' => 'attachment',
			    'numberposts' => '-1',
			    'post_status' => null,
			    'post_parent' => get_the_ID(),
				'orderby' => 'menu_order',
				'order' => 'ASC',
			);
			$attachments = get_posts($args);
			if($attachments):
			?>
			<div class="flexslider">
		      <ul class="slides">
				<?php foreach($attachments as $attachment): ?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
					<?php if(of_get_option('portfolio_single_uncrop', '1')): ?>
						<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'progression-single'); ?>
					<?php else: ?>
						<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'progression-single-uncropped'); ?>
					<?php endif; ?>
		        <li>
					<a href="<?php echo $attachment_image[0]; ?>" rel="prettyPhoto[gallery]">
						<img src="<?php echo $attachment_image2[0]; ?>" alt="" >
					</a>
		        </li>
				<?php endforeach; ?>
			</ul>
		    </div>
			<?php endif; ?>
		
		<?php endif; ?>
		
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		    $('.flexslider').flexslider({
				animation: "<?php echo of_get_option('slider_animation_portfolio', 'fade'); ?>",              //String: Select your animation type, "fade" or "slide"
				slideshow: <?php echo of_get_option('slider_autoplay_play_portfolio', true); ?>,                //Boolean: Animate slider automatically
				slideshowSpeed: <?php echo of_get_option('slider_autoplay_portfolio', 6500); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 500,         //Integer: Set the speed of animations, in milliseconds
				directionNav: <?php echo of_get_option('slider_navigation_portfolio', true); ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: <?php echo of_get_option('slider_bullets_portfolio', true); ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Previous",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: false,               //Boolean: Create pause/play dynamic element
				pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
				playText: 'Play',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				useCSS: true,
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		    });
		});
		</script>
		

	<?php $cc = get_the_content(); if($cc != '') { ?>
	<div class="container-spacing">
		<?php the_content(); ?>
		<div class="clearfix"></div>
	</div><!-- close .content-container-spacing -->
	<?php } ?>
	
</div><!-- close .content-container -->

<?php endwhile; ?>

<?php if(of_get_option('portfolio_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<div class="clearfix"></div>
<?php if(of_get_option('portfolio_sidebar_single', '0')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>