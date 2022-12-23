<?php
/**
 * 「カスタム投稿タイプの追加、カスタムタクソノミーの追加、その他投稿制御」
 * カスタム投稿タイプの追加はこちらに記述してください
 *
 * @package WordPress
 */

?>
<?php
/**
 * カスタム投稿タイプの定義
 */
function my_custom_init() {
	/*
	--------------------------------
	* 投稿タイプ：お知らせ
	--------------------------------
	*/
	register_post_type(
		'news',
		array(
			'label'         => 'お知らせ',
			'labels' => array(
				'add_new' => '新規追加',
				'edit_item' => '投稿の編集',
				'view_item' => '投稿を表示',
				'search_items' => '投稿を検索',
				'not_found' => '投稿は見つかりませんでした。',
				'not_found_in_trash' => 'ゴミ箱に投稿はありませんでした。'
			  ),
			'public'        => true,
			'supports'      => array( 'title', 'editor', 'author', 'thumbnail' ),
			'menu_position' => 4,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-warning',
			'rewrite'       => array('with_front' => false),
		)
	);
	/*------ タクソノミー：お知らせのカテゴリー -------*/
	register_taxonomy(
		'news_category', // タクソノミースラッグ.
		'news', // 投稿タイプ.
		array(
			'hierarchical'          => true,
			'update_count_callback' => '_update_post_term_count',
			'label'                 => 'カテゴリー',
			'public'                => true,
			'show_in_rest'          => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_quick_edit'    => true,
		)
	);
		/*
	--------------------------------
	* 投稿タイプ：テナント
	--------------------------------
	*/
	register_post_type(
		'tenant',
		array(
			'label'         => 'テナント',
			'labels' => array(
				'add_new' => '新規追加',
				'edit_item' => 'テナントの編集',
				'view_item' => 'テナントを表示',
				'search_items' => 'テナントを検索',
				'not_found' => 'テナントは見つかりませんでした。',
				'not_found_in_trash' => 'ゴミ箱にテナントはありませんでした。'
			  ),
			'public'        => true,
			'supports'      => array( 'title' ),
			'menu_position' => 5,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-store',
			'rewrite'       => array('with_front' => false),
		)
	);
	/*------ タクソノミー：テナントのタグ -------*/
	register_taxonomy(
		'tenant_tag',
		'tenant',
		array(
			'hierarchical'          => false,
			'update_count_callback' => '_update_post_term_count',
			'label'                 => 'タグ',
			'public'                => true,
			'show_in_rest'          => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_quick_edit'    => true,
		)
	);
}
add_action( 'init', 'my_custom_init' );
