<?php
/**
 * 
 * Template Name: Testimonial
 * Description: Used as a page template to show a single testimonial.
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
    while ( have_posts() ) : the_post(); ?>
      <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="testimonial-content entry-content">
  				<!-- Display client's photo -->
  				<?php if ( has_post_thumbnail() ): ?>
  					<div class="testimonial-img">
    					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
  						  <?php the_post_thumbnail( array( 100, 100 ), array( 'class' => 'th' ) ); ?>
    					</a>
  					</div>
  			  <?php endif; ?>
  			    <?php
    			    $link = get_post_meta( get_the_ID(), 'link', true );
    			    $client_name = get_post_meta( get_the_ID(), 'client_name', true );
    			    $company = get_post_meta( get_the_ID(), 'company', true );
    			  ?>
    			  <!-- Display client's link, name and company -->
			      <div class="client-info">
  			      <h6>
    			      <a href="<?php echo $link; ?>" title="learn more about <?php echo $client_name; ?>">
      			      <cite><?php echo $client_name; ?></cite>
      			    </a>&#44; <?php echo $company; ?>
      			  </h6>
			      </div>
			      <!-- Display client's testimonial -->
  			    <div class="post-excerpt">
    			    <blockquote><?php the_content(); ?></blockquote>
  			    </div>
				</div>
			</article>
			
		<?php endwhile;
    	if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'kudos-post-type' ),
				) );
			} elseif ( is_singular( 'testimonials' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'kudos-post-type' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'kudos-post-type' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'kudos-post-type' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'kudos-post-type' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>