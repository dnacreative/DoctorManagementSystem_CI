<?php
	$base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';

	if($count > 0) {
		for($i=0;$i<$end;$i++) {
?>
	<div class="doc-box">
		<div class="top-part media">
			<div class="img_wrapper pull-left">
				<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $similar[$i]['name'])); ?>" class="clip">
					<img src="<?php echo $base_url.$similar[$i]['img']; ?>" class="media-object" alt="<?php echo $similar[$i]['name']; ?>">
				</a>
			</div>
			
			<div class="media-body">
				<h5 class="media-heading">
					<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $similar[$i]['name'])); ?>"><?php echo $similar[$i]['name']; ?></a>
				</h5>
				
				<span><?php echo $similar[$i]['city'].', '.$similar[$i]['state']; ?></span>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
<?php
		}

		if($page != ($pages-1)) {
?>
	<button type="button" class="btn btn-success" id="more_similar"><?php echo TranslateText('See more', 'en', $lang); ?></div>
	<div class="hidden" id="page"><?php echo $page; ?></div>

	<script>
		var doctor_id = $('#doctor_id').text().trim();
		var base_url = '<?php echo $base_url; ?>';
		var new_page = parseInt(<?php echo $new_page; ?>); 

		$('#more_similar').click(function() {
			$('#similar_load').load(base_url +'doctors/GetSimilarDoctors', 'doctor_id='+ doctor_id +'&page='+ new_page, function() {
		        $('.ajax-loader').fadeOut();
		    });
		});
	</script>
<?php
		}
	} else {
?>
	<div class="none">
		<?php echo TranslateText('No results', 'en', $this->session->userdata('lang')); ?>
	</div>
<?php
	}
?>