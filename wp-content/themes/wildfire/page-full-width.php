<?php
// Template Name: Full Width
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
		<?php get_template_part( 'child-page', 'navigation' ); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">



<div class="content-container">
	<div class="container-spacing">
		
		<?php the_content(); ?>	
			
		<div class="clearfix"></div>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
	<div class="clearfix"></div>
	</div><!-- close .content-container-spacing -->
</div><!-- close .content-container -->

<?php endwhile; // end of the loop. ?>

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>
	

<?php get_footer(); ?>