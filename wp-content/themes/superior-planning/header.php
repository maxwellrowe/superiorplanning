<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header id="header" class="bg-light d-flex justify-content-center align-items-center">
    <div class="container-xxl">
      <div class="row align-items-center">
        <div class="col-4 col-lg-3 text-start">
          <a href="<?php echo home_url(); ?>" id="brand">
            <img src="<?php echo get_field('logo', 'option'); ?>" alt="" />
          </a>
        </div>
        <div class="col-8 col-lg-9 text-end">
          <div class="d-flex align-items-center justify-content-end gap-3">
            <?php
            wp_nav_menu([
              'theme_location'  => 'primary',
              'container'       => 'nav',
              'container_class' => 'primary-nav d-inline-block',
              'menu_class'      => 'nav justify-content-end align-items-center gap-4 lh-1 text-center',
              'fallback_cb'     => false,
              'depth'           => 2,
            ]);
            ?>
            <?php if ($header_cta = get_field('call_to_action_button', 'option')) : 
              $header_cta_url    = esc_url($header_cta['url']);
              $header_cta_title  = esc_html($header_cta['title'] ?: 'Learn More');
              $header_cta_target = !empty($header_cta['target']) ? esc_attr($header_cta['target']) : '_self';
            ?>
              <a href="<?php echo $header_cta_url; ?>" target="<?php echo $header_cta_target; ?>" class="btn btn-outline-dark lh-1">
                <?php echo $header_cta_title; ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
  <?php /* REMOVED JUNE 2026
  <?php if ( ! is_page_template( 'page-home.php' ) ) { ?>
    <div class="header-subnav">
      <div class="container-fluid">
        <div class="row gap-0 row-cols-1 row-cols-md-2">
          <?php if(get_field('wealth_management_and_family_office_page', 'option')) { ?>
            <?php $wm_page = get_field('wealth_management_and_family_office_page', 'option'); ?>
            <a class="col d-block header-subnav-wm" href="<?php echo home_url(); ?>/#retirement-planning">
              <div class="d-flex align-items-center justify-content-center gap-2">
                <span>Retirement Planning</span><span class="fa-sharp fa-arrow-right"></span>
              </div>
            </a>
          <?php } ?>
          <?php if(get_field('financial_solutions_group_page', 'option')) { ?>
            <?php $fs_page = get_field('financial_solutions_group_page', 'option'); ?>
            <a class="col d-block header-subnav-fs" href="<?php echo home_url(); ?>/#real-estate-planning">
              <div class="d-flex align-items-center justify-content-center gap-2">
                <span>Real Estate Planning</span><span class="fa-sharp fa-arrow-right"></span>
              </div>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
  */ ?>
