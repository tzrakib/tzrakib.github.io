<?php
/**
 * vcard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vcard
 */

if ( ! function_exists( 'vcard_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vcard_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on vcard, use a find and replace
		 * to change 'vcard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vcard', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'vcard' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Image Sizes
		add_image_size( 'vcard_140x140', 140, 140, true );
		add_image_size( 'vcard_256x256', 256, 256, false );
		add_image_size( 'vcard_900xAuto', 900, 9999, false );
		add_image_size( 'vcard_900x900', 900, 900, true );
		add_image_size( 'vcard_900x675', 900, 675, true );
		add_image_size( 'vcard_900x1200', 900, 1200, true );
		add_image_size( 'vcard_1170x658', 1170, 658, true );
		add_image_size( 'vcard_1920xAuto', 1920, 9999, false );
	}
endif;
add_action( 'after_setup_theme', 'vcard_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vcard_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'vcard_content_width', 900 );
}
add_action( 'after_setup_theme', 'vcard_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vcard_widgets_init() {
	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'vcard' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'vcard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'vcard_widgets_init' );

/**
 * Register Default Fonts
 */
function vcard_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$poppins = _x( 'on', 'Archivo: on or off', 'vcard' );

	if ( 'off' !== $poppins ) {
		$font_families = array();

		$font_families[] = 'Archivo:400,400i,500,500i,600,600i,700,700i';
		$font_families[] = 'Merriweather:400,900';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'display' => urlencode( 'swap' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function vcard_stylesheets() {
	// Web fonts 
	wp_enqueue_style( 'vcard-fonts', vcard_fonts_url(), array(), null );

	$headingsFont =  get_field( 'heading_font_family', 'options' );
	$paragraphsFont =  get_field( 'text_font_family', 'options' );
	
	// Custom fonts
	if ( $headingsFont ) {
		wp_enqueue_style( 'vcard-heading-font', $headingsFont['url'] , array(), null );
	}
	if ( $paragraphsFont ) {
		wp_enqueue_style( 'vcard-paragraph-font', $paragraphsFont['url'] , array(), null );
	}

	/*Styles*/
	wp_enqueue_style( 'vcard-style', get_stylesheet_uri(), array( 'bootstrap', 'magnific-popup', 'vcard-icons', 'simplebar', 'swiper', 'fontawesome' ) );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', '1.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', '1.0' );
	wp_enqueue_style( 'vcard-icons', get_template_directory_uri() . '/assets/css/icons.css', '1.0' );
	wp_enqueue_style( 'simplebar', get_template_directory_uri() . '/assets/css/simplebar.css', '1.0' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.css', '1.0' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css', '1.0' );
}
add_action( 'wp_enqueue_scripts', 'vcard_stylesheets' );

function vcard_scripts() {
	/*Default Scripts*/	
	wp_enqueue_script( 'vcard-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'vcard-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/*Theme Scripts*/
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'imagesloaded' );	
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/assets/js/lazysizes.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/assets/js/sticky-kit.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'autosize', get_template_directory_uri() . '/assets/js/autosize.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'object-fit-images', get_template_directory_uri() . '/assets/js/object-fit-images.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'medium-zoom', get_template_directory_uri() . '/assets/js/medium-zoom.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/js/anime.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'scroll-magic', get_template_directory_uri() . '/assets/js/ScrollMagic.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'scroll-magic-anime', get_template_directory_uri() . '/assets/js/ScrollMagic.anime.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'split-text', get_template_directory_uri() . '/assets/js/split-text.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'masonry-4', get_template_directory_uri() . '/assets/js/masonry-4.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-simplebar', get_template_directory_uri() . '/assets/js/SimpleBar.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'vcard-common', get_template_directory_uri() . '/assets/js/common.js', array('jquery'), '1.0.0', true );

	$theme_transition = get_field( 'theme_transition', 'option' );

	if ( $theme_transition ) {
		$swup_url_data = array(
			'url'   => get_template_directory_uri(),
		);

		wp_enqueue_script( 'swup', get_template_directory_uri() . '/assets/js/swup.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'swup-body-class-plugin', get_template_directory_uri() . '/assets/js/SwupBodyClassPlugin.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'swup-init', get_template_directory_uri() . '/assets/js/swup-init.js', array('jquery'), '1.0.0', true );
		wp_localize_script( 'swup', 'swup_url_data', $swup_url_data );
	}
}
add_action( 'wp_enqueue_scripts', 'vcard_scripts' );

/**
 * TGM
 */
require get_template_directory() . '/inc/plugins/plugins.php';

/**
 * ACF Options
 */

function vcard_acf_json_load_point( $paths ) {
	$paths = array( get_template_directory() . '/inc/acf-json' );
	if( is_child_theme() ) {
		$paths[] = get_stylesheet_directory() . '/inc/acf-json';
	}

	return $paths;
}

add_filter('acf/settings/load_json', 'vcard_acf_json_load_point');

if ( function_exists( 'acf_add_options_page' ) ) {
	// Hide ACF field group menu item
	add_filter( 'acf/settings/show_admin', '__return_false' );
	
	// Add ACF Options Page
	acf_add_options_page( array( 
		'page_title' 	=> esc_html__( 'Theme Options', 'vcard' ),
		'menu_title'	=> esc_html__( 'Theme Options', 'vcard' ),
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_theme_options',
	) );
}

function vcard_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/inc/acf-json';
	
	// return
	return $path;   
}
add_filter( 'acf/settings/save_json', 'vcard_acf_json_save_point' );

function vcard_acf_fallback() {
	// ACF Plugin fallback
	if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
		function get_field( $field = '', $id = false ) {
			return false;
		}
		function the_field( $field = '', $id = false ) {
			return false;
		}
		function have_rows( $field = '', $id = false ) {
			return false;
		}
		function has_sub_field( $field = '', $id = false ) {
			return false;
		}
		function get_sub_field( $field = '', $id = false ) {
			return false;
		}
		function the_sub_field( $field = '', $id = false ) {
			return false;
		}
	} 
}
add_action( 'init', 'vcard_acf_fallback' );

/**
 * OCDI
 */
require get_template_directory() . '/inc/ocdi-setup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include Skin Options
 */
require get_template_directory() . '/inc/skin-options.php';

/**
 * Include Background Options
 */
require get_template_directory() . '/inc/bg-options.php';

/**
 * Include Ajax Portfolio Popup
 */
require get_template_directory() . '/inc/ajax-portfolio-popup.php';

/**
 * Get Archive Title
 */

function vcard_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_post_type_archive( 'portfolio' ) ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( esc_html__( 'Tag: ', 'vcard' ), false );
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author: ', 'vcard' ) . get_the_author();
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'vcard_archive_title' );

/**
 * Excerpt
 */
function vcard_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'vcard_custom_excerpt_length' );

