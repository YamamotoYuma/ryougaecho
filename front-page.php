<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
while ( have_posts() ) :
the_post();

// FV
$fv_img = get_stylesheet_directory_uri() . "/img/picture/pi_03.jpg";
?>
	<main id="main_content" class="l-mainContent">
		<div class="l-mainContent__inner">

			<section class="l-sect-home l-sect-fv sm" style="background-image:url('<?php echo $fv_img ;?>');"></section>
			<!-- /.l-sect-home l-sect-fv -->

			<section class="l-sect-home l-sect-news">
				<?php
					$list_news = new PostList(
						array(
							'type' => 'news',
							'num'  => 5,
						)
					);
					$list_news->the_sub_loop();
				?>
			</section>
			<!-- /.l-sect-home l-sect-news -->

			<section class="l-sect-home l-sect-areaMap">
				<h2 class="c-heading-lv2">
					<span class="c-heading-lv2__en">AREA MAP</span>
					<span class="c-heading-lv2__jp">両替町マップ</span>
				</h2>
				<div class="l-sect-areaMap__map">
					<img src="<?php echo get_stylesheet_directory_uri() . "/img/picture/pi_04.jpg"; ?>" alt="">
				</div>
			</section>
			<!-- /.l-sect-home l-sect-areaMap -->

			<section class="l-sect-home l-sect-charmHistory">
				<div class="l-sect-charmHistory__col --charm">
					<h2 class="c-heading-lv2">
						<span class="c-heading-lv2__en">CHARM</span>
						<span class="c-heading-lv2__jp">魅力</span>
					</h2>
					<p>aaa</p>
				</div>
				<!-- /.l-sect-charmHistory__col --charm -->
				<div class="l-sect-charmHistory__col --history">
					<h2 class="c-heading-lv2">
						<span class="c-heading-lv2__en">HISTORY</span>
						<span class="c-heading-lv2__jp">歴史</span>
					</h2>
					<p>aaa</p>
				</div>
				<!-- /.l-sect-charmHistory__col --history -->
			</section>
			<!-- /.l-sect-home l-sect-charmHistory -->

			<section class="l-sect-home l-sect-blog">
				<h2 class="c-heading-lv2">
					<span class="c-heading-lv2__en">BLOG</span>
					<span class="c-heading-lv2__jp">活動記録</span>
				</h2>
			</section>
			<!-- /.l-sect-home l-sect-blog -->

			<section class="l-sect-home l-sect-about">
				<h2 class="c-heading-lv2">
					<span class="c-heading-lv2__en">ABOUT</span>
					<span class="c-heading-lv2__jp">発展会概要</span>
				</h2>
			</section>
			<!-- /.l-sect-home l-sect-about -->

			<?php
				\SWELL_Theme::outuput_widgets( 'front_bottom', [
					'before' => '<div class="w-frontBottom">',
					'after'  => '</div>',
				] );
			?>
		</div>
	</main>
<?php
endwhile;
get_footer();
