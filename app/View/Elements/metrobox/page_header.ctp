<!-- BEGIN PAGE HEADER-->
<?php if(!empty($this->fetch('title')) && $this->fetch('pageTitle')): ?>
<h3 class="page-title">
	<?= $this->fetch('title'); ?>
</h3>
<?php endif; ?>

<?php if($this->fetch('breadcrumb')): ?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="index.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Page Layouts</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Blank Page</a>
		</li>
	</ul>
</div>
<?php endif; ?>
<!-- END PAGE HEADER-->