<?php
/**
 *  投稿リスト
 *
 */

class PostList {
	// プロパティ.
	protected $default = array( // デフォルトパラメータ.
		'card'          => '', // 出力するカードタイプ（指定する場合は対応するメソッド"the_card_***()"の作成が必要）.
		'unit'          => 'p-card__unit', // ラップするユニットのCSSクラス名.
		'type'          => '', // 投稿タイプ.
		'num'           => -1, // 取得する記事数.
		'taxonomy'      => 'category', // タクソノミーを指定.
		'term'          => '', // タームを指定.
		'orderby'       => '', // ソート基準を指定.
		'order'         => '', // 昇順(ASC)/降順(DESC)を指定.
		'related_field' => '', // ACF関連フィールドで取得した記事IDの配列.
		'mod'           => '', // ルート要素のモディファイアクラス.
		'relation'      => '', // 関連記事に使用するタクソノミースラッグ.
		'get_query_var' => '', // サブループにページネーションを出力する場合「page」を指定.
	);
	protected $custom; // カスタムパラメータ.

	// コンストラクタ.
	function __construct( $args = array() ) {
		// カスタムパラメータ初期化.
		$this->custom = $args;

		// デフォルトパラメータをパラメータとして定義.
		$param = $this->default;

		// デフォルトパラメータをカスタムパラメータでオーバーライド.
		foreach( $this->custom as $key => $value ) {
			if ( isset( $value ) ) { // 各パラメーターごとに値が設定されていれば.
				$param[$key] = $value; // 値をオーバーライド.
			}
		}

		// 最終的なパラメータを初期化.
		$this->param = $param;
	}

	/**
	 * ------ メソッド：カードユニットDOM出力：開始タグ -------
	 *
	 * 必ず終了タグとセットで使用すること
	 */
	public function unit_start() {
		?>
			<div class="<?php echo $this->param['unit']; ?>">
		<?php
	}

	/**
	 * ------ メソッド：カードユニットDOM出力：終了タグ -------
	 *
	 * 必ず終了タグとセットで使用すること
	 */
	public function unit_end() {
		?>
			</div>
			<!-- /.p-card__unit -->
		<?php
	}

	/**
	 * ------ 投稿カードの出力：リストタイプ -------
	 *
	 */
	public function the_card() {
		?>
		<div class="p-card">
			<div class="p-card__inner --meta">
				<time class="p-card__date" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
					<?php the_time( 'Y.m.d' ); // 投稿日. ?>
				</time>
				<?php $this->the_term_badge( '', false ); // タームバッジ.?>
			</div>
			<!-- /.p-card__inner --meta -->
			<div class="p-card__inner --article">
				<a href="<?php the_permalink(); // リンク先. ?>" class="p-card__ttl">
					<?php echo esc_html( get_the_title() ); // タイトル. ?>
				</a>
				<!-- /.p-card__cont -->
			</div>
			<!-- /.p-card__inner --ttl -->
		</div>
		<!-- /.p-card -->
		<?php
	}

	/**
	 * ------ 投稿カードの出力：カードタイプ -------
	 *
	 */
	public function the_card_column() {
		?>
		<div class="p-card-column">
			<a class="p-card-column__layer" href="<?php the_permalink(); ?>"></a>
			<figure class="u-plainFigure p-card-column__img">
				<img src="<?php echo get_swell_thumbnail_url() ;?>" alt="サムネイル画像">
			</figure>
			<div class="p-card-column__text">
				<div class="p-card-column__meta">
					<?php $this->the_term_badge( $this->param['taxonomy'], false, '--column' ); ?>
					<time class="p-card-column__date" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php the_time( 'Y/m/d' ); ?></time>
				</div>
				<!-- /.p-card-column__meta -->
				<p class="p-card-column__title"><?php the_title(); ?></p>
			</div>
			<!-- /.p-card-column__text -->
		</div>
		<!-- /.p-card-column -->
		<?php
	}

