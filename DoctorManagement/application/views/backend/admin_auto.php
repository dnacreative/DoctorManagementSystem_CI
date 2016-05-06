<?php
	$base_url = $this->config->base_url();

    if(count($info) > 0) {
?>
	<ul class="list-group">
<?php
		for($i=0;$i<count($info);$i++) {
?>
		<li class="list-group-item" name="<?php echo $info[$i]['name']; ?>">
			<?php echo $info[$i]['name']; ?>
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