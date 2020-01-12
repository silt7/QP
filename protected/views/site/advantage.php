<? $page = $this->processOutput( $page ); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active"><?= $page->title ?></li>
	</ol>
</div>
<div class="container">
	<h1 class="head"> <?= $page->title ?> </h1>

	<?if($page->content != ''){echo $page->content;} ?>
	<hr style="border-bottom: 2px dashed black; margin-bottom: 5px;">
	<?foreach($whyorder as $item):  $pachImg = '/images/new/'.$item->image;?>
		<? if ($item->image == ''){$pachImg = '/images/without.jpg';}?>
		<div class="howorderItem"><a href="/whyorder/<?= $item->id;?>" ><img src="<?= $pachImg;?>"/><p><?= $item->title;?></p></a></div>
	<?endforeach;?>
	<?= $page->content2 ?>
</div>
<script>
	$(function () {
		$("#nav-info").addClass('active');
	})
</script>