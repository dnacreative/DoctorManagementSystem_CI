<?php
	$base_url = $this->config->base_url();

    if($count > 0) {
    	if($count >= 5) {
    		$end = 5;
    	} else {
    		$end = $count;
    	}
?>
	<ul class="list-group">
<?php
		for($i=0;$i<$end;$i++) {
			$name = $results[$i]['name'];
			$id = $results[$i]['id'];
			$format = SearchMatchText($name, $q, $length);
?>
		<li class="list-group-item" name="<?php echo str_replace(' ', '-', $name); ?>">
			<?php echo $format; ?>
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