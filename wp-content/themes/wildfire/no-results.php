<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */
?>


</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'progression' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">


<?php if(of_get_option('blog_sidebar', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
<?php if ( is_home() ) : ?>
	
	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'progression' ), admin_url( 'post-new.php' ) ); ?></p>


<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'progression' ); ?></p>
		<?php get_search_form(); ?>

<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'progression' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>

