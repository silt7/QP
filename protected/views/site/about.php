<? $page = $this->processOutput( $page ); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">О производстве</li>
	</ol>
</div>
<div class="container for-h1 about">
	<h1> <?= $page->title ?> </h1>

	<p> <?= $page->content ?> </p>
</div>

<script type="text/javascript">
	$(function () {
		$("#nav-info").addClass('active');
	})
</script>