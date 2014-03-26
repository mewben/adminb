@extends('layouts.client')

@section('title')
	Admin Login
@stop

@section('content')
<style>
	body {
		background-color: #345352;
	}
</style>

	<div class="container">
		<div class="login-form col-md-4 col-md-offset-4">

			<?php echo Form::open(['url' => '/admin/login', 'method' => 'post', 'role' => 'form', 'class' => 'login form-horizontal']); ?>
				<div class="row form-group">
					<div class="col-md-12">
						<h1><strong>Admin Login</strong></h1>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon">
							<i class="fa fa-user fa-fw fa-1x"></i>
						</span>
						<input type="text" name="username" id="id" class="form-control" placeholder="Admin Username" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon">
							<i class="fa fa-eye-slash fa-fw fa-1x"></i>
						</span>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in fa-fw fa-1x"></i>Admin Login</button>
				</div>
			<?php echo Form::close(); ?>

			<br>
			<br>
			<div class="text-center footer">
				<p>Business Admin Solutions</p>
				<p>Copyright &copy; 2014</p>
			</div>
		</div>
	</div>

	<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>

	<script>
		<?php if(Session::has('error')): ?>
			alert('<?php echo Session::get("error") ?>');
		<?php endif ?>
		$('form').find(':input:enabled:visible:first').focus().select();
	</script>
@stop