<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
while ( have_posts() ) : the_post();

// タグ一覧の取得
$terms = get_the_terms( $post->ID, 'tenant_tag' );

// テナント情報
$tenant_address = get_field( 'tenant_address' );
$tenant_tell    = get_field( 'tenant_tell' );
$tenant_site    = get_field( 'tenant_site' );
$tenant_intro   = get_field( 'tenant_intro' );
?>
<main id="main_content" class="l-mainContent l-article">
	<?php
	if ( $terms && ! is_wp_error( $terms ) ) {
		echo '<p class="l-mainContent__terms">';
		foreach ( $terms as $key => $value ){
			echo '<span>' . esc_html( $value->name ) . '</span>';
			if ( $key !== array_key_last( $terms ) ) echo '<span> / </span>';
		}
		echo '</p>';
	}
	?>
	<h1 class="l-mainContent__title"><?php the_title(); ?></h1>
	<article class="l-mainContent__inner --tenant">
		<table class="l-mainContent__table">
			<?php if ( $tenant_address ) : ?>
				<tr>
					<th class="l-mainContent__th">住所</th>
					<td class="l-mainContent__td"><?php echo wp_kses_post( $tenant_address ); ?></td>
				</tr>
			<?php endif; // $tenant_address. ?>
			<?php if ( $tenant_tell ) : ?>
				<tr>
					<th class="l-mainContent__th">電話番号</th>
					<td class="l-mainContent__td"><?php echo wp_kses_post( $tenant_tell ); ?></td>
				</tr>
			<?php endif; // $tenant_tell. ?>
			<?php if ( $tenant_site ) : ?>
				<tr>
					<th class="l-mainContent__th">ホームページ</th>
					<td class="l-mainContent__td"><a href="<?php echo esc_url( $tenant_site ); ?>" target="_blank"><?php echo esc_url( $tenant_site ); ?></a></td>
				</tr>
			<?php endif; // $tenant_site. ?>
			<?php if ( $tenant_intro ) : ?>
				<tr>
					<th class="l-mainContent__th">店舗紹介</th>
					<td class="l-mainContent__td"><?php echo wp_kses_post( $tenant_intro ); ?></td>
				</tr>
			<?php endif; // $tenant_intro. ?>
		</table>
	</article>
	<a href="<?php echo home_url( 'tenant' ); ?>" class="c-btn">テナント一覧へ戻る<i class="fas fa-angle-right"></i></a>
</main>
<?php endwhile; ?>
<?php get_footer(); ?>
