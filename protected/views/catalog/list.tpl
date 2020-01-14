<div class="row">
    <h1><?= $obj['page']->title;?></h1>
</div>
<div class="row">
    <h1><?= $obj['page']->content;?></h1>
</div>
<div class="row">
    <?foreach($obj['list'] as $item):?>
        <div class="col-sm-3"><?= $item->id?></div>
    <?endforeach;?>
</div>
<div class="row">
    <h1><?= $obj['page']->content2;?></h1>
</div>
<script type="text/javascript">
    $(function () {
		$("#catalog-menu-<?= $obj['idMenu'];?>").addClass('active');
	})
</script>