function vcard_new_excerpt_more( $more ) {
	return esc_html__( '...', 'vcard' ) . '<div><a href="' . esc_url( get_permalink() ) . '" class="btn"><span>' . esc_html__( 'Read more', 'vcard' ) . '</span></a></div>';
}
add_filter( 'excerpt_more', 'vcard_new_excerpt_more' );

/**
 * Add class to sub-menu
 */
function vcard_change_wp_nav_menu( $classes, $args, $depth ) {
	if ( $args->theme_location == 'primary' ) {
		$classes[] = 'dropdown-menu';
	}
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'vcard_change_wp_nav_menu', 10, 3 );

/**
 * Top Menu Horizontal
 */
class vcard_TopmenuHorizontal_Walker extends Walker_Nav_menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		if ( isset( $args->link_after ) ) {
			$args->link_after = '';
		}

		if ( is_array($item->classes) ) {
			if ( in_array('menu-item-has-children', $item->classes ) ) {
				array_push( $item->classes, 'dropdown' );
			}
		}

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav__item';
		$class_names = join(' ', $classes);

	   	$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes_classes = '';

		if ( is_array($item->classes) ) {
			if ( in_array('menu-item-has-children', $item->classes ) ) {
				$attributes_classes .= ' dropdown-toggle';
				$args->link_after = ' <i class="icon icon-down-open"></i>';
			}
		}

		$attributes .= ' class="' . $attributes_classes . '"';

		if ( has_nav_menu( 'primary' ) ) {
			$output .= $indent . '<li id="menu-item-'. esc_attr( $item->ID ) . '"' . $class_names . '>';

			$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			if ( $depth == 0 ){
				$item_output .= '<span class="animated-button"><span>';
			}
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			if ( $depth == 0 ){
				$item_output .= '</span></span>';
			}
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

/**
 * Comments
 */
if ( ! function_exists( 'vcard_comment' ) ) {
	function vcard_comment( $comment, $args, $depth ) {
		?>
			<li <?php comment_class( 'post-comment comment-box' ); ?> id="li-comment-<?php comment_ID(); ?>" >
				<div id="comment-<?php comment_ID(); ?>" class="comment comment-box__inner">
					<div class="avatar avatar--60">
						<?php
							$avatar_size = 80;
							if ( '0' != $comment->comment_parent ){
								$avatar_size = 80;
							}
							echo get_avatar( $comment, $avatar_size );
						?>	
					</div>
					<div class="comment-box__body">
						<h5 class="comment-box__details">
							<span class="comment-author"><?php comment_author_link(); ?></span>
						</h5>
						<div class="comment-text">
							<div class="single-post-text">
								<?php comment_text(); ?>
							</div>
						</div>
						<div class="comment-box__footer">
							<span class="comment-time"><?php comment_time(); ?></span>
							<span class="comment-date"><?php comment_date(); ?></span>
							<span class="comment-reply">
								<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<i class="font-icon icon-reply"></i>' ) ) ); ?>	
							</span>
						</div>
					</div>
				</div>
			
		<?php
	}
}

function vcard_add_no_swap($link, $args, $comment, $post){
  return str_replace("rel='nofollow'", "rel='nofollow' data-no-swup", $link);
}
add_filter('comment_reply_link', 'vcard_add_no_swap', 420, 4);