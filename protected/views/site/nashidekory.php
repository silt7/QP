<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Декоры</li>
	</ol>
</div>

<div class="container">
	<h1><?= $page->title?></h1>
	<?= $page->content?>
	<hr>
	<div class="row" style="text-align: center;">
	    <h2>Заголовок</h2>
	    <div class="qp_item-list catalog">
		<?foreach($categColor as $item):?>
			<div class="qp_item-list-cell ">
				<a href="/nashi-dekory-id/<?= $item[1];?>" class="inner">
                    <br><?= $item[0];?>
					<img src="/images/dekory/<?= $item[1];?>.jpg">
					<a href="/nashi-dekory-id/<?= $item[1];?>" class="by-fronts">Смотреть</a> 
                </a>
            </div>
		<?endforeach?>
		</div>
		<img style="display:none" src="/images/job_page.jpg">
	</div><br>
	<?= $page->content2?>
</div>
<script type="text/javascript">
	$(function () {
		$("#nav-decory").addClass('active');
	})
</script>