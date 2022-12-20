<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
while ( have_posts() ) :
the_post();
?>
	<main id="main_content" class="l-mainContent l-article">
		<div class="l-mainContent__inner">
			<?php
				\SWELL_Theme::outuput_widgets( 'front_top', [
					'before' => '<div class="w-frontTop">',
					'after'  => '</div>',
				] );
			?>
			<div class="<?=esc_attr( apply_filters( 'swell_post_content_class', 'post_content' ) )?>">
				<?php
				// サブループ出力の雛形
				$post_list = new PostList();
				$post_list->the_sub_loop();

				the_content();
				?>
			</div>
			<?php
				\SWELL_Theme::outuput_widgets( 'front_bottom', [
					'before' => '<div class="w-frontBottom">',
					'after'  => '</div>',
				] );
			?>
		</div>
	</main>
<?php
endwhile;
get_footer();
