<div class="page-inner">
	<?= $this->Html->image('media/pages/earth.jpg', array('class' => 'img-responsive'));?>
</div>
<div class="container error-container">
	<h1>400</h1>
	<h2><?= __('Your client has issued a malformed or illegal request.') ?></h2>
	<p>
		<?= __('That\'s all we know.') ?>
	</p>
	<p>
		<?= $this->Html->link(__('Return home'), array('controller' => 'pages', 'action' => 'index')); ?>
		<br>
	</p>
</div>