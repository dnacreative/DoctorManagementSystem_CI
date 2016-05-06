<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>

<?php
    if($count > 0) {
    	// Caldulate the pagination numbers
    	$per_row = 4;
    	$cols = ceil($count/$per_row);

    	for($i=0;$i<$cols;$i++) {
?>
		<div class="row">
<?php
			$start = $i*$per_row;

			if($i == ($cols-1)) {
				$end = $count;
			} else {
				$end = $start+$per_row;
			}

			for($x=$start;$x<$end;$x++) {
?>
			<div class="col-lg-3">
				<h2>
					<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $data[$x]['name'])); ?>"><?php echo $data[$x]['name']; ?></a>
				</h2>

				<p>
					<?php echo $data[$x]['address'].'<br>'.$data[$x]['city'].', '.$data[$x]['state'].' '.$data[$x]['zip']; ?>
				</p>
			</div>	
<?php
			}
?>
			<div class="clearfix"></div>
		</div>
<?php
    	}
?>

<?php
	} else {
?>
		<div>
			Sorry. No results.
		</div>
<?php
	}
?>