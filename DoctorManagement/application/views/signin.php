<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
		<div class="container" id="login_box">
			<h2>
				<?php echo TranslateText('Sign In', 'en', $lang); ?>
			</h2>

			 <form method="POST" action="<?php echo $base_url; ?>users/signin" id="login_form">
                <input class="form-control" placeholder="<?php echo TranslateText('Email', 'en', $lang); ?>" type="text" id="signin_email"><br>
                <input class="form-control" placeholder="<?php echo TranslateText('Password', 'en', $lang); ?>" type="password" id="signin_pass"><br>

                <button class="btn btn-primary pull-right" type="submit">Sign In</button>

                <div class="clearfix"></div>
            </form>
		</div>