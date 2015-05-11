<!-- FORMULARIO DE REGISTRO -->
<div id="bebusca-signup-form" class="bebusca-authentication-form hidden">
	<div class="dialog-container" id="signup-dialog-container" data-remove="remove-dialog-container" data-click="hide-dialog-container">
		<div class="dialog text-center" data-id="signup-dialog" data-remove="remove-dialog"><img src="/bebusca/img/logo/bebusca-big.png" height="50px" class="logo" alt="bebusca logo">
			<h3 class="h5 h5--lg" style="margin-bottom: 20px;">Registrate en bebusca</h3>
			<button class="btn btn-facebook btn-facebook--login wide" data-click="sign-up-facebook">Registrarme con Facebook</button>
			<div class="input-or-separator" style="margin-top: 15px;">
				<div class="row">
					<div class="col-xs-5" style="padding-right: 0;">
						<hr>
					</div>
					<div class="col-xs-2">
						<div class="input-or">o</div>
					</div>
					<div class="col-xs-5" style="padding-left: 0;">
						<hr>
					</div>
				</div>
			</div>
			<form data-submit="sign-up" method="post" class="form-horizontal">
				<input class="" placeholder="Nombre Completo" required="" pattern=".{1,}" name="name" value="">
				<input class="" placeholder="Email" required="" type="email" name="email" value="">
				<input class="" placeholder="Contraseña" required="" minlength="5" type="password" name="password" value="" oninvalid="this.setCustomValidity('Tu contraseña debe contener al menos 5 caracteres.')" oninput="this.setCustomValidity('')">
				<input type="submit" value="Enviar" class="btn btn-rb btn-primary">
			</form><a href="/signin" class="btn-rb-link--bright" data-click="switch-to-sign-in">¿Ya tenés una cuenta? ¡Ingresá!</a>
			<div class="text-center form-bottom-action" style="color: #404040;">
				<div class="fa fa-key"></div>¿Sos una Inmobiliaria?&nbsp;<a href="/inmobiliarias.html" target="_self" class="btn-rb-link--bright">¡Registrate Acá!</a>
			</div>
			<div class="text-center form-bottom-action last" style="color: #404040;">
				<div class="fa fa-building"></div>¿Sos una Constructora?&nbsp;<a href="/constructoras.html" target="_self" class="btn-rb-link--bright">¡Registrate Acá!</a>
			</div>
			<p class="form-hint text-hint--subtle">Al registrarte, estas aceptando los&nbsp;<a href="/terms" target="_blank" class="btn-rb-link--text">Términos y Condiciones</a> de bebusca.</p>
		</div>
	</div>
</div>
<!-- FIN FORMULARIO DE REGISTRO -->