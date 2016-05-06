<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
		<div class="container" id="login_box">
			<h2>
				<?php echo TranslateText("Sign In", 'en', $lang); ?>
			</h2>

			<form method="POST" action="<?php echo $base_url; ?>users/login" id="signin_form">
				<input type="text" class="form-control" name="username" placeholder="<?php echo TranslateText("Username", 'en', $lang); ?>"><br>
				<input type="password" class="form-control" name="password" placeholder="<?php echo TranslateText("Password", 'en', $lang); ?>"><br>

				<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
				<div class="clearfix"></div>
			</form>
		</div>