	/**
	 * ------ メソッド：タームバッジの出力 -------
	 *
	 * @param str  $taxonomy     タクソノミー名.
	 * @param bool $multiple     タームを全て表示するかの真偽. 偽の場合は配列の先頭タームだけ（つまり一つだけ）表示.
	 * @param str  $mod          追加で付与するクラス（複数の場合は半角スペースで区切る）.
	 */
	public function the_term_badge( $taxonomy = '', bool $multiple = true, $mod = '' ) {
		if ( empty( $taxonomy ) ) {
			$taxonomy  = array_keys( get_the_taxonomies() )[0]; // 投稿に紐づくタクソノミースラッグを取得.
		}
		$terms = get_the_terms( $post->ID, $taxonomy ); // タームオブジェクトの配列を取得.
		?>
		<?php if ( $multiple ) : ?>
			<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<div class="c-label-term__unit<?php $this->fall_back( 'add_class', $mod ); ?>">
					<?php foreach ( $terms as $term ) : ?>
						<a href="<?php echo esc_url( get_term_link( $term->slug, $taxonomy ) ); ?>" class="c-label-term<?php $this->fall_back( 'add_class', $mod ); ?>">
							<?php echo esc_html( $term->name ); ?>
						</a>
					<?php endforeach; // $terms as $term. ?>
				</div>
				<!-- /.c-label-term__unit -->
			<?php endif; // $terms. ?>
		<?php else : // $multiple . ?>
			<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<a href="<?php echo esc_url( get_term_link( $terms[0]->slug, $taxonomy ) ); ?>" class="c-label-term<?php $this->fall_back( 'add_class', $mod ); ?>">
					<?php echo esc_html( $terms[0]->name ); ?>
				</a>
			<?php else : // $terms. ?>
				<span class="c-label-term<?php $this->fall_back( 'add_class', $mod ); ?>" style="pointer-events:none;">未分類</span>
			<?php endif; // $terms. ?>
		<?php endif; // $multiple . ?>
		<?php
	}

	/**
	 * ------ サブループの取得 -------
	 *
	 */
	public function get_sub_loop() {
		// クエリパラメータを指定.
		$query = array(
			'post_type'           => $this->param['type'],
			'posts_per_page'      => $this->param['num'],
			'ignore_sticky_posts' => 1, // 先頭固定表示機能を停止.
			'orderby'             => $this->param['orderby'],
			'order'               => $this->param['order'],
			'tax_query'           => array(
				'relation' => 'AND',
			),
		);

		// 関連記事を選別.
		if ( $this->param['relation'] ) {
			$this->param['taxonomy'] = $this->param['relation']; // 関連タクソノミースラッグの割り当て.
			$current_term = get_the_terms( $post->ID, $this->param['taxonomy'] );
			if ( $current_term && ! is_wp_error( $current_term ) ) {
				$value = $current_term[0];
				if ( $value -> parent ) { // 子タームを先祖タームへ変換.
					$parent_term = get_term( $value->parent, $this->param['taxonomy'] );
					$term_slug   = $parent_term->slug;
				} else { // 親の場合はそのまま出力.
					$term_slug =  $value->slug;
				}
			}
			$this->param['term']   = $term_slug; // 関連タームの割り当て.
			$query['orderby']      = 'rand'; // 投稿の並び順をランダムに指定.
			$query['post__not_in'] = array( get_the_ID() ); // 表示中の投稿をリストから除外.
		}

		// タクソノミークエリを追加.
		if ( ! empty( $this->param['term'] || $this->param['relation'] ) ) {
			$tax_query = array(
				'taxonomy' => $this->param['taxonomy'],
				'field'    => 'slug',
				'terms'    => $this->param['term'],
			);
			array_push( $query['tax_query'], $tax_query );
		}

		// ACF関連フィールドから投稿を指定する場合.
		if ( $this->param['related_field'] ) {
			$query['posts_per_page'] = -1; // 取得する記事数を「全て」に再設定（強制的に初期値）.
			$query['post__in']       = $this->param['related_field']; // queryに含む投稿IDを指定.
			unset( $query['post__not_in'] ); // 配列からキー['post__not_in']を削除（['post__in']との共存不可のため）.
			$query['orderby']        = 'post__in'; // ソート基準を再設定（配列に入っている順）.
			$query['order']          = 'DESC'; // 昇順(ASC)/降順(DESC)をを再設定（強制的に初期値）.
		}

		// ページ番号を追加（ページネーションを使用する場合必須）.
		if ( 'page' === $this->param['get_query_var'] ) {
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
			$query['paged'] = $paged;
		}

		// クエリパラメータの配列を返す.
		return $query;
	}

	/**
	 * ------ サブループの生成 -------
	 *
	 */
	public function the_sub_loop() {
		// 使用投稿カードのメソッド名を定義.
		if ( $this->param['card'] ) {
			$func = 'the_card_' . $this->param['card']; // カスタムカード.
			if ( ! (method_exists( get_class(), $func ) ) ) { // クラス内に該当投稿カードの出力メソッドがあるか判定.
				$func = 'the_card'; // デフォルトカード.
			}
		} else {
			$func = 'the_card'; // デフォルトカード.
		}

		// サブループを生成/出力.
		$the_query = new WP_Query( $this->get_sub_loop() );
		if ( $the_query->have_posts() ) {
			$this->unit_start(); // カードのユニットDOM出力：開始タグ.
			while ( $the_query->have_posts() ) {
				$the_query->the_post(); // 無限ループ回避.

				$this->$func(); // 投稿カードの出力.
			}
			$this->unit_end();                        // カードのユニットDOM出力：終了タグ.

		} elseif ( ! ( $this->param['relation'] ) ) { // 関連記事エリア以外.
			list_notfound(); // 記事が見つからない場合の出力.
		}

		// ページネーション.
		if ( 'page' === $this->param['get_query_var'] ) {
			$this->the_pagination( $the_query, 'page' );
		}

		// WP_Queryのクエリリセット（必須）.
		wp_reset_postdata();
	}

