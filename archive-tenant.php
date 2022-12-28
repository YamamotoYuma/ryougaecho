<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// タグ一覧の取得
$terms = get_terms('tenant_tag','hide_empty=0');

// 投稿数の取得
$post_count = wp_count_posts('tenant')->publish;
?>

<div class="l-mainController">
	<div class="l-mainController__inner">
		<ul class="c-label-tag__unit">
			<li class="c-label-tag js-search-tag" data-term="all">ALL</li>
			<?php
				foreach ( $terms as $term ) {
					echo '<li class="c-label-tag js-search-tag" data-term="' . $term->slug . '">' . $term->name . '</li>';
				}
			?>
		</ul>
		<?php
			// キーワード検索フォーム
			SWELL_Theme::get_parts( 'template-parts/searchform' );
		?>
	</div>
	<!-- /.l-mainController__inner -->
</div>
<!-- /.l-mainController -->

<main id="main_content" class="l-mainContent">
	<div class="l-mainContent__inner">
		<div class="p-searchResult">
			<h2 class="p-searchResult__title">キーワード：<span class="p-searchResult__keyword">なし</span>
				<p class="p-searchResult__count">
					<span class="js-counter"></span>
					<span> / </span>
					<span><?php echo $post_count; ?></span>
					<span>件</span>
				</p>
			</h2>
			<?php
				// 新着投稿一覧 ( Main loop )
				$list_works = new PostList(
					array(
						'card' => 'tenant',
						'unit' => 'p-card-tenant__unit',
					)
				);
				$list_works->the_main_loop();
			?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
