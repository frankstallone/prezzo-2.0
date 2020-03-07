<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<h1 class="page-title">
			<?php
				if ( is_category() ) {
					printf( __( 'Category Archives: %s', 'progression' ), '<span>' . single_cat_title( '', false ) . '</span>' );

				} elseif ( is_tag() ) {
					printf( __( 'Tag Archives: %s', 'progression' ), '<span>' . single_tag_title( '', false ) . '</span>' );

				} elseif ( is_author() ) {
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();
					printf( __( 'Author Archives: %s', 'progression' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();

				} elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'progression' ), '<span>' . get_the_date() . '</span>' );

				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives: %s', 'progression' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives: %s', 'progression' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				} else {
					_e( 'Archives', 'progression' );

				}
			?>
		</h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">

<?php if(of_get_option('blog_sidebar', '1')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
					
		<?php
			if ( is_category() ) {
				// show an optional category description
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

			} elseif ( is_tag() ) {
				// show an optional tag description
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			}
		?>
		
		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="content-container">

					<?php if(get_post_meta($post->ID, 'videoembed_textarea', true)): ?>
						<?php echo get_post_meta($post->ID, 'videoembed_textarea', true) ?>
					<?php else: ?>
						<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>" class="hover-icon">
							<div class="zoom-icon article-icon">zoom</div>
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
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_content( __( '<p>Continue reading <span class="meta-nav">&rarr;</span></p>', 'progression' ) ); ?>
						</div><!-- close .blog-post-excerpt -->

					<div class="clearfix"></div>
					</div><!-- close .content-container-spacing -->

					<?php the_tags('<div class="tag-cloud"><div class="tag-icon"> ', ', ', '</div></div>'); ?>

				</div><!-- close .content-container -->
			</div><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; ?>	
		
		
		<div class="clearfix"></div>
		<?php kriesi_pagination($pages = '', $range = 2); ?>
		<!--div><?php posts_nav_link(); // default tag ?></div-->
				


		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>
		
		
<div class="clearfix"></div>
<?php if(of_get_option('blog_sidebar', '1')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>