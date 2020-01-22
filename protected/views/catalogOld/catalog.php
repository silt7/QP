<?  
    $page = $this->processOutput( $page ); 
	$designer = Page::model()->findByPk( 14 );
	$frontColorCriteria            = new CDbCriteria;
	$frontColorCriteria->condition = 'is_show=:is_show and type=:type';
	$frontColorCriteria->params    = array( ':is_show' => "1", ':type' => 'front' );
	$frontColorCriteria->order     = "material asc";
	$frontColors = Color::model()->findAll( $frontColorCriteria );
?>
<div class="body_main">
<div class="container">
	<ol class="left-m breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active"><?= $page->menu ?></li>
	</ol>
</div>
<div class="container">

	<div class="row">
		<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>

	<div class="col-sm-9">
		<h1 class="head h1"><?= $page->title ?></h1>
			<?= $page->content ?>
		<br>
		<table style="margin-bottom: 10px; width: 100%;">
			<tr>
			<td style="width: 50%;">
			<div href="#" data-toggle="modal" data-target="#designer-modal" >
				<div style="background: url(/images/new/banner1_mini.png); width: 343px; height: 130px; margin: 0 auto;" class="banner_div_mini">
					<span class="bannerOrder_b_mini">Заказать</span>
				</div>
			</div>
			</td>
			<td style="width: 50%;">
			<div href="#" data-toggle="modal" onclick="initPopupSliders()" data-target="#calculate-price-modal" >
				<div style="background: url(/images/new/banner2_mini.png); width: 343px; height: 130px; margin: 0 auto;" class="banner_div_mini">
					<span class="bannerOrder_b_mini">Заказать</span>
				</div>
			</div>
			</td>
			</tr>
		</table>
	</div>
</div>

</div>
</div>

<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>

<script type="text/javascript">
	$(function () {
		$("#nav-catalog").addClass('active');
	})
	function initPopupSliders() {

		setTimeout(function () {

			var isMobile = {
				Android: function () {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function () {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function () {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function () {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function () {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function () {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};

			if (isMobile.any()) {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 2,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});


			} else {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});


			}
		}, 10);
	}
	$(".calculate-price-modal-front-color-item").click(function () {
		var thisColor = $(this);
		thisColor.parent().find(".calculate-price-modal-front-color-item-selected").removeClass("calculate-price-modal-front-color-item-selected");
		thisColor.addClass("calculate-price-modal-front-color-item-selected");
		thisColor.find("input[type=radio]").prop("checked", true);
	});

	$(".configuration-type").click(function () {
		var thisBlock = $(this);
		$(".configuration-type-selected").removeClass("configuration-type-selected")
		thisBlock.addClass("configuration-type-selected");
		thisBlock.find("input").prop("checked", true);
	});
</script>