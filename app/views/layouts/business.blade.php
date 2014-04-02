<!DOCTYPE html>
<html lang="en" data-ng-app="adminb" data-ng-controller="AdminCtrl">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AdminB</title>

		<?php echo HTML::style('assets/css/admin.css') ?>
		<?php echo HTML::style('assets/css/font-awesome.css') ?>

	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars"></i>
					</button>
					<a href="/admin" target="_self" class="navbar-brand"><i class="fa fa-laptop"></i> Business Admin</a>
				</div>

				<div class="collapse navbar-collapse" id="main-menu-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-user fa-fw"></i>
						John <i class="fa fa-fw fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Change Password</a></li>
								<li class="divider"></li>
								<li><a href="/logout">Log out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<section class="container" ng-switch on="display">
			<div class="row">
				<div class="col-sm-12 slide-container">
					<div class="slide" ng-switch-default>
						<div class="page-header">
							<h1>Businesses</h1>
							<p class="lead"> <i class="fa fa-briefcase"></i>  Select your business.</p>
						</div>
						<div class="row">
							@foreach ($business as $b)
								<div class="col-sm-3">
									<div class="box">
										<a href="#" ng-click="select({{$b['id']}})">
											<img src="/uploads/{{$b['id']}}.png" alt="" class="img-responsive">
										</a>
										<div class="details">
											<h4>{{$b['name']}}</h4>
											<span class="text-muted">
												<a ng-click="select({{$b['id']}});" class="btn-link" href="#">Select</a> /
												<a class="btn-link" href="#">Edit</a>
											</span>
										</div>
									</div>
								</div>
							@endforeach
							<div class="col-sm-3">
								<div class="box">
									<a data-ng-click="show('add')">
										<div id="plus">
											<i class="fa fa-plus"></i>
										</div>
										<div class="text-center">Add Business</div>
									</a>
								</div>
							</div>
						</div>
					</div> <!-- /.slide -->

					<div class="slide" ng-switch-when="add">
						<div class="page-header">
							<h2><button ng-click="show(null)" type="button" class="btn-link"><i class="fa fa-angle-left"></i></button> Add Business</h2>
						</div>
						<div class="well well-lg">
							<div class="row">
								<div class="col-sm-4 col-sm-offset-4">
									<form ng-submit="addItem()" class="form-horizontal" method="post">
										<div class="form-group">
											<img width="180" src="/uploads/1.png" alt="" class="img-thumbnail img-responsive">
											<input type="file">
										</div>
										<div class="form-group">
											<input type="text" class="form-control input-lg" placeholder="Business Name" ng-model="b.name">
										</div>
										<div class="form-group">
											<input type="text" class="form-control input-lg" placeholder="Website" ng-model="b.website">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check fa-fw"></i>SAVE</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div> <!-- /.slide -->
					
				</div> <!-- /.col-sm-12 -->
			</div> <!-- /.row -->
		</section>

		{{ HTML::script('assets/js/jquery-2.0.3.min.js') }}
		{{ HTML::script('assets/js/toastr.min.js') }}
		{{ HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') }}
		{{ HTML::script('assets/less/bootstrap-3.1.0/js/collapse.js') }}
		{{ HTML::script('bus/init.js') }}

		{{ HTML::script('assets/js/angular-1.2.12/angular.min.js') }}
		{{ HTML::script('assets/js/angular-1.2.12/angular-resource.min.js') }}

		<?php if (App::environment('production')) : ?>
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js') }}
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-resource.min.js') }}
		<?php endif; ?>

		{{ HTML::script('bus/app.js') }}
		{{ HTML::script('bus/services/api.js') }}
		{{ HTML::script('bus/services/flash.js') }}
		{{ HTML::script('bus/controllers.js') }}
	</body>
</html>