<?php if(!empty($message)):?>
<div class="alert alert-danger">
	<button class="close" data-close="alert"></button>
	<i class="fa-lg fa fa-times"></i>
	<span><?= h($message) ?></span>
</div>
<?php endif; ?>