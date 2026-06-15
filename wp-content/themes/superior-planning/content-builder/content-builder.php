<?php
	function superior_planning_get_icon_image_markup($image_value) {
		if (is_numeric($image_value)) {
			return wp_get_attachment_image(
				(int) $image_value,
				'full',
				false,
				array(
					'class' => 'icon-text-icon-image img-fluid',
					'alt' => '',
				)
			);
		}

		if (is_array($image_value)) {
			if (!empty($image_value['id']) && is_numeric($image_value['id'])) {
				return wp_get_attachment_image(
					(int) $image_value['id'],
					'full',
					false,
					array(
						'class' => 'icon-text-icon-image img-fluid',
						'alt' => '',
					)
				);
			}

			if (!empty($image_value['url'])) {
				return '<img src="' . esc_url($image_value['url']) . '" alt="" class="icon-text-icon-image img-fluid" />';
			}
		}

		if (is_string($image_value) && filter_var($image_value, FILTER_VALIDATE_URL)) {
			return '<img src="' . esc_url($image_value) . '" alt="" class="icon-text-icon-image img-fluid" />';
		}

		return '';
	}

	function superior_planning_get_icon_markup($icon) {
		if (empty($icon)) {
			return '';
		}

		if (is_string($icon)) {
			$icon = trim($icon);

			if (filter_var($icon, FILTER_VALIDATE_URL)) {
				return superior_planning_get_icon_image_markup($icon);
			}

			if (strpos($icon, 'dashicons-') === 0) {
				$icon = 'dashicons ' . $icon;
			}

			return '<i class="' . esc_attr($icon) . '" aria-hidden="true"></i>';
		}

		if (!is_array($icon)) {
			return '';
		}

		$icon_type = $icon['type'] ?? '';
		$icon_value = $icon['value'] ?? '';

		if ($icon_type === 'media_library' || $icon_type === 'url') {
			$image_markup = superior_planning_get_icon_image_markup($icon_value);

			if ($image_markup) {
				return $image_markup;
			}
		}

		if ($icon_type === 'dashicons' && is_string($icon_value) && trim($icon_value) !== '') {
			$icon_value = trim($icon_value);

			if (strpos($icon_value, 'dashicons-') === 0) {
				$icon_value = 'dashicons ' . $icon_value;
			}

			return '<i class="' . esc_attr($icon_value) . '" aria-hidden="true"></i>';
		}

		$possible_classes = array(
			$icon_value,
			$icon['class'] ?? '',
			$icon['icon'] ?? '',
			$icon['name'] ?? '',
			$icon['id'] ?? '',
		);

		foreach ($possible_classes as $classes) {
			if (is_string($classes) && trim($classes) !== '') {
				$classes = trim($classes);

				if (filter_var($classes, FILTER_VALIDATE_URL)) {
					return superior_planning_get_icon_image_markup($classes);
				}

				if (strpos($classes, 'dashicons-') === 0) {
					$classes = 'dashicons ' . $classes;
				}

				if ($classes === 'dashicons') {
					continue;
				}

				return '<i class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
			}
		}

		return '';
	}

	function superior_planning_get_table_markup($content) {
		if (empty($content)) {
			return '';
		}

		$table_markup = (string) $content;

		if (stripos($table_markup, '<table') !== false) {
			$table_markup = preg_replace('/<table\b([^>]*)class=(["\'])(.*?)\2([^>]*)>/i', '<table$1class=$2$3 table table-striped$2$4>', $table_markup, 1, $class_matches);

			if (empty($class_matches)) {
				$table_markup = preg_replace('/<table\b([^>]*)>/i', '<table$1 class="table table-striped">', $table_markup, 1);
			}
		}

		return '<div class="table-responsive mb-4">' . $table_markup . '</div>';
	}

	function superior_planning_render_content_block($content_block_post) {
		if (empty($content_block_post)) {
			return;
		}

		$content_block_id = is_object($content_block_post) ? $content_block_post->ID : (int) $content_block_post;

		if (!$content_block_id) {
			return;
		}

		content_builder($content_block_id);
	}

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
											if(get_row_layout() == 'accordion') {
												$accordion_items = get_sub_field('accordion_item');
												$accordion_id = 'accordion-' . $id . '-' . get_row_index();

												if (!empty($accordion_items)) {
													?>
														<div class="col">
															<div class="accordion accordion-flush sp-accordion" id="<?php echo esc_attr($accordion_id); ?>">
																<?php foreach ($accordion_items as $item_index => $item) {
																	$item_title = $item['title'] ?? '';
																	$item_content = $item['content'] ?? '';
																	$item_content_block = $item['content_block'] ?? '';
																	$item_id = $accordion_id . '-item-' . ($item_index + 1);
																	?>
																		<div class="accordion-item">
																			<h2 class="accordion-header" id="<?php echo esc_attr($item_id); ?>-heading">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($item_id); ?>-collapse" aria-expanded="false" aria-controls="<?php echo esc_attr($item_id); ?>-collapse">
																					<?php echo esc_html($item_title); ?>
																				</button>
																			</h2>
																			<div id="<?php echo esc_attr($item_id); ?>-collapse" class="accordion-collapse collapse" aria-labelledby="<?php echo esc_attr($item_id); ?>-heading">
																				<div class="accordion-body">
																					<?php if (!empty($item_content)) { ?>
																						<div class="accordion-content">
																							<?php echo $item_content; ?>
																						</div>
																					<?php } ?>
																					<?php if (!empty($item_content_block)) { ?>
																						<div class="accordion-content-block">
																							<?php superior_planning_render_content_block($item_content_block); ?>
																						</div>
																					<?php } ?>
																				</div>
																			</div>
																		</div>
																	<?php
																} ?>
															</div>
														</div>
													<?php
												}
											}
											if(get_row_layout() == 'table') {
												$table_content = get_sub_field('content');

												if (!empty($table_content)) {
													?>
														<div class="sp-table col">
															<?php echo superior_planning_get_table_markup($table_content); ?>
														</div>
													<?php
												}
											}
											if(get_row_layout() == 'icon_text') {
												$icon = get_sub_field('icon');
												$text = get_sub_field('text');
												$orientation = get_sub_field('orientation');
												$font_size = get_sub_field('font_size');
												$icon_size = get_sub_field('icon_size');
												$icon_markup = superior_planning_get_icon_markup($icon);
												$orientation_class = $orientation === 'top' ? 'flex-column justify-content-center align-items-center text-center' : 'justify-content-start align-items-start';
												?>
													<div class="sp-icon-text col">
														<div class="d-flex gap-3 <?php echo esc_attr($orientation_class); ?>">
															<?php if ($icon_markup) { ?>
																<div class="sp-icon-text-icon sp-icon-text-icon-<?php echo esc_attr($icon_size ?: 'normal'); ?>">
																	<?php echo $icon_markup; ?>
																</div>
															<?php } ?>
															<?php if (!empty($text)) { ?>
																<div class="sp-icon-text-text lh-1 <?php echo esc_attr($font_size); ?>">
																	<?php echo $text; ?>
																</div>
															<?php } ?>
														</div>
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
