<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package vcard
 */

get_header();
?>

<?php

$error_title = esc_html__( '404', 'vcard' );
$title = get_field( 'p404_title', 'option' );
if ( ! $title ) {
	$title = esc_html__( 'Page not found...', 'vcard' );
}
$content = get_field( 'p404_content', 'option' );
if ( ! $content ) {
	$content = '<p>' . esc_html__( 'We are unable to find the page you are looking for.', 'vcard' ) . '</p>';
}

?>

<!-- 404 -->
<div class="parallax-container">
    <div class="container d-flex text-center align-items-center justify-content-center error-page">
        <div>
	        <div class="error-page__num"><?php echo esc_html( $error_title ); ?></div>
	        <?php if ( $title ) : ?>
	        <h3 class="title title--h5 mb-3"><?php echo esc_html( $title ); ?></h3>
	        <?php endif; ?>
	        <?php if ( $content ) : ?>
		    <div class="description"><?php echo wp_kses_post( $content ); ?></div>
		    <?php endif; ?>
        </div>
    </div>
</div>
<!-- /404 -->

<?php
get_footer();