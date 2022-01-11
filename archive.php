<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vcard
 */

get_header();
?>
	<div class="section">
		<div class="pb-2">
        	<h1 class="title title--h1 first-title title__separate"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
    	</div>

		<?php get_template_part( 'template-parts/archive-list' ); ?>
	</div>
<?php
get_footer();