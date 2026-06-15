<?php get_header(); ?>
	<div class="sup-page">
		<div class="container">
			<div class="py-5">
				<h1 class="display-5 text-uppercase fw-bold text-center mb-4"><?php the_title(); ?></h1>
				<?php
					$content_block_id = get_queried_object_id();
					content_builder($content_block_id);
				?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
