<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';

    if($count > 0) {
    	for($i=0;$i<$count;$i++) {
?>
		<div class="col-lg-12 comment_section">
			<p>
				<?php echo $data[$i]['comment']; ?>
			</p>
		</div>	

		<div class="clearfix"></div>
<?php
    	}
?>

<?php
	} else {
?>
		<div>
			Nobody has left a comment.
		</div>
<?php
	}
?>