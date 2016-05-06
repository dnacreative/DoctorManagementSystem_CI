<?php
	$base_url = $this->config->base_url();

    if(count($info) > 0) {
?>
	<ul class="list-group">
<?php
		for($i=0;$i<count($info);$i++) {
			$img = 'public/images/doctors/'.strtolower($info[$i]['first_name']).'-'.strtolower($info[$i]['last_name']).'.jpg';
			// var_dump(file_exists($img));

			if(is_file($img)) {
				$file = $base_url.$img;
			} else {
				$file = $base_url.'public/images/default.svg';
			}
?>
		<li class="list-group-item" name="<?php echo $info[$i]['first_name']; ?>" onclick="location.href='<?php echo $base_url; ?>doctors/<?php echo strtolower($info[$i]['first_name']).'-'.strtolower($info[$i]['last_name']); ?>'">
			<img src="<?php echo $file; ?>" width="50" class="img-thumbnail svg" alt="<?php echo $info[$i]['first_name'].' '.$info[$i]['last_name']; ?>">
			<?php echo $info[$i]['first_name'].' '.$info[$i]['last_name']; ?>
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