<ol class="breadcrumb">
	<li>
		<a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a>
	</li>
	<?foreach($obj['breadcrumb'] as $item): ?>
		<li><a href="<?= $item['path']?>" class="link"><?= $item['title']?></a></li> 
	<?endforeach;?>
</ol>