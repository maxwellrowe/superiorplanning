<?php 
/*
Template Name: Homepage
*/
get_header(); ?>
	
	<div class="sections-wrapper">
		<?php 
			if(get_field('wealth_management_and_family_office_page', 'option')) {
				$page = get_field('wealth_management_and_family_office_page', 'option');
				?>
					<section id="wm-section" class="sp-section <?php echo $page->post_name; ?>" data-slug="<?php echo $page->post_name; ?>">
						<div class="sp-section-inner">
							<div>
								<div class="container">
									<h2 class="text-light h1 wm-show"><?php echo $page->post_title; ?> <span class="fa-sharp fa-angle-down"></span></h2>
									<div class="text-light">
										<?php
											if( have_rows('wealth_management_options')) : 
												while( have_rows('wealth_management_options')) : the_row();
													if(get_sub_field('subtitle')) {
													?>
														<span class="sp-subtitle d-block fst-italic py-2">
															<?php echo get_sub_field('subtitle'); ?>
														</span>
													<?php
													}
													?>
													<div class="sp-intro">
														<?php if(get_sub_field('intro')) {
														?>
															<div class="lead">
																<?php echo get_sub_field('intro'); ?>
															</div>
														<?php
														}
														if(get_sub_field('button_text')) {
														?>
															<div class="button">
																<a href="#" class="btn btn-outline-light wm-show">
																	<?php echo get_sub_field('button_text'); ?> <span class="fa-sharp fa-arrow-right"></span>
																</a>
															</div>
														<?php
														}
														if(get_sub_field('links')) {
															$links = get_sub_field('links');
															?>
																<div class="sp-links">
																	<?php foreach($links as $link) { ?>
																		<a href="<?php echo $link['link_url']; ?>">
																			<?php echo $link['link_text']; ?>
																		</a>
																	<?php } ?>
																</div>
															<?php
														} ?>
													</div>
												<?php
												endwhile;
											endif;
										?>
									</div>
								</div>
							</div>
							<div class="sp-main-content">
								<div class="container">
									<?php
										content_builder($page->ID);
									?>
								</div>
							</div>
						</div>
					</section>
				<?php
			}
		?>
		
		<?php 
			if(get_field('financial_solutions_group_page', 'option')) {
				$page = get_field('financial_solutions_group_page', 'option');
				?>
					<section id="fs-section" class="sp-section <?php echo $page->post_name; ?>" data-slug="<?php echo $page->post_name; ?>">
						<div class="sp-section-inner">
							<div>
								<div class="container">
									<h2 class="h1 fs-show"><?php echo $page->post_title; ?> <span class="fa-sharp fa-angle-down"></span></h2>
									
									<?php
										if( have_rows('financial_solutions_options')) : 
											while( have_rows('financial_solutions_options')) : the_row();
												if(get_sub_field('subtitle')) {
												?>
													<span class="sp-subtitle d-block fst-italic py-2">
														<?php echo get_sub_field('subtitle'); ?>
													</span>
												<?php
												} ?>
												<div class="sp-intro">
													<?php if(get_sub_field('intro')) {
													?>
														<div class="lead">
															<?php echo get_sub_field('intro'); ?>
														</div>
													<?php
													}
													if(get_sub_field('button_text')) {
													?>
														<div class="button">
															<a href="#" class="btn btn-outline-dark fs-show">
																<?php echo get_sub_field('button_text'); ?> <span class="fa-sharp fa-arrow-right"></span>
															</a>
														</div>
													<?php
													}
													if(get_sub_field('links')) {
														$links = get_sub_field('links');
														?>
															<div class="sp-links">
																<?php foreach($links as $link) { ?>
																	<a href="<?php echo $link['link_url']; ?>">
																		<?php echo $link['link_text']; ?>
																	</a>
																<?php } ?>
															</div>
														<?php
													} ?>
												</div>
												<?php
											endwhile;
										endif;
									?>
								</div>
							</div>
							<!-- Main Content -->
							<div class="sp-main-content">
								<div class="container">
									<?php
										content_builder($page->ID);
									?>
								</div>
							</div>
						</div>
					</section>
				<?php
			}
		?>
	</div>

<?php get_footer(); ?>