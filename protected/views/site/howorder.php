<script type="text/javascript">
	var redirect = 'kak-vybrat-kuhnyu';
	history.pushState('', '', redirect);
</script>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Как правильно заказать кухню?</li>
	</ol>
</div>

<div class="container for-h1">
	<h1>Как выбрать кухню?</h1>
	<?= $page->content?>
	<hr style="border-bottom: 2px dashed black; margin-bottom: 5px;">
	<?foreach($howorder as $item):?>
		<div class="howorderItem"><a href="/howorder-link/<?= $item->id;?>" ><?if ($item->image != ''):?><img src="/images/new/<?= $item->image;?>"/><?endif;?><p><?= $item->title;?></p></a></div>
	<?endforeach;?>
	<?= $page->content2?>
</div>