<?php
function superior_planning_is_beaver_builder_editor() {
  if ( ! class_exists( 'FLBuilderModel' ) ) {
    return false;
  }

  if ( method_exists( 'FLBuilderModel', 'is_builder_active' ) ) {
    return FLBuilderModel::is_builder_active();
  }

  return isset( $_GET['fl_builder'] ) || isset( $_GET['fl_builder_ui'] );
}

// Scripts and CSS
// Scripts and CSS
function superior_planning_enqueue_scripts() {
  // WordPress Dashicons for icon picker output on the front end
  wp_enqueue_style('dashicons');

  // Google Fonts: Bai Jamjuree
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;600;700&display=swap', false);

  // Bootstrap 5 CSS
  wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

  // AOS CSS
  wp_enqueue_style('aos-css', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css');

  // Swiper CSS
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  // Theme CSS
  $theme_css_path = get_stylesheet_directory() . '/style.css';
  $theme_css_ver  = file_exists($theme_css_path) ? filemtime($theme_css_path) : null;
  
  wp_enqueue_style(
      'theme-style',
      get_stylesheet_uri(),
      [],
      $theme_css_ver
  );
  
  // jQuery (bundled with WP)
  wp_enqueue_script('jquery');

  // Bootstrap JS
  wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], null, true);

  if ( ! superior_planning_is_beaver_builder_editor() ) {
    // Match Height JS
    wp_enqueue_script('match-height-js', 'https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js', ['jquery'], null, true);

    // AOS JS
    wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', [], null, true);

    // Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);

    // Your custom script.js with jQuery dependency
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/scripts.js', ['jquery'], '1.8', true);
  }

  // Font Awesome Kit (in head)
  add_action('wp_head', function() {
    echo '<script src="https://kit.fontawesome.com/08fcaf3dda.js" crossorigin="anonymous"></script>';
  });
}
add_action('wp_enqueue_scripts', 'superior_planning_enqueue_scripts');

// Theme Setup
function superior_planning_setup() {
  // Let WordPress manage the document title
  add_theme_support('title-tag');

  // Enable featured images (post thumbnails)
  add_theme_support('post-thumbnails');

  // ✅ Enable Menus
  add_theme_support('menus');

  // ✅ Register menu locations
  register_nav_menus([
    'primary' => __('Primary Menu', 'superior-planning'),
  ]);

  // Support HTML5 markup for various components
  add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script',
    'style',
  ]);

  // Allow wide/full alignment for Gutenberg blocks
  add_theme_support('align-wide');

  // Enable custom logo support
  add_theme_support('custom-logo');

  // Enable automatic feed links
  add_theme_support('automatic-feed-links');

  // Enable editor styles (optional if using a style guide in Gutenberg)
  add_theme_support('editor-styles');
  add_editor_style('editor-style.css');

  add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'superior_planning_setup');


// Content Builder Include
require_once get_template_directory() . '/content-builder/content-builder.php';
