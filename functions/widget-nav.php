<?php
/**
 * ウィジェットエリア・ナビゲーションエリアを定義
 *
 * @package WordPress
 */

/**
 * ------ ウィジェットエリアを定義 -------
 */
function underscores_widgets_init() {
	register_sidebar( // サイドバー.
		array(
			'name'          => '追加ウィジェットエリアタイトル',
			'id'            => 'sidebar-add',
			'description'   => '追加ウィジェットエリア説明文',
			'before_widget' => '<div id="%1$s" class="c-widget c-listMenu %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -side">',
			'after_title'   => '</div>',
		)
	);
}
// add_action( 'widgets_init', 'underscores_widgets_init' ); // ウィジェットエリアを追加する.

/**
 * ------ ナビメニューエリアを定義 -------
 */
function register_my_menu() {
	register_nav_menus( [
		'footer_menu_2'        => __( 'フッター（右）', 'swell' ),
		'footer_menu_3'        => __( 'フッター（下）', 'swell' ),
	] );
}
add_action( 'after_setup_theme', 'register_my_menu', 12 );
