<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$placeholder = apply_filters( 'swell_searchform_placeholder', __( 'キーワードをご入力ください', 'swell' ) );
?>
<form role="search" method="get" class="p-form-search" action="<?=esc_url( home_url( '/' ) )?>" role="search">
	<input type="text" value="<?php the_search_query(); ?>" name="s" class="p-form-search__input" placeholder="<?=esc_attr( $placeholder )?>" aria-label="<?=esc_attr__( '検索ワード', 'swell' )?>">
	<input type="hidden" value="tenant" name="post_type">
	<button type="submit" class="p-form-search__button" value="search" aria-label="<?=esc_attr__( '検索を実行する', 'swell' )?>"><i class="fas fa-search"></i></button>
</form>
