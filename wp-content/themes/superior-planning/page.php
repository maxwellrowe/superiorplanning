<?php get_header(); ?>
	<div class="sup-page">
		<div class="container">
			<div class="py-5">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<h1 class="display-5 text-uppercase fw-bold text-center mb-4"><?php the_title(); ?></h1>
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

							if ( $use_beaver_builder_content ) {
								the_content();
							} else {
								content_builder( $page_id );
							}
						?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
