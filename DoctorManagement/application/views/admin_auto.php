<?php
	$base_url = $this->config->base_url();

    if($count > 0) {
?>
	<ul class="list-group">
<?php
		for($i=0;$i<$end;$i++) {
?>
		<li class="list-group-item" name="<?php echo $city; ?>">
			<?php echo $format.', '.$state; ?>
		</li>
<?php
		}
?>
	</ul>
<?php
	} else {
?>
	<div class="none">
		There are no results
	</div>
<?php
	}
?>