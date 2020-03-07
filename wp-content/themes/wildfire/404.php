<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>


</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">



<div class="content-container">
	<div class="container-spacing">	



	<p class="page-not-found"><?php _e( 'It looks like nothing was found at this location. ', 'progression' ); ?></p>



	<div class="clearfix"></div>
	</div><!-- close .content-container-spacing -->
</div><!-- close .content-container -->


<?php get_footer(); ?>