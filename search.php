<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package vcard
 */

get_header();
?>
	<div class="section">
		<div class="pb-2">
        	<h1 class="title title--h1 first-title title__separate">
        		<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search: %s', 'vcard' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
        	</h1>
    	</div>

		<?php get_template_part( 'template-parts/archive-list' ); ?>
	</div>
<?php
get_footer();