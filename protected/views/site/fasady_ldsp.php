<? $page = $this->processOutput( $page ); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Фасады ЛДСП</li>
	</ol>
</div>
<div class="container">
	<h1 class="head"> <?= $page->title ?> </h1>

	<p> <?= $page->content ?> </p>
</div>

<script type="text/javascript">
	$(function () {
		$("#nav-contacts").addClass('active');
	})
</script>