	/**
	 * ------ ページネーション：サブループ -------
	 *
	 * @param str $query サブループ：WP_Queryクラスのインスタンス / メインループ：初期値.
	 * @param str $get_query_var サブループ：「page」/メインループ：初期値.
	 * @param int $end_size 両端のページリンクの数.
	 * @param int $mid_size 現在のページの両端にいくつページリンクを表示するか.
	 * @param int $prev_next リストの中に「前へ」「次へ」のリンクを含むか.
	 */
	public function the_pagination( $query_object = '', $get_query_var = 'paged', $end_size = 1, $mid_size = 2, $prev_next = false ) {
		if ( empty( $query_object ) ) {
			global $wp_query;
			$query_object = $wp_query;
		}
		$format = paginate_links (
			array(
				'current'   => max( 1, get_query_var( $get_query_var ) ),
				'total'     => $query_object->max_num_pages,
				'type'      => 'array',
				'prev_text' => '前へ', // 前へのリンク文言.
				'next_text' => '次へ', // 次へのリンク文言.
				'end_size'  => $end_size,
				'mid_size'  => $mid_size,
				'prev_next' => $prev_next,
			)
		);
		?>
		<?php if ( is_array( $format ) ) :
			$paged = get_query_var( $get_query_var ) == 0 ? 1 : get_query_var( $get_query_var );
			?>
			<div class="c-pagination">
				<?php foreach ( $format as $page ) : ?>
					<?php echo wp_kses_post( $page ); ?>
				<?php endforeach; ?>
			</div>
			<!-- /.c-pagenation -->
		<?php endif; // is_array( $format ). ?>
		<?php
	}

	/**
	 * ------ メインループの生成 -------
	 *
	 */
	public function the_main_loop() {
		// 使用投稿カードのメソッド名を定義.
		if ( $this->param['card'] ) {
			$func = 'the_card_' . $this->param['card']; // カスタムカード.
			if ( ! (method_exists( get_class(), $func ) ) ) { // クラス内に該当投稿カードの出力メソッドがあるか判定.
				$func = 'the_card'; // デフォルトカード.
			}
		} else {
			$func = 'the_card'; // デフォルトカード.
		}

		// 記事がなかった場合
		if ( ! have_posts() ) :
			$not_founded_text = __( '記事が見つかりませんでした。', 'swell' );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo apply_filters( 'swell_post_list_404_text', '<p>' . $not_founded_text . '</p>' );
			return;
		endif;

		// ループ
		echo '<div class="' . esc_attr( $this->param['unit'] ) . '">';
		while ( have_posts() ) :
			the_post();

			$this->$func();

		endwhile;
		echo '</div>';
	}

	/**
	 * ------ フォールバックメソッド -------
	 * コールバック関数に指定した関数が関数定義されていればそれを、そうでなければクラス内同名メソッドを使用する.
	 * 
	 * @param str $function コールバック関数.
	 * @param str $args     関数に指定する可変長引数.
	 */
	protected function fall_back( $function, ...$args ) {
		if( function_exists( $function ) ) {
			$function( ...$args ); // クラス外で定義されている場合.
		} else {
			$this->$function( ...$args ); // フォールバック.
		}
	}

	/**
	 * ------ メソッド：CSSクラス名追記 -------
	 *
	 * @param str $mod 追記するCSSクラス名を指定（先頭にハイフンが自動追記される）.
	 */
	protected function add_name( $mod = '' ) {
		if ( $mod ) {
			$mod = '-' . $mod;
			echo esc_attr( $mod );
		} else {
			return false;
		}
	}

	/**
	 * ------ メソッド：追加CSSクラス付与 -------
	 *
	 * @param str $mod 追加で付与するCSSクラス（複数の場合は半角スペースで区切る）.
	 */
	protected function add_class( $mod = '' ) {
		if ( $mod ) {
			$mod = ' ' . $mod;
			echo esc_attr( $mod );
		} else {
			return false;
		}
	}
}
