<?php if(!empty($message)):?>
<div class="alert alert-danger">
	<button class="close" data-close="alert"></button>
	<span><?= h($message) ?></span>
</div>
<?php endif; ?>