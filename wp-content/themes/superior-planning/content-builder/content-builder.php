<?php
	function content_builder($id) {
		if(have_rows('content_builder', $id)):
			while( have_rows('content_builder', $id)) : the_row();
				if(get_row_layout() == 'row') {
					$desktop_columns = get_sub_field('desktop_columns');
					$tablet_columns = get_sub_field('table_columns');
					$mobile_columns = get_sub_field('mobile_columns');
					$font_color = get_sub_field('font_color');
					$max_width = get_sub_field('max_width');
					$components = get_sub_field('components');
					
					?>
					<?php if(get_sub_field('max_width')) { ?>
						<div style="margin: 0 auto; max-width: <?php echo $max_width; ?>">
					<?php } ?>
							<div class="row row-cols-<?php echo $mobile_columns; ?> row-cols-sm-<?php echo $tablet_columns; ?> row-cols-lg-<?php echo $desktop_columns; ?> <?php echo $font_color; ?>">
								<?php 
									if( have_rows('components')) :
										while( have_rows('components')) : the_row();
											if(get_row_layout() == 'lead') {
												?>
													<div class="lead col">
														<?php echo get_sub_field('content'); ?>
													</div>
												<?php	
											}
											if(get_row_layout() == 'basic_content') {
												?>
													<div class="basic-content col">
														<?php echo get_sub_field('content'); ?>
													</div>
												<?php	
											}
											if(get_row_layout() == 'hr') {
												?>
													<div class="col">
														<hr style="border-top-width: <?php echo get_sub_field('height'); ?>px;" />
													</div>
												<?php	
											}
											if(get_row_layout() == 'html') {
												echo get_sub_field('html');
											}
											if(get_row_layout() == 'image') {
												$row_id = get_row_index();
												$image = get_sub_field('image');
												$image_size = get_sub_field('image_size');
												$caption = get_sub_field('caption');
												$title = get_sub_field('title');
												$title_2 = get_sub_field('title_2');
												$phone = get_sub_field('phone');
												$email = get_sub_field('email');
												$bio = get_sub_field('bio');
												$cta_url = get_sub_field('call_to_action_url');
												$cta_text = get_sub_field('call_to_action_text');
												?>
													<figure class="sp-image col mb-5">
														<?php echo wp_get_attachment_image( $image, $image_size, false, array(
															'class' => 'img-fluid',
															'alt' => ''	
														) ); ?>
														<?php if(!empty($caption)) { ?>
															<div class="image-caption fw-bold fs-5">
																<?php echo $caption; ?>
															</div>
														<?php } ?>
														<?php if($title || $title_2) { ?>
															<?php if($title) { ?>
																<div><small><?php echo $title; ?></small></div>
															<?php } ?>
															<?php if($title_2) { ?>
																<div><small><?php echo $title_2; ?></small></div>
															<?php } ?>
														<?php } ?>
														<?php if($phone || $email) { ?>
															<div class="mt-3">
																<?php if($phone) { ?>
																	<div><?php echo $phone; ?></div>
																<?php } ?>
																<?php if($email) { ?>
																	<div>
																		<a href="mailto:<?php echo $email; ?>">
																			<?php echo $email; ?>
																		</a>
																	</div>
																<?php } ?>
															</div>
														<?php } ?>
														<?php if($bio) { ?>
															<div class="mt-3">
																<a href="#"
																   data-bs-toggle="modal" 
																   data-bs-target="#image-modal-<?php echo $row_id; ?>">
																	View Bio
																</a>
															</div>
														<?php } ?>
														<?php if($cta_url) { ?>
															<div class="mt-4">
																<a href="<?php echo $cta_url; ?>" class="btn btn-primary btn-sm" target="_blank">
																	<?php echo $cta_text; ?>
																</a>
															</div>
														<?php } ?>
														<?php if($bio) { ?>
															<div class="modal fade" tabindex="-1" id="image-modal-<?php echo $row_id; ?>" aria-label="Bio for <?php echo $caption; ?>" aria-hidden="true">
																<div class="modal-dialog modal-lg modal-dialog-centered">
																	<div class="modal-content rounded-0">
																		<div class="modal-header">
																			<h2 class="h5 m-0 fw-bold">
																				<?php echo $caption; ?>
																			</h2>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<div class="modal-body">
																			<?php echo wp_kses_post($bio); ?>
																		</div>
																	</div>
																</div>
															</div>
														<?php } ?>
													</figure>
												<?php	
											}
											if(get_row_layout() == 'pre_heading') {
												?>
													<div class="pre-heading col">
														<?php echo get_sub_field('content'); ?>
													</div>
												<?php	
											}
											if(get_row_layout() == 'spacer') {
												?>
													<div class="spacer col" style="height: <?php echo get_sub_field('height'); ?>"></div>
												<?php	
											}
											if(get_row_layout() == 'anchor_id') {
												?>
													<div class="anchor-div col" id="<?php echo get_sub_field('content'); ?>"></div>
												<?php	
											}
											if(get_row_layout() == 'button') {
												?>
													<div class="<?php echo get_sub_field('alignment'); ?> mb-4">
														<a href="<?php echo get_sub_field('link'); ?>" target="<?php echo get_sub_field('link_target'); ?>" class="btn btn-outline-dark btn-sm <?php echo get_sub_field('display'); ?>"><?php echo get_sub_field('button_text'); ?></a>
													</div>
												<?php
											}
										endwhile;
									endif;
								?>
							</div>
					<?php if(get_sub_field('max_width')) { ?>
						</div>
					<?php } ?>
					<?php
				}	
			endwhile;
		endif;
	}	
?>