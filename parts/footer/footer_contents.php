<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="l-footer__inner">
	<?php
		SWELL_Theme::get_parts( 'parts/footer/foot_widget' );
	?>
		<div class="l-footer__body">
			<div class="l-footer__body__inner l-container">
				<div class="l-footer__col --profile">
					<div class="l-footer__logo">
						<?php echo get_site_logo_white(); ?>
					</div>
					<!-- /.l-footer__logo -->
					<div class="l-footer__meta-box">
						<p>静岡県静岡市葵区両替町2丁目2-3</p>
					</div>
					<!-- /.l-footer__meta -->
					<?php
						if ( SWELL_Theme::get_setting( 'show_foot_icon_list' ) ) :
							$sns_settings = SWELL_Theme::get_sns_settings();
							if ( ! empty( $sns_settings ) ) :
								$list_data = [
									'list_data' => $sns_settings,
									'fz_class'  => 'u-fz-14',
								];
								SWELL_Theme::get_parts( 'parts/icon_list', $list_data );
							endif;
						endif;
					?>
				</div>
				<!-- /.l-footer__col --profile -->
				<div class="l-footer__col --navi">
					<?php
						wp_nav_menu([
							'container'       => false,
							'fallback_cb'     => '',
							'theme_location'  => 'footer_menu',
							'items_wrap'      => '<ul class="p-nav-footer">%3$s</ul>',
							'link_before'     => '',
							'link_after'      => '',
						]);
						wp_nav_menu([
							'container'       => false,
							'fallback_cb'     => '',
							'theme_location'  => 'footer_menu_2',
							'items_wrap'      => '<ul class="p-nav-footer">%3$s</ul>',
							'link_before'     => '',
							'link_after'      => '',
						]);
					?>
				</div>
				<!-- /.l-footer__col --navi -->
			</div>
			<!-- /.l-footer__body__inner -->
		</div>
		<!-- /.l-footer__body -->
		<div class="l-footer__bottom l-container">
			<?php
				wp_nav_menu([
					'container'       => false,
					'fallback_cb'     => '',
					'theme_location'  => 'footer_menu_3',
					'items_wrap'      => '<ul class="p-nav-bottom">%3$s</ul>',
					'link_before'     => '',
					'link_after'      => '',
				]);
			?>
			<p class="copyright">
				<span lang="en">&copy;</span>
				<?=wp_kses( SWELL_Theme::get_setting( 'copyright' ), SWELL_Theme::$allowed_text_html )?>
			</p>
		</div>
		<!-- /.l-footer__bottom -->

</div>
