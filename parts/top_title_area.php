<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $post;
$id        = $post->ID;
$post_type = get_post_type();
$background_image_url = '';

// タイトルテキストの取得
if ( is_archive() ) {
	$page_title = get_the_archive_title(); // アーカイブタイトル.
	$page_slug  = get_archive_slug();
} elseif ( is_single() ) {
	$page_title = get_post_type_object( $post_type )->label;
	$page_slug  = get_post_type_object( $post_type )->slug;
} elseif ( is_404() ) {
	return false;
} else {
	$page_slug  = $post->post_name;
	$page_title = get_the_title( $id );
}

// 背景パターンの取得
if ( is_post_type_archive ( 'tenant' ) || is_singular( 'tenant' ) ) {
	$background_image_url = get_stylesheet_directory_uri() . "/img/texture/tx_04.jpg";
} elseif ( is_page( 'charm' ) ) {
	$background_image_url = get_stylesheet_directory_uri() . "/img/texture/tx_02.jpg";
} elseif ( is_page( 'history' ) ) {
	$background_image_url = get_stylesheet_directory_uri() . "/img/texture/tx_05.jpg";
} elseif ( is_page( 'about' ) ) {
	$background_image_url = get_stylesheet_directory_uri() . "/img/texture/tx_03.jpg";
}
$background_image = ' style="background-image:url(' . "'" . $background_image_url . "'". ');"';

?>
<div id="top_title_area" class="l-content-head"<?php if ( $background_image_url ) echo $background_image;?>>

	<div class="l-content-head__inner l-container">
		<h1 class="c-heading-lv2">
			<span class="c-heading-lv2__en"><?php echo strtoupper( $page_slug ); ?></span>
			<span class="c-heading-lv2__jp"><?php echo wp_kses_post( $page_title ) ?></span>
		</h1>
	</div>
	<!-- l-content-head__inner -->

</div>
