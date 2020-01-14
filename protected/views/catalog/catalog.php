<div class="body_main">
    <div class="container">
        <ol class="left-m breadcrumb">
            <li>
                <a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a>
            </li>
            <li class="active">
                <?= $obj['title']; ?>
            </li>
        </ol>
        <div class="row">
            <div class="col-sm-3">
                <?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/left-menu.tpl" ); ?>
            </div>
            <div class="col-sm-9">
                <?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/{$obj['template']}.tpl" ); ?>
            </div>
        </div>
        <div class="row" id="content">
            <? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/banner.php" );  ?>
            <script>
		        $('.a-calc').removeAttr('href');
		        $('#free-payment').click(function(){
			        $('#hide-button').trigger('click');
		        })
            </script>
            <a id="hide-button" data-toggle="modal" data-target="#calculate-price-modal" style="display:none">скрытый вызов</a>
            <? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
		$("#nav-catalog").addClass('active');
	})
</script>