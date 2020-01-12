<?php $colorHint = $this->processOutput( $colorHint ); ?>

<div class="constructor-hint" id="constructor-hint">
	<div class="c-h-front-color float-left">
		<div class="c-h-label float-left">
			Фасад
		</div>
		<div class="c-h-color float-left">
			<?= $colorHint->getFrontColorString() ?>
		</div>
		<div class="clear-left"></div>

	</div>
	<div class="c-h-module-color float-left">
		<div class="c-h-label float-left">
			Модуль
		</div>
		<div class="c-h-color float-left">
			<?= $colorHint->getModuleColorString() ?>
		</div>
		<div class="clear-left"></div>

	</div>
	<div class="c-h-next-step-btn float-left">
		<a href="<?php echo Yii::app()->createAbsoluteUrl( "catalog/kitchenmodules" ); ?>">Следующий этап
			<i class="fa fa-arrow-circle-o-right"></i></a>
	</div>
	<div class="clear-left"></div>
</div>