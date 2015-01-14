<?php if(!empty($message)):?>
<div class="alert alert-warning">
	<button class="close" data-close="alert"></button>
	<i class="fa-lg fa fa-warning"></i>
	<span><?= h($message) ?></span>
</div>
<?php endif; ?>