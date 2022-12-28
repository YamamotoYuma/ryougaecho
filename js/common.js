jQuery(document).ready(function ($) {
	// ---------------------------------------------------------------------------------------------[jQuery記述欄ここから]

	// インラインバリデーションオプション
	$("#inline-validation-engine").validationEngine( 'attach',{
		promptPosition: "topLeft"
	} );
	$(".ve-require").addClass("validate[required]");
	$(".ve-email").addClass("validate[required,custom[email]]");
	$(".ve-phone").addClass("validate[custom[phone]]");
	$(".ve-url").addClass("validate[custom[url]]");
	// $(".ve-postal").addClass("validate[required,custom[number]]");
	// $(".ve-rubi").addClass("validate[required,custom[katakana]]");


	/*--------------------------------
	 * 拡散検索ユニット
	--------------------------------*/
	if($('.p-card-tenant__unit').length){
		var hashs=[];
		onHashchange();
		$(window).on( 'hashchange', onHashchange );
	
		//ハッシュで条件指定
		function onHashchange() {
			var hashFilter = getHashFilter();
		  	if ( !hashFilter ) {
				hashs = []
				$('.js-search-tag').removeClass("is-active")
				$("[data-term='"+ 'all' +"']").addClass("is-active")
				$('.js-search-card').addClass("is-show")
			} else {
				hashs = hashFilter.split(',');
				$('.js-search-tag').removeClass("is-active")
				$('.js-search-card').removeClass("is-show")
		
				var classes='';
		
				hashs.forEach(function(elm){
				$("[data-term='"+ elm +"']").addClass("is-active") 
				$('.js-search-card'+'.'+elm).addClass("is-show");
				classes += '.'+elm;
				})
		
			}
			countActive();
		}
	
		//タグクリックからハッシュへ変換
		$('.js-search-tag').on('click',function(){
			var this_hash=$(this).data('term')
			if (this_hash=='all') {
				hashs= [];
			} else {
				var index=hashs.findIndex((elm) => elm==this_hash) 
				if (index<0) {
					//存在しない場合は追加
					hashs.push(this_hash)
				} else {
					//存在する場合は削除
					hashs.splice(index,1)
				}
			}
			
			window.location.hash='filter='+hashs.toString()
		})
	}

	function getHashFilter() {
	  var hash = location.hash;
	  var matches = location.hash.match( /filter=([^&]+)/i );
	  var hashFilter = matches && matches[1];
	  return hashFilter && decodeURIComponent( hashFilter );
	}

	/*--------------------------------
	 *  表示テナント数カウント
	--------------------------------*/
	function countActive() {
		let countActive   = $('.js-search-card.is-show').length;
		let counterNumber = $('.js-counter');
		counterNumber.text( countActive );
	}
	countActive();
	// ---------------------------------------------------------------------------------------------[jQuery記述欄ここまで]
});