<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
		<div class="container" id="login_box">
			<h2>
				Admin Login
			</h2>

			<form method="POST" action="<?php echo $base_url; ?>users/login" id="admin_form">
				<input type="text" class="form-control" name="email" placeholder="Email"><br>
				<input type="password" class="form-control" name="password" placeholder="Password"><br>
				<button type="submit" class="btn btn-success pull-right" name="submit">Login</button>
				<div class="clearfix"></div>
			</form>
		</div>