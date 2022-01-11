<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vcard
 */

get_header();
?>

	<?php while ( have_posts() ) : the_post(); ?>

	<!-- Page -->
	<div class="pb-3">
	    <header class="header-post">
            <h1 class="title title--h1"><?php the_title(); ?></h1>
		</header>
		<div class="content-post">
			<?php
				get_template_part( 'template-parts/content', 'page' );
			?>
		</div>
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
