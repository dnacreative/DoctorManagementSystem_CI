<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';

    if($results['count'] > 0) {
    	$tooltip = TranslateText("This is an average cost for this procedure according to market research, industry publications and professional societies.
    				Your actual cost may vary widely and may not include anesthesia, operating room facilities or other related expenses. 
    				A surgeon's fee may vary based on his or her experience, as well as geographic office location.", 'en', $this->session->userdata('lang'));
?>
	<div id="procedure_list">
<?php
    	for($i=0;$i<$results['count'];$i++) {
    		$price = $results['results'][$i]['price'];
    		// echo $price;
?>
		<h2 class="clearfix">
			<span class="pull-left">
				<?php echo TranslateText($results['results'][$i]['name'], 'en', $this->session->userdata('lang')); ?> 
			</span>
			<span class="pull-right text-right">
<?php
			if($doctor_id == 125 || $doctor_id == 287 || $doctor_id > 490 && $doctor_id < 495) {
				echo TranslateText('Contact Us', 'en', $this->session->userdata('lang'));
			} else {
				if($price == '') {
                    if( $results['results'][$i]['avg'] == 0) echo "Contact Us";
					else echo number_format($results['results'][$i]['avg']).' '.strtoupper($unit).' <a href="javascript:;" title="'.$tooltip.'" data-toggle="tooltip" class="red-tooltip"><span class="fa fa-info-circle"></span><span class="sr-only">Avg</span></a>';
				} else {
					echo number_format($price).' '.strtoupper($unit);
				}
			}
?>
			<span class="clearfix"></span>
		</h2>
<?php
		}
?>
	</div>
<?php
	} else {
?>
	<div class="none">
        <?php echo TranslateText('No specialties found for this doctor. If you are this doctor, please claim your profile here', 'en', $this->session->userdata('lang')); ?>: info@voyagermed.com
	</div>
<?php
	}
?>