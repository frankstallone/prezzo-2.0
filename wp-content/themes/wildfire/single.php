<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<?php $page_for_posts = get_option('page_for_posts'); ?>
		<h1 class="page-title"><?php echo get_the_title($page_for_posts); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">

<?php if(of_get_option('blog_sidebar_single', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content-container">
				
				<?php if(get_post_meta($post->ID, 'videoembed_textarea', true)): ?>
					<?php echo get_post_meta($post->ID, 'videoembed_textarea', true) ?>
				<?php else: ?>
					<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
					<a href="<?php echo $image[0]; ?>" class="hover-icon" rel="prettyPhoto">
						<div class="zoom-icon">zoom</div>
						<?php the_post_thumbnail('progression-blog'); ?>
					</a>
					<?php endif; ?>
				<?php endif; ?>
				
				<div class="container-spacing">
					
					<div class="blog-post-details">
						<?php progression_posted_on(); ?>
						<div class="post-comments"><?php comments_popup_link( '<span class="leave-reply">' . __( 'No comments', 'progression' ) . '</span>', _x( '1 comment', 'comments number', 'progression' ), _x( '% comments', 'comments number', 'progression' ) ); ?></div>	
					</div><!-- close .blog-post-details -->
					
					<div class="blog-post-excerpt">
						<h3><?php the_title(); ?></h3>
						<?php the_content( __( '<p>Continue reading <span class="meta-nav">&rarr;</span></p>', 'progression' ) ); ?>
					</div><!-- close .blog-post-excerpt -->
					
				<div class="clearfix"></div>
				</div><!-- close .content-container-spacing -->
				
				<?php the_tags('<div class="tag-cloud"><div class="tag-icon"> ', ', ', '</div></div>'); ?>
				
			</div><!-- close .content-container -->
		</div><!-- #post-<?php the_ID(); ?> -->
		

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );
		?>

	<?php endwhile; // end of the loop. ?>


<div class="clearfix"></div>
<?php if(of_get_option('blog_sidebar_single', '1')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>