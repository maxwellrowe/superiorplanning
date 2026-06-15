<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header id="header" class="bg-light d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="col col-lg-3 d-none d-lg-block">
          &nbsp;
        </div>
        <div class="col-6 col-lg-6 text-start text-lg-center">
          <a href="<?php echo home_url(); ?>" id="brand">
            <img src="<?php echo get_field('logo', 'option'); ?>" alt="" />
          </a>
        </div>
        <div class="col-6 col-lg-3 text-end">
          <?php if(get_field('account_access_page', 'option')) { ?>
            <?php $account_page = get_field('account_access_page', 'option'); ?>
            <a href="<?php echo get_permalink($account_page->ID); ?>" class="btn btn-outline-dark btn-sm"><?php echo get_the_title($account_page->ID); ?></a>
            <?php } else { ?>
              &nbsp;
            <?php } ?>
        </div>
      </div>
    </div>
  </header>
  <?php if ( ! is_page_template( 'page-home.php' ) ) { ?>
    <div class="header-subnav">
      <div class="container-fluid">
        <div class="row gap-0 row-cols-1 row-cols-md-2">
          <?php if(get_field('wealth_management_and_family_office_page', 'option')) { ?>
            <?php $wm_page = get_field('wealth_management_and_family_office_page', 'option'); ?>
            <a class="col d-block header-subnav-wm" href="<?php echo home_url(); ?>/#wealth-management">
              <div class="d-flex align-items-center justify-content-center gap-2">
                <span>Wealth Management &amp; Family Office</span><span class="fa-sharp fa-arrow-right"></span>
              </div>
            </a>
          <?php } ?>
          <?php if(get_field('financial_solutions_group_page', 'option')) { ?>
            <?php $fs_page = get_field('financial_solutions_group_page', 'option'); ?>
            <a class="col d-block header-subnav-fs" href="<?php echo home_url(); ?>/#financial-solutions">
              <div class="d-flex align-items-center justify-content-center gap-2">
                <span>Financial Solutions Group</span><span class="fa-sharp fa-arrow-right"></span>
              </div>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
