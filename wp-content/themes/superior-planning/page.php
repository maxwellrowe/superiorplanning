<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			$page_id = get_the_ID();
			$use_beaver_builder_content = false;

			if ( class_exists( 'FLBuilderModel' ) ) {
				if ( method_exists( 'FLBuilderModel', 'is_builder_enabled' ) ) {
					$use_beaver_builder_content = FLBuilderModel::is_builder_enabled( $page_id );
				}

				if ( ! $use_beaver_builder_content && method_exists( 'FLBuilderModel', 'is_builder_active' ) ) {
					$use_beaver_builder_content = FLBuilderModel::is_builder_active( $page_id );
				}
			}
		?>
		<?php if ( $use_beaver_builder_content ) { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<div class="sup-page">
				<div class="container">
					<div class="py-5">
						<h1 class="display-5 text-uppercase fw-bold text-center mb-4 page-title"><?php the_title(); ?></h1>
						<?php content_builder( $page_id ); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
