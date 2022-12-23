<?php
/**
 *
 * その他のオプション定義
 *
 * @package WordPress
 */

/**
 * --------------------------------
 *  [投稿]を任意のタイトルに変更する
 * --------------------------------
 */
function my_change_menu_label() {
	global $menu;
	$name = '活動ブログ';
	$menu[5][0] = $name;
}
add_action( 'admin_menu', 'my_change_menu_label' );

function my_change_object_label() {
	global $wp_post_types;
	$name = '活動ブログ';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
}
// add_action( 'init', 'my_change_object_label' );

/**
 * --------------------------------
 *  固定ページにデフォルトアーカイブ機能(投稿一覧)を持たせる（変更後にパーマリンク設定で「変更を保存」すること）
 * --------------------------------
 */
function post_has_archive( $args, $post_type ) {
	if ( 'post' === $post_type ) {
		$args['rewrite']     = true;
		$args['has_archive'] = 'blog'; // 該当固定ページスラッグ（任意の値に変更可能）.
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

/**
 * --------------------------------
 *  カスタム投稿タイプの投稿パーマリンク構造を[post_id]にリライトする
 * --------------------------------
 */
function custom_post_type_link( $link, $post ){
	$post_type_slug = get_post_types( ['public' => true, '_builtin' => false ] );
	foreach ( $post_type_slug as $value ) {
		if ( $post->post_type === $value ) {
			return home_url( '/' . $value . '/' . $post->ID );
		}
	}
	return $link;
}
add_filter( 'post_type_link', 'custom_post_type_link', 1, 2 );

function custom_rewrite_rules_array( $rules ) {
	$new_rules = array();
	$post_type_slug    = get_post_types( ['public' => true, '_builtin' => false ] );
	foreach ( $post_type_slug as $value ) {
		$array_key   = $value . '/([0-9]+)/?$';
		$array_value = 'index.php?post_type=' . $value . '&p=$matches[1]';
		$new_rules[ $array_key ] = $array_value;
	}
	return $new_rules + $rules;
}
add_filter( 'rewrite_rules_array', 'custom_rewrite_rules_array' );

/**
 * --------------------------------
 * 特定のページのみエディター機能をキャンセルする
 * --------------------------------
 */
function disable_editor( $use_block_editor, $post ) {
    if( $post->post_type === 'page' ){
        if ( in_array( $post->post_name, ['home'] ) ) {
            remove_post_type_support( 'page', 'editor' );
            return false;
        }
    }
    return $use_block_editor;
}
// add_filter( 'use_block_editor_for_post', 'disable_editor', 10, 2 );

/**
 * --------------------------------
 * SWELL設定を投稿に表示しない（SWELLカスタマイズ）
 * --------------------------------
 *
 */
function my_swell_side_meta_screens( $screens ) {
	$exclude_post_type = ['post_type'];
	$screens = array_diff( $screens, $exclude_post_type );
	$screens = array_values( $screens );
	return $screens;
}
// add_filter( 'swell_side_meta_screens', 'my_swell_side_meta_screens');

/**
 * --------------------------------
 * SWELL設定をタクソノミーに表示しない（SWELLカスタマイズ）
 * --------------------------------
 *
 */
function my_swell_term_meta_screens( $term_meta_screens ) {
	$exclude_taxonomy = ['taxonomy'];
	$term_meta_screens = array_diff( $term_meta_screens, $exclude_taxonomy );
	$term_meta_screens = array_values( $term_meta_screens );
	return $term_meta_screens;
}
// add_filter( 'swell_term_meta_screens', 'my_swell_term_meta_screens' );

/**
 * --------------------------------
 * カスタムCSS＆JSを投稿に表示しない（SWELLカスタマイズ）
 * --------------------------------
 *
 */
// remove_action( 'add_meta_boxes', 'SWELL_Theme\Meta\Code\hook_add_meta_box', 1 );
// remove_action( 'save_post', 'SWELL_Theme\Meta\Code\hook_save_post' );