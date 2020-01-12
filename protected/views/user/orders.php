<? $orders = $this->processOutput( $orders ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/profile" class="link">Профиль</a></li>
		<li class="active">Мои заказы</li>
	</ol>
</div>
<div class="container qp_profile-orders">
	<h1 class="head">Мои заказы</h1>
	
    <input type="hidden" id="new-order" value="<?if (isset($_GET['new_order'])){echo $_GET['new_order'];}?>">
    <p style="margin-top: -30px;font-size: 24px;">Для завершения оформления заказа(ов) выберите удобный для Вас способ:
        <ul style="font-size: 24px; margin-bottom: 35px; ">
            <li>
                посетите наш салон по адресу: СПб, Шлиссельбургский пр., д. 3-7, секция 134. тел.
                +7 (812) 952-97-83, +7 (812) 907-35-03
            </li>
            <li>
                вызовите дизайнера-замерщика для оформления заказа на дому. тел. +7 (812) 952-97-83.
            </li>
        </ul>
    </p>
	<?
	if ( $orders )
		foreach ( $orders as $order ):
	?>
			<div class="row">
				<div class="col-sm-4"><?= $order->getTitle(); ?> </div>
				<div class="col-sm-2"><?= $order["total_price"];//= $order->getTotalPrice(); ?> <i class="fa fa-rub"></i></div>
				<div class="col-sm-4"><?= Order::$statusArray[ $order->status ]["label"]; ?> </div>
				<div class="col-sm-2"><a href="/profile/order/<?= $order->id; ?>" class="more pull-right">Подробнее</a></div>

			</div>

		<? endforeach ?>
</div>
<div class="fancybox-overlay fancybox-overlay-fixed" style="display: none; width: auto; height: auto;" id="order-modal">
	<div id="order-modal-banner" class="fancybox-wrap fancybox-desktop fancybox-type-image fancybox-opened" tabindex="-1" style="opacity: 1; overflow: visible; height: auto; width: 1030px; position: absolute; top: 30%; left: 50%; margin-left: -500px;">
		<div class="fancybox-skin" style="padding: 15px; width: auto; height: auto; background: #F9CA1A;"><div class="fancybox-outer" style="width: 100%; height: 100%; background: #fff;  display: inline-block; padding: 20px;">
		    <div class="fancybox-inner" style="overflow: visible; float: left; text-align: center;">
		    <p style="font-family: Cambria, Georgia, serif; font-size: 46px; font-weight: bold; font-style: italic;"><span style="color:#F9CA1A;">QP</span>-kuhni</p>
	        <img class="fancybox-image" src="/images/cart.jpg" alt="" style="width: 357px; height: 285px;">
			</div>
			<div>
            	<p style="font-size: 26px;">Ваш заказ № QP-<?= $orders[0]->id?> создан. <br> Для завершения оформления заказа(ов) выберите<br> удобный для Вас способ:
                    <ul style="font-size: 24px; margin-bottom: 35px; ">
                        <li>
                           - посетите наш салон по адресу: СПб, Шлиссельбургский пр.,<br> д. 3-7, секция 134. тел.
                            +7 (812) 952-97-83, +7 (812) 907-35-03
                        </li>
                        <li>
                          <br>- вызовите дизайнера-замерщика для оформления заказа на дому. тел. +7 (812) 952-97-83.
                        </li>
                    </ul>
                </p>
			</div>
		</div>
			<a title="Close" id="order-modal-close" class="fancybox-item fancybox-close" href="javascript:;"></a>
		</div>
	</div>
</div>
<script type="text/javascript">
    if($('#new-order').val() == 1){
	    $('#order-modal').show(800); 
    }
	$('#order-modal').click(function(){
		$('#order-modal').hide();
	})
	$('#order-modal-banner').click(function(event){
		event.stopPropagation();
	})
 	$('#order-modal-close').click(function(event){
		event.stopPropagation();
		$('#order-modal').hide();
	})	
</script>