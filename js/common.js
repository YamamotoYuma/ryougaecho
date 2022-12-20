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

	// ---------------------------------------------------------------------------------------------[jQuery記述欄ここまで]
});