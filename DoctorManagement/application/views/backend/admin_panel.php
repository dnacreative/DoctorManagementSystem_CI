<?php
	if(count($info) > 0) {
		for($i=0;$i<count($info);$i++) {
?>
		<p>
<?php
			if(is_array($info[$i])) {
?>
			<input type="text" class="form-control pull-left" name="<?php echo $type; ?>[]" category="<?php echo $type; ?>" value="<?php echo trim($info[$i]['name']); ?>" id="<?php echo trim($info[$i]['name']); ?>">
<?php
			} 
?>
			<span class="add pull-right"><i class="fa fa-remove fa-2x"></i></span>
			<span class="clearfix"></span>
		</p>	

		<div class="done"></div>
<?php
		}
?>
		<script>
			var base_url = $('#base_url').text();
			var id = '<?php echo $type; ?>';
			
			/*
			$('.form-control').click(function() {
				$('.form-control').keyup(function() {
					var _item = $(this);
	            	var val = $(this).val();
	            	var new_id = $(this).attr('category');
	            	var string = 'q='+ val +'&id='+ new_id;
	            	// console.log(string);
	            
	            	// var closest = $(this).parent().('.done');
	            	var closest = $('#'+ new_id +' .done');

	            	closest.load(base_url +'admin/Autocomplete', string, function() {
	            		$('#'+ new_id +' .done').slideDown();
	            		
	            		$('.list-group-item').click(function() {
	            			var item = $(this).text().trim();
	            			_item.val(item);
	            			$('#'+ new_id +' .done').slideUp();
	            		});
		            });
	            });
	        });
			*/
        </script>
<?php
	} else {
?>
		<input type="hidden" class="form-control pull-left" name="<?php echo $type; ?>[]" category="<?php echo $type; ?>" value="" id="">

		<div class="none">
			This doctor doesn't have any <?php echo $type; ?>
		</div>
<?php
	}
?>