<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>

	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?= base_url('assets/uploads/images/admin.png'); ?>" class="user-image">
					<span class="hidden-xs"><?php echo $this->session->userdata('user')['username'];?></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="<?= base_url('assets/uploads/images/admin.png'); ?>" class="img-circle">
						<p>
							<?php echo $this->session->userdata('user')['username'];?>
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
							<a href="#" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Profil</a>
						</div>
						<div class="pull-right">
							<a href="<?= site_url('login/logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
						</div>
					</li>
				</ul>
			</li>
			<!-- Control Sidebar Toggle Button -->
		</ul>
	</div>
</nav>