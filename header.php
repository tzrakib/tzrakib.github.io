<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vcard
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
	<?php 
	
	$menu_type = get_field( 'menu_type', 'option' ); 
	$theme_style = get_field( 'theme_style', 'option' );
	$preloader_disable = get_field( 'preloader_disable', 'option' );
	
	?>

	<?php if ( ! $preloader_disable ) : ?>
	<!-- Preloader -->
    <div class="preloader">
	    <div class="preloader__wrap">
		    <div class="circle-pulse">
                <div class="circle-pulse__1"></div>
                <div class="circle-pulse__2"></div>
            </div>
		    <div class="preloader__progress"><span></span></div>
		</div>
	</div>
	<?php endif; ?>
	
    <main class="main<?php if ( $theme_style ) : ?> theme-style-compact<?php endif; ?><?php if ( $menu_type == 1 ) : ?> main-m-alt<?php endif; ?>">
	    <div class="container gutter-top">
	    	<?php if ( $menu_type === false ) : ?>
	    	<div class="row header--default">
	    		<div class="col-12">
	    			<div class="logo-text">
	    				<a href="<?php echo esc_url( home_url() ); ?>">
	    					<span class="logo-text__name"><?php echo esc_html( bloginfo( 'name' ) ); ?></span>
	    					<span class="logo-text__sub"><?php echo esc_html( bloginfo( 'description' ) ); ?></span>
	    				</a>
	    			</div>
	    		</div>
	    	</div>
	    	<?php endif; ?>

		    <div class="row sticky-parent">
			    <?php get_template_part( 'template-parts/side-panel' ); ?>
		        
				<!-- Content -->
		        <div class="col-12 col-md-12 col-xl-9">
				    <div class="box shadow pb-0<?php if ( $menu_type == 1 ) : ?> pt-sm-6<?php endif; ?>">
					    <div id="swupMenu">
						    <!-- Menu -->
						    <div class="circle-menu<?php if ( $menu_type == 1 ) : ?> d-sm-none<?php endif; ?>">
							    <div class="hamburger">
	                                <div class="line"></div>
	                                <div class="line"></div>
	                                <div class="line"></div>
	                            </div>
							</div>

							<div class="inner-menu<?php if ( ! $menu_type ) : ?> js-menu<?php endif; ?><?php if ( $menu_type == 1 ) : ?> inner-menu-alt<?php endif; ?>">
	                            <?php wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => '',
									'menu_class' => 'nav',
									'walker' => new vcard_TopmenuHorizontal_Walker(),
								) ); ?>
							</div>
						</div>

						<div class="page-wrap">
							<div class="transition-fade" id="swup">