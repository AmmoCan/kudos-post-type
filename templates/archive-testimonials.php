<?php
/**
 * 
 * The template for displaying all testimonials.
 * 
 */
 
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
    <header>
			<h1 class="testimonial-title page-title"><?php post_type_archive_title(); ?></h1>
		</header>
    <?php
      $args = array( 'post_type' => 'testimonials', 'posts_per_page' => 10 );
      $loop = new WP_Query( $args );
    ?>
  		<?php
  		// Start the loop.
  		while ( $loop->have_posts() ) : $loop->the_post();?>
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
  			
  		<?php endwhile; ?>
  		
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
