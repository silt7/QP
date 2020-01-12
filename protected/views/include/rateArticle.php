<style>
	.colorStar{
		color:yellow;
	}
	
</style>
<? $pointRate = $ratingPage['point'];?>
<div class="container" id="div-rate" name="<?= $ratingPage['name']?>">
	<?for($i=1; $i<6; $i++):?>			
		<?	
			$classColor = '';
			if($pointRate > 0){$classColor = ' fa-star colorStar';}
			else{$classColor = 'fa-star-o';}
			if($pointRate == 0.5){$classColor = ' fa-star-half-o colorStar';}
			$pointRate = $pointRate - 1;
		?>
			
		<i class="fa <?= $classColor;?>" onClick="updateRate(<?= $i;?>);"></i>
	<?endfor?>
	Проголосовало <?= $ratingPage['count']?>, Баллов <?= $ratingPage['point']?>
</div>
<script>
	function updateRate(point){
		$('#div-rate i').removeAttr('onClick');
		var pageRate = $('#div-rate').attr('name');
		$.ajax({
			type: "POST",
			dataType: 'json',
			data: {page:pageRate,point:point},
			url: "/site/rateArticle",
			success: function(msg){
				location.reload();
			}
		})
	}
</script>