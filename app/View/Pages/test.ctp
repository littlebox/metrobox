<div>
	<h1><?= __('So far, so good :) ');?></h1>
	<?php if(AuthComponent::user('email')) :?>
		<p><?= AuthComponent::user('email') ?></p>
	<?php endif;?>
</div>