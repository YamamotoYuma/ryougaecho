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
				<div class="l-sect-news__col --left">
					<h2 class="c-heading-lv2-small">NEWS</h2>
					<a href="<?php echo home_url( 'news' ); ?>" class="c-label-more mdlg">一覧を見る</a>
				</div>
				<!-- /.l-sect-news__col --left -->
				<div class="l-sect-news__col --right">
					<?php
						$list_news = new PostList(
							array(
								'type' => 'news',
								'num'  => 5,
							)
						);
						$list_news->the_sub_loop();
					?>
				</div>
				<!-- /.l-sect-news__col --right -->
				<a href="<?php echo home_url( 'news' ); ?>" class="c-label-more sm">一覧を見る</a>
			</section>
			<!-- /.l-sect-home l-sect-news -->

			<section class="l-sect-home l-sect-areaMap">
				<h2 class="c-heading-lv2">
					<span class="c-heading-lv2__en">AREA MAP</span>
					<span class="c-heading-lv2__jp">両替町マップ</span>
				</h2>
				<div class="l-sect-areaMap__inner">
					<div class="l-sect-areaMap__map">
						<img src="<?php echo get_stylesheet_directory_uri() . "/img/picture/pi_04.jpg"; ?>" alt="">
					</div>
					<a href="<?php echo home_url( 'tenant' ); ?>" class="c-btn">テナント一覧を見る<i class="fas fa-angle-right"></i></a>
				</div>
				<!-- /.l-sect-areaMap__inner -->
			</section>
			<!-- /.l-sect-home l-sect-areaMap -->

			<section class="l-sect-home l-sect-charmHistory">
				<div class="l-sect-charmHistory__col --charm">
					<h2 class="c-heading-lv2">
						<span class="c-heading-lv2__en">CHARM</span>
						<span class="c-heading-lv2__jp">魅力</span>
					</h2>
					<div class="l-sect-charmHistory__img">
						<img src="<?php echo get_stylesheet_directory_uri() . "/img/photo/ph_01.jpg"; ?>" alt="">
					</div>
					<p class="l-sect-charmHistory__desc">説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。</p>
					<a href="<?php echo home_url( 'charm' ); ?>" class="c-btn">詳しく見る<i class="fas fa-angle-right"></i></a>
				</div>
				<!-- /.l-sect-charmHistory__col --charm -->
				<div class="l-sect-charmHistory__col --history">
					<h2 class="c-heading-lv2">
						<span class="c-heading-lv2__en">HISTORY</span>
						<span class="c-heading-lv2__jp">歴史</span>
					</h2>
					<div class="l-sect-charmHistory__img">
						<img src="<?php echo get_stylesheet_directory_uri() . "/img/photo/ph_02.jpg"; ?>" alt="">
					</div>
					<p class="l-sect-charmHistory__desc"></p>
					<a href="<?php echo home_url( 'history' ); ?>" class="c-btn">詳しく見る<i class="fas fa-angle-right"></i></a>
				</div>
				<!-- /.l-sect-charmHistory__col --history -->
			</section>
			<!-- /.l-sect-home l-sect-charmHistory -->

			<section class="l-sect-home l-sect-blog">
				<div class="l-sect-blog__title">
					<h2 class="c-heading-lv2">
						<span class="c-heading-lv2__en">BLOG</span>
						<span class="c-heading-lv2__jp">活動記録</span>
					</h2>
					<a href="<?php echo home_url( 'blog' ); ?>" class="c-label-more mdlg">一覧を見る</a>
				</div>
				<!-- /.l-sect-blog__title -->
				<?php
					$list_blog = new PostList(
						array(
							'card' => 'blog',
							'num'  => 4,
							'unit' => 'p-card-blog__unit'
						)
					);
					$list_blog->the_sub_loop();
				?>
				<a href="<?php echo home_url( 'blog' ); ?>" class="c-label-more sm">一覧を見る</a>
			</section>
			<!-- /.l-sect-home l-sect-blog -->

			<section class="l-sect-home l-sect-about">
				<h2 class="c-heading-lv2">
					<span class="c-heading-lv2__en">ABOUT</span>
					<span class="c-heading-lv2__jp">発展会概要</span>
				</h2>
				<div class="p-media">
					<div class="p-media__col --left">
						<img class="p-media__img" src="<?php echo get_stylesheet_directory_uri() . "/img/photo/ph_03.jpg"; ?>" alt="">
					</div>
					<!-- /.p-media__col --left -->
					<div class="p-media__col --right">
						<p class="p-media__title">見出しテキストが入ります。 見出しテキストが入ります。</p>
						<p class="p-media__desc">説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。説明テキストが入ります。</p>
						<a href="" class="c-btn">詳しく見る<i class="fas fa-angle-right"></i></a>
					</div>
					<!-- /.p-media__col --right -->
				</div>
				<!-- /.p-media -->
				<div class="c-map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3269.31788122579!2d138.37961391523964!3d34.97370158036539!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601a4a1e2e366647%3A0xa649184aced71e11!2z44CSNDIwLTAwMzIg6Z2Z5bKh55yM6Z2Z5bKh5biC6JG15Yy65Lih5pu_55S677yS5LiB55uu77yS4oiS77yTIOOCpOOCu-ODiOOCpuODk-ODqw!5e0!3m2!1sja!2sjp!4v1671787494644!5m2!1sja!2sjp" width="100%" height="100%" style="border:0;" aria-hidden="false" tabindex="0" allowfullscreen="" loading="lazy">
					</iframe>
				</div>
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
