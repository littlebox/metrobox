<div>
	<h1><?= __('Ohhhh yeah :) ');?></h1>
	<?php if(AuthComponent::user('email')) :?>
		<p>Hola <?= AuthComponent::user('email') ?></p>
	<?php endif;?>
</div>