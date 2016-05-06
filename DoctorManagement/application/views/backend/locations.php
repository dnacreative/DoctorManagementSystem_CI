<?php
	$base_url = $this->config->base_url();

    if($count > 0) {
?>
	<ul class="list-group">
<?php
		for($i=0;$i<$count;$i++) {
			$city = $results[$i]['city'];
			$state = $results[$i]['state'];
			$format = SearchMatchText($city, $q, $length);
?>
		<li class="list-group-item" name="<?php echo str_replace(' ', '-', $city.'-'.$state); ?>">
			<?php echo $city.', '.$state; ?>
		</li>
<?php
		}
?>
	</ul>

	<script>
		$(document).keyup(function(e) {
			switch(e.which) {
	            case 38: // up
	            
	               	
	                break;

	            case 40: // down

	                $('#autocomplete_locations .list-group li:first-of-type').toggleClass('hovered');
	                console.log('hey');
	                break;

	            default: 
	                return;
	        }
	    });
	</script>

<?php
	} else {
?>
	<div class="none">
		There are no results
	</div>
<?php
	}
?>