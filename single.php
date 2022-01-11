<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package vcard
 */

get_header();
?>

<?php
	$blog_featured_img = get_field( 'blog_featured_img', 'option' );
?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	<!-- Post -->
	<div class="pb-3">
	    <header class="header-post">
	        <div class="header-post__date"><?php vcard_posted_on(); ?></div>
            <h1 class="title title--h1"><?php the_title(); ?></h1>
			<?php if ( ! $blog_featured_img ) : 
				vcard_post_thumbnail(); 
			endif; ?>
		</header>
		<div class="content-post">
			<?php
				get_template_part( 'template-parts/content', 'single' );
				
				the_post_navigation( array(
					'screen_reader_text' => ' ',
					'next_text' => '<span class="post-nav-prev post-nav-text">' . esc_html__( 'Next', 'vcard' ) . '</span>',
					'prev_text' => '<span class="post-nav-next post-nav-text">' . esc_html__( 'Prev', 'vcard' ) . '</span>'
				) );
			?>
		</div>
		<footer class="footer-post">
		    <?php if ( function_exists( 'vcard_add_social_share' ) ) :
		    	echo vcard_add_social_share( get_the_ID() );
		    endif; ?>
		</footer>
	</div>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
	<?php endwhile; ?>

<?php
get_footer();