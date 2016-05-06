<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
		<div class="container" id="login_box">
			<h2>
				<?php echo $title; ?>
			</h2>

			<form name="comment_form" method="POST">
				<textarea class="form-control" placeholder="<?php echo $placeholder; ?>" name="comment"></textarea><br>
				
				<div id="comment_error" class="pull-left">
					The comment cannot be left blank
				</div>

				<button class="btn btn-primary pull-right" type="submit">Post</button>

				<div class="clearfix"></div>
			</form>

			<div id="load_box">
                <div class="ajax-loader">
                    <i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
                </div>
            </div>

			<div class="hidden" id="keyword"><?php echo $keyword; ?></div>
			<div class="hidden" id="session"><?php echo $session; ?></div>
		</div>