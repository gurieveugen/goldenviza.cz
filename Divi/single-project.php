<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<div class="et_main_title">
						<h1><?php the_title(); ?></h1>
						<span class="et_project_categories"><?php echo get_the_term_list( get_the_ID(), 'project_category', '', ', ' ); ?></span>
					</div>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_portfolio_single_image_width', 1080 );
					$height = (int) apply_filters( 'et_pb_portfolio_single_image_height', 9999 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Projectimage' );
					$thumb = $thumbnail["thumb"];

					$page_layout = get_post_meta( get_the_ID(), '_et_pb_page_layout', true );

					if ( '' !== $thumb )
						//print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->



				</article> <!-- .et_pb_post -->

			<?php
				if ( ! $is_page_builder_used && comments_open() && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) )
					comments_template( '', true );
			?>
			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>



			<?php if ( 'et_full_width_page' === $page_layout ) et_pb_portfolio_meta_box(); ?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>