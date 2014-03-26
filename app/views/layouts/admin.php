<!DOCTYPE html>
<html lang="en" data-ng-app="ssg" data-ng-controller="AdminCtrl">
	<head>
		<meta charset="utf-8">
		<title>SSGElections &middot; Bohol Island State University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php echo HTML::style('assets/css/admin.css') ?>
		<?php echo HTML::style('assets/css/font-awesome.css') ?>
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body data-ng-cloak>
		<div id="wrap">
			<div id="menu">
				<div class="menu-open text-center">
					<ul class="nav">
						<li><a href="/admin" target="_self" class="logo"><i class="fa fa-laptop fa-3x"></i> <h5>Business Admin</h5></a></li>
					</ul>
					<ul class="nav side">
						<?php foreach($session['menu'] as $key => $menu): ?>
							<li data-ng-class="{active: isActive('<?php echo $menu['baseurl'] ?>')}">
								<a href="<?php echo $menu['url'] ?>">
									<i class="fa fa-2x <?php echo $menu['icon'] ?>"></i>
									<div><?php echo $key ?></div>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div> <!-- /#menu -->
			<div id="main">
				<!-- Navbar -->
				<div class="navbar navbar-inverse navbar-static-top" role="navigation">
					<p class="navbar-text"><?php echo $session['business']['name'] ?></p>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> <?php echo $session['username'] ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">username</li>
								<li><a data-toggle="modal" data-target="#pwd"><i class="fa fa-lock fa-fw"></i> Change password</a></li>
								<li class="divider"></li>
								<li><a href="/admin/logout" target="_self"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
							</ul>
						</li>
					</ul>
				</div> <!-- /.navbar -->
				<div data-ng-view></div>
			</div> <!-- /#main -->
		</div>

		<div id="pwd" class="modal" tabindex="-1" role="dialog" aria-labelledby="Change Password" aria-hidden="true">
		  <div class="modal-dialog">
		    <form name="pwd" class="modal-content form-horizontal" data-ng-submit="changePassword()" role="form">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Change Password</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label for="password" class="col-sm-5 control-label">Current Password <span class="required">*</span></label>
		      		<div class="col-sm-7">
		      			<input type="password" id="password" placeholder="Current Password" data-ng-model="itemg.password" class="form-control" required>
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<label for="address" class="col-sm-5 control-label">New Password <span class="required">*</span></label>
		      		<div class="col-sm-7">
		      			<input type="password" id="address" placeholder="New Password" data-ng-model="itemg.password_new" class="form-control" required>
		      		</div>
		      	</div>
		      	<div class="form-group">
		      		<label for="color" class="col-sm-5 control-label">Repeat New Password <span class="required">*</span></label>
		      		<div class="col-sm-7">
		      			<input type="password" id="color" placeholder="Confirm password" maxlength="7" data-ng-model="itemg.password_confirmation" class="form-control" required>
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		      	<span class="loading-holder" data-loading><i class="loading icon"></i></span>
		      	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="icon angle left"></i>Cancel</button>
		      	<button type="submit" data-ng-disabled="!pwd.$valid" class="btn btn-sm btn-primary"><i class="checkmark icon"></i> Save</button>
		      </div>
		    </form><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<?php if (App::environment('production')) : ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-route.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-resource.min.js') ?>

			<?php echo HTML::script('assets/js/admin.min.js') ?>

		<?php else: ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-route.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-resource.js') ?>

			<?php echo HTML::script('assets/js/angular-select2.js') ?>
			<?php echo HTML::script('assets/js/select2.min.js') ?>

			<?php echo HTML::script('assets/js/toastr.min.js') ?>

			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/transition.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/collapse.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/modal.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tooltip.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tab.js') ?>
			<?php //echo HTML::script('assets/less/bootstrap-3.1.0/js/button.js') ?>

			<?php echo HTML::script('ang/init.js') ?>
			<?php echo HTML::script('ang/app.js') ?>
			<?php echo HTML::script('ang/services/api.js') ?>
			<?php echo HTML::script('ang/services/notify.js') ?>
			<?php echo HTML::script('ang/controllers.js') ?>
			<?php echo HTML::script('ang/directives.js') ?>


		<?php endif; ?>

		<?php if(Session::has('errors')) : ?>
			<script>
				toastr.error('<ul>' + "<?php echo Session::get('errors') ?>" + '</ul>', 'Something went wrong!');
			</script>
		<?php endif ?>

		<?php if(Session::has('info')) : ?>
			<script>
				toastr.success('<ul>' + "<?php echo Session::get('info') ?>" + '</ul>', 'Success!');
			</script>
		<?php endif ?>

		<script>
			window.menu = <?php echo json_encode($session['menu']) ?>;
			window.business = <?php echo json_encode($session['business']) ?>;
			angular.module('ssg').constant('CSRF_TOKEN', '<?php echo csrf_token() ?>');
		</script>
	</body>
</html>