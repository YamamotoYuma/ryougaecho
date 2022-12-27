<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// リストタイプ
$list_type = apply_filters( 'swell_post_list_type_on_search', SWELL_Theme::$list_type );
// タグ一覧の取得
$terms = get_terms('tenant_tag','hide_empty=0');
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

<main id="main_content" class="l-mainContent l-article">
	<div class="l-mainContent__inner">
		<?php
			SWELL_Theme::pluggable_parts( 'page_title', [
				'title'     => SWELL_Theme::get_search_title(),
				'has_inner' => true,
			] );
		?>
		<div class="p-searchContent u-mt-40">
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
