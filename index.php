<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vcard
 */

get_header();
?>
	<div class="section">
		<div class="pb-2">
        	<h1 class="title title--h1 first-title title__separate"><?php echo esc_html__( 'Latest Posts', 'vcard' ); ?></h1>
    	</div>

		<?php get_template_part( 'template-parts/archive-list' ); ?>
	</div>
<?php
get_footer();