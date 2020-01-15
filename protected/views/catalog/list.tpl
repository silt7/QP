<div class="row">
    <h1><?= $obj['page']->title;?></h1>
</div>
<div class="row">
    <h1><?= $obj['page']->content;?></h1>
</div>
<div class="row">
    <?foreach($obj['list'] as $item):?>
        <div class="col-md-3">
            <div class="qp-list">
			    <a href="/catalog/<?= $obj['pathItem'].$item->id?>" class="inner">
			    <br><?= $item->title?>
                <img src="<?= $obj['pathImg'].$item->image?>" alt="Мойки и смесители" width="100%"></a>
                <a href="/catalog/kuhonnye-aksessuary/10" class="by-fronts">Смотреть</a>
		    </div>
        </div>

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