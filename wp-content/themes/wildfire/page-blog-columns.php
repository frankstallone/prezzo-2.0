<?php
// Template Name: Blog w/ Columns
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">
<?php endwhile; // end of the loop. ?>


<?php if(of_get_option('blog_sidebar', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>


<div id="mason-layout" class="transitions-enabled fluid">
	<?php



	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}



	query_posts( array( 'post_type' => 'post', 'paged' => $paged
	 ) );


	// begin the loop
	if ( have_posts() ) : while ( have_posts() ) : the_post();


	?>


	<div class="boxed-mason col<?php echo of_get_option('blog_columns_count', '3'); ?>">
		
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content-container aligncenter">
				<?php if(get_post_meta($post->ID, 'videoembed_textarea', true)): ?>
					<!-- iFrame Video Here --><div class="video-container"><?php echo get_post_meta($post->ID, 'videoembed_textarea', true) ?></div>
				<?php else: ?>
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>" class="hover-icon">
							<div class="zoom-icon article-icon">zoom</div>
							<div class="item-load"><?php the_post_thumbnail('progression-portfolio-thumb'); ?></div>
					<?php endif; ?>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>">
					<div class="content-container-spacing">
						<h6 class="post-type-header"><?php _e('Blog','progression'); ?></h6>
						<h4><?php the_title(); ?></h4>
					</div><!-- close .content-container-spacing -->
				</a>
				
			</div><!-- close .content-container -->
		</div><!-- #post-<?php the_ID(); ?> -->
		
		</div>
		
	
<?php endwhile; ?>	
	
	
	</div><!-- close #mason-layout -->
	<div class="clearfix"></div>
	
	
	
	
	<?php if(of_get_option('portfolio_normal_pagination', '0')): ?>
		<br>
		<!-- normal pagination -->
		<?php kriesi_pagination($pages = '', $range = 2); ?>
		<!-- end normal pagination -->
	<?php else: ?>
		<!-- infinite scroll -->
		<?php if(of_get_option('portfolio_infinite_scroll', '1')): ?><div class="load-more-manual"><?php endif; ?>
		<?php infinite_kriesi_pagination($pages = '', $range = 1); ?>
		<?php if(of_get_option('portfolio_infinite_scroll', '1')): ?></div><?php endif; ?>
		<!-- end infinite scroll -->
	<?php endif; ?>
	
	

	


	<script>
	jQuery(document).ready(function($) {
				var $container = $('#mason-layout');
				$container.imagesLoaded(function(){
				  $container.masonry({
				    itemSelector : '.boxed-mason'
				  });
				});

			    $('#mason-layout').masonry({
			      itemSelector: '.boxed-mason',
			      // set columnWidth a fraction of the container width
			      columnWidth: function( containerWidth ) {
			        return containerWidth / <?php echo of_get_option('blog_columns_count', '3'); ?>;
			      }
			    });
				
				<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) : ?>
				$container.infinitescroll({
			      navSelector  : '#page-nav',    // selector for the paged navigation 
			      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
			      itemSelector : '.boxed-mason',     // selector for all items you'll retrieve
			      loading: {
					msgText  : '<?php _e( "Loading new posts...", "progression" ); ?>',      
			          finishedMsg: '<?php _e( "No more pages to load.", "progression" ); ?>',
			          img: 'https://i.imgur.com/6RMhx.gif'
			        }
			      },
			      // trigger Masonry as a callback

			      function( newElements ) {
			        // hide new items while they are loading
			        var $newElems = $( newElements ).css({ opacity: 0 });
			        // ensure that images load before adding to masonry layout
			        $newElems.imagesLoaded(function(){
			          // show elems now they're ready
			          $newElems.animate({ opacity: 1 });

					$container.masonry( 'appended', $newElems, true ); 

			$("a[rel^='prettyPhoto']").prettyPhoto({
				animation_speed: 'fast', /* fast/slow/normal */
				slideshow: 5000, /* false OR interval time in ms */
				autoplay_slideshow: false, /* true/false */
				opacity: 0.80, /* Value between 0 and 1 */
				show_title: false, /* true/false */
				allow_resize: true, /* Resize the photos bigger than viewport. true/false */
				default_width: 500,
				default_height: 344,
				counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
				theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
				horizontal_padding: 20, /* The padding on each side of the picture */
				hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque', /* Set the flash wmode attribute */
				autoplay: false, /* Automatically start videos: True/False */
				modal: false, /* If set to true, only the close button will close the window */
				deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
				overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
				ie6_fallback: true,
				social_tools: ''

			}); 
			        });
			      }


			    );



				<?php if(of_get_option('portfolio_infinite_scroll', '1')): ?>
				// kill scroll binding
			    $(window).unbind('.infscr');


				jQuery("#page-nav a").click(function(){
				    jQuery('#mason-layout').infinitescroll('retrieve');
				        return false;
				});


				// remove the paginator when we're done.
			    $(document).ajaxError(function(e,xhr,opt){
			      if (xhr.status == 404) $('#page-nav a').remove();
			    });

				<?php endif; ?>
				<?php endif; ?>

			  });

	</script>
	
	


<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>


<div class="clearfix"></div>
<?php if(of_get_option('blog_sidebar', '1')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>