<?php

/* 子テーマのfunctions.phpは、親テーマのfunctions.phpより先に読み込まれることに注意してください。 */


/**
 * 親テーマのfunctions.phpのあとで読み込みたいコードはこの中に。
 */
add_filter('after_setup_theme', function(){
	/*------ カスタム投稿タイプ、カスタムタクソノミー -------*/
	require get_stylesheet_directory() . '/functions/post-type.php';

	/*------ Advanced Custom Field オプションページ関連 -------*/
	// require get_stylesheet_directory() . '/functions/acf.php';

	/*------ ユーザー定義関数 -------*/
	require get_stylesheet_directory() . '/functions/original.php';

	/*------ その他のオプション定義 -------*/
	require get_stylesheet_directory() . '/functions/option.php';

	/*------ ウィジェット -------*/
	require get_stylesheet_directory() . '/functions/widget-nav.php';

}, 11);

/*
--------------------------------
*  クラスのオートロード
--------------------------------
*/
spl_autoload_register(function($class){
	$file = get_stylesheet_directory() . '/template-parts/class/' . $class . '.php';
	if ( is_file( $file ) ) {
		require $file;
	}
});


/**
 * 子テーマでのファイルの読み込み
 */
add_action('wp_enqueue_scripts', function() {
	
	$timestamp = date( 'Ymdgis', filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_style( 'child_style', get_stylesheet_directory_uri() .'/style.css', [], $timestamp );

	// フォームバリデーション
	wp_enqueue_script( 'jquery.validationEngine.min-js', 'https://cdn.jsdelivr.net/gh/posabsolute/jQuery-Validation-Engine@3.1.0/js/jquery.validationEngine.min.js', '', '1.0.0', true );
	wp_enqueue_script( 'jquery.validationEngine-ja.js', get_theme_file_uri( '/js/jquery.validationEngine-ja.js' ), '', '1.0.0', true );
	wp_enqueue_style( 'validationEngine.jquery.min.css', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css', '', '1.0.0' );

	/* その他の読み込みファイルはこの下に記述 */
	wp_enqueue_script( 'common-js', get_stylesheet_directory_uri().'/js/common.js', array(), gmdate( 'YmdHi' ), true ); // common.js.
}, 11);

/**
 * 管理画面用CSS読み込み
 */
function load_admin_scripts() {
	// 以下2行はセットで使用すること.
	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/style-admin.css', false, gmdate( 'YmdHi' ) );
	wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );