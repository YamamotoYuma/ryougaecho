<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$spmenu_class = ( 'center_left' === SWELL_Theme::get_setting( 'header_layout_sp' ) ) ? '-left' : '-right';
?>
<div id="sp_menu" class="p-spMenu <?=esc_attr( $spmenu_class )?>">
	<div class="p-spMenu__inner">
		<div class="p-spMenu__closeBtn">
			<button class="c-iconBtn -menuBtn c-plainBtn" data-onclick="toggleMenu" aria-label="<?=esc_attr__( 'メニューを閉じる', 'swell' )?>">
				<i class="c-iconBtn__icon icon-close-thin"></i>
			</button>
		</div>
		<div class="p-spMenu__body">
			<div class="p-spMenu__nav">
				<?php
					wp_nav_menu(
						array(
							'menu_id'        => 'navSpMenu',
							'container'      => false,
							'menu_class'     => 'p-nav-spMenu',
							'theme_location' => 'nav_sp_menu',
						)
					);
				?>
			</div>
			<?php
				// \SWELL_Theme::outuput_widgets( 'sp_menu_bottom', [
				// 	'before' => '<div id="sp_menu_bottom" class="p-spMenu__bottom w-spMenuBottom">',
				// 	'after'  => '</div>',
				// ] );
			?>
		</div>
	</div>
	<div class="p-spMenu__overlay c-overlay" data-onclick="toggleMenu"></div>
</div>
