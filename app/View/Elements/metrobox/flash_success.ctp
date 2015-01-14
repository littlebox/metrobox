<?php if(!empty($message)):?>
<div class="alert alert-success">
	<button class="close" data-close="alert"></button>
	<i class="fa-lg fa fa-check"></i>
	<span><?= h($message) ?></span>
</div>
<?php endif; ?>