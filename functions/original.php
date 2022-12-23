<?php
/**
 * ユーザー定義関数
 *
 * @package WordPress
 */

use SWELL_Theme as INITIAL; // 親テーマからクラスをインポート.

/*
--------------------------------
 *  ベース関数
--------------------------------
*/

/**
 * コンソールログを表示
 *
 * @param str $postID comment.
 */
function console_log( $data ){
    echo '<script>';
    echo 'console.log(' . json_encode( $data ) . ')';
    echo '</script>';
}

/**
 * ------ クラス付与 -------
 *
 * @param str $mod クラス名.
 */
function add_class( $mod = '' ) {
	if ( $mod ) {
		$mod = ' ' . $mod;
		echo esc_attr( $mod );
	} else {
		return false;
	}
}

/**
 * ------ モディファイアクラスとしてページスラッグを出力 -------
 * 
 */
function add_my_class() {
	$post_obj =  $GLOBALS['wp_the_query']->get_queried_object();
	$slug = '';
	if( is_front_page() ) {
		$slug = '--top';
		if(is_page() && get_post( get_the_ID() )->post_name) {
			$slug = '--' . $post_obj->post_name;
		}
	} elseif ( is_tax() || is_category() ) {
		$slug = '--search-results --' . $post_obj->taxonomy;
	} elseif ( is_home() ) {
		$slug = '--archive --' . $post_obj->post_name;
	} elseif ( is_post_type_archive() ) {
		$slug = '--archive --' . $post_obj->name;
	} elseif ( is_page() ) {
		$slug = '--' . $post_obj->post_type . ' --' . $post_obj->post_name;
	} elseif ( is_single() ) {
		$slug = '--single --' . $post_obj->post_type;
	} elseif ( is_search() ) {
		$slug  = '--search-results';
	} elseif ( is_404() ) {
		$slug = '--error404';
	}
	echo ' ' . esc_attr( $slug );
}

/**
 * ------ NOIMAGE（ソースURL） -------
 *
 */
function get_noimg_url() {
	$SETTING   = INITIAL::get_setting();
	$noimg_id  = $SETTING['noimg_id'];
	$noimg_url = wp_get_attachment_url( $noimg_id ) ?: INITIAL::get_setting( 'no_image' ) ?: T_DIRE_URI . '/assets/img/no_img.png';
	return $noimg_url;
}

/**
 * ------ NOIMAGE（代替テキスト） -------
 *
 */
function get_noimg_alt() {
	$noimg_alt = get_bloginfo( 'name' );
	return $noimg_alt;
}

/**
 * ------ アイキャッチ画像（サムネイル） -------
 *
 */
function get_swell_thumbnail_url( $postID = '' ) {
	$thumbnail_url = get_the_post_thumbnail_url( $postID ) ?: get_noimg_url();
	return $thumbnail_url;
}

/*
--------------------------------
 *  パーツ出力
--------------------------------
*/

/**
 * サイトロゴ（白）
 *
 */
function get_site_logo_white() {
	$img_src = get_stylesheet_directory_uri() . '/img/site-logo_w.svg';

	if ( is_front_page() ) {
		$wrapper_start = '<div class="c-logo-white__link">';
		$wrapper_end   = '</div>';
	} else {
		$wrapper_start = '<a class="c-logo-white__link" href="' . home_url() . '">';
		$wrapper_end   = '</a>';
	}

	return $wrapper_start . '<img src="' . $img_src . '" class="c-logo-white__img" alt="' . get_bloginfo( 'name' ) . '">' . $wrapper_end;
}

/**
 * ------ QRコード -------
 *
 * @param str $name URLフィールド名.
 * @param str $size 縦横サイズpx（160）.
 * @param str $op オプションページ是非（option）.
 */
function the_qrcode( $name, $size = '150', $op = 'option' ) {
	?>
	<figure class="c-qrcode">
		<img src="https://chart.googleapis.com/chart?chs=<?php echo esc_attr( $size ); ?>x<?php echo esc_attr( $size ); ?>&cht=qr&chl=<?php the_field( $name, $op ); ?>&choe=UTF-8 " alt="QR Code"/>
	</figure>
	<?php
}

/**
 * ------ YouTube動画URL -------
 *
 * @param str $name URLフィールド名.
 * @param str $op オプションページ是非（option）.
 * @param str $mod 追加クラス.
 */
function the_youtube( $name, $op = 'option', $mod = '' ) {
	$yt_url   = get_field( $name, $op ); // フィールドの値（URL）を変数に格納.
    preg_match('/\?v=([^&]+)/', $yt_url, $match); // URLから正規表現によるマッチング検索.
    $yt_id = $match[1]; // URLから動画IDを抽出.
	?>
	<div class="c-video<?php add_class( $mod ); ?>" style="position: relative; padding-bottom: 56.25%;">
		<iframe 
				style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
				src="https://www.youtube.com/embed/<?php echo esc_attr( $yt_id ); ?>?mute=1" 
				frameborder="0" 
				allow="autoplay; encrypted-media" 
				allowfullscreen>
		</iframe>
	</div>
	<?php
}

/**
 * ------ GoogleMaps -------
 *
 * @param str $name ACFフィールド名.
 * @param str $op オプションページ是非（option）.
 * @param str $mag 倍率.
 * @param str $mod 追加クラス.
 */
function the_googlemap( $name, $op = 'option', $mag = 17, $mod = '' ) {
	$map_ttl    = get_field( $name, $op ); // フィールドの値（テキスト）を変数に格納.
    $map_str    = str_replace(array(" ", "　"), "", $map_ttl); // 文字列内のスペースを除外.
	$map_encode = rawurlencode( $map_str ); // 文字列をURLエンコード.
	?>
    <div class="c-map<?php add_class( $mod ); ?>">
        <iframe src="https://maps.google.com/maps?output=embed&z=
			<?php echo esc_attr( $mag ); ?>
			&q=<?php echo esc_attr( $map_encode ); ?>" 
            width="100%" height="100%" style="border:0;" aria-hidden="false" tabindex="0" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
	<?php
}

/*
--------------------------------
 *  その他
--------------------------------
*/

/**
 * ------ 特定のタクソノミーからタームを出力 -------
 *
 * @param str $taxonomy タクソノミー.
 */
function the_single_tarms( $taxonomy, $mod = '' ) {
	$terms = get_the_terms( $post->ID, $taxonomy );
	?>
	<?php if ( ! empty( $terms ) ) : // 投稿に紐づくタームが存在すれば. ?>
		<?php if ( ! is_wp_error( $terms ) ) : // エラー出力がなければ. ?>
			<div class="p-term__unit<?php add_class( $mod ); ?>">
				<?php foreach ( $terms as $term_value ) : // A. ?>
					<?php $tarm_link = get_term_link( $term_value->slug, $taxonomy ); // タームリンク. ?>
					<a class="p-term" href="<?php echo esc_url( $tarm_link ); ?>">
						<?php echo esc_html( $term_value->name ); // タームラベル. ?>
					</a>
				<?php endforeach; // A. ?>
			</div>
			<!-- /.p-term__unit -->
		<?php endif; // エラー出力がなければ. ?>
	<?php endif; // 投稿に紐づくタームが存在すれば. ?>
	<?php
}

/**
 * ------ 記事なしメッセージ -------
 * 
 */
function list_notfound( $txt = '記事が見つかりませんでした。' ) {
	?>
	<div class="p-card-not">
		<div class="p-card-not__txt"><?php echo esc_html( $txt ); ?></div>
	</div>
	<!--./ p-card-no -->
	<?php
}
