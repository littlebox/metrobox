<!-- HEADER -->
<div class="navbar-absolute-top">
	<header id="header" data-id="header" class="header">
		<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
			<div class="optional-container compact-lg">
				<div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target=".nv" class="navbar-toggle"><span class="sr-only">Menú</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button><a href="<?= $this->Html->Url(array('controller' => 'pages', 'action' => 'landing'));?>" target="_self" style="font-family:Avenir; color: #000; font-weight:500" class="navbar-brand"><img src="/bebusca/img/logo/bebusca-big.png" height="34px" style="display: inline-block;" class="logo"/></a>
				</div>
				<div class="collapse navbar-collapse nv">
					<ul class="nav navbar-nav navbar-right navbar-directive">
						<li>
							<div class="header-directive nav-item">
								<div class="header"><a id="save-shortlist-warning" data-id="signup-link" data-click="show-sign-up" class="save-shortlist-warning hide"><i class="fa fa-heart"></i>&nbsp;<span id="shortlist-count-not-log-in"></span>&nbsp;¡Registrate o ingresá para guardar favoritos!<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						</li>
						<li>
							<div class="header-directive nav-item">
								<div class="header">
									<div class="btn-group"><a target="_self" data-id="signup-link" data-click="show-sign-up" class="link-header">Registrate</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="header-directive nav-item">
								<div class="header">
									<div><a data-id="signin-link" data-click="show-sign-in" target="_self" class="link-header">Ingresá</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="nav-item"><a href="list-a-property.html" target="_self" class="btn-rb-list" style="background: #3893D9; color: #FFFFFF;"><span>PUBLICÁ UNA PROPIEDAD</span></a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</div>
<!-- FIN HEADER -->