<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';

    // Define all of the doctor's info as variables
    // $img = $clinic_info['img'];
    $name = $clinic_info['name'];
    $address = $clinic_info['address'];
    $city = $clinic_info['city'];
    $state = $clinic_info['state'];
    $zip = $clinic_info['zip'];
    $natl_rank = $clinic_info['natl_rank'];
    $intl_rank = $clinic_info['intl_rank'];
    $full_rank = $clinic_info['full_rank'];
    $score = $clinic_info['score'];
    $stars = $clinic_info['stars'];
?>
<div class="doctors">
	<div class="doc-banner">
		<img src="<?php echo $img_url; ?>doctor-bg.jpg" alt="test">
	</div>

	<div class="margin-minus"><div class="container">
		<div class="col-md-8 bg padding">
			<div class="doc-content">
				<div class="doc-title">
					<h3>
						<span><?php echo $name; ?></span>
						
						<div class="star-ratingbox">
							<ul class="star-rating star-rating2">
								<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
								<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
								<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
								<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
								<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
							</ul>
						</div>
					</h3>
				</div>
				
				
				<div class="row2 content-row">
					<div class="col-md-5 padding doc-img">
						<!--<img src="<?php echo $img; ?>" width="30" alt="<?php echo $name; ?>">-->
					</div>
					
					<div class="col-md-7">
						<!--<p><?php echo $bio; ?></p>-->
						<a href="#" class="detail-link">View Details</a>
					</div>
				</div>

				<div class="row2 doc-info">
					<div class="col-md-2 padding rating-box">
						<h4>Destination</h4>

						<div class="star-ratingbox star-ratingbox2">
							<ul class="star-rating star-rating2">
								<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
								<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
								<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
								<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
								<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 padding rating-box">
						<h4>Procedures</h4>

						<div class="star-ratingbox star-ratingbox2">
							<ul class="star-rating star-rating2">
								<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
								<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
								<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
								<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
								<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 padding rating-box">
						<h4>Staff</h4>

						<div class="star-ratingbox star-ratingbox2">
							<ul class="star-rating star-rating2">
								<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
								<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
								<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
								<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
								<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-2 padding rating-box">
						<h4>Clinic/Hospital</h4>

						<div class="star-ratingbox star-ratingbox2">
							<ul class="star-rating star-rating2">
								<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
								<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
								<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
								<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
								<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-4 padding">
						<h4>Professional Associations</h4>
						<ul class="acc-list">
							<li><img src="<?php echo $img_url; ?>img-acc-1.gif" alt=""></li>
							<li><img src="<?php echo $img_url; ?>img-acc-2.gif" alt=""></li>
							<li><img src="<?php echo $img_url; ?>img-acc-3.gif" alt=""></li>
							<li><img src="<?php echo $img_url; ?>img-acc-4.gif" alt=""></li>
							<li><img src="<?php echo $img_url; ?>img-acc-5.gif" alt=""></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 margin2">
			<div class="location box-style">
				<p><strong>Address:</strong> <?php echo $address; ?></p>
				<p><strong>City:</strong> <span><?php echo $city; ?></span></p>
				<p><strong>State:</strong> <span><?php echo $state; ?></span></p>
				<img src="<?php echo $img_url; ?>img-hospital2.jpg" alt="hospital">
			</div>
		</div>

		<div class="col-md-12 margin2">
			<div class="location box-style">
				<div id="google_maps"></div>
			</div>
		</div>
	</div>

	<div class="clinics-hospitals">
		<div class="container">
			<div class="col-md-8 bg">
				<h2><?php echo $name; ?></h2>
				<h3>Bio</h3>
			
				<!--<p><?php echo $bio; ?></p>-->

				<div class="education">
					<h3>Education and Experience</h3>
					<p>University of Miami (1999)</p>
				</div>
			
				<div class="specilaity">
					<h3>Specialties</h3>
<?php
/*
	for($i=0;$i<$specialties['count'];$i++) {
?>
					<h4><?php echo $specialties['results'][$i]['name']; ?></h4>
					<p>Starting at $<?php echo number_format($specialties['results'][$i]['price']); ?></p>
<?php
	}
*/
?>
				</div>
			
				<div class="languages">
					<h3>Languages Spoken</h3>
					<p>English</p>
				</div>
				
				<div class="review">
					<h3>Reviews</h3>
					<p>Maecenas a est ac eros viverra fermentum vitae ac magna. </p>
					<p><strong>June 18, 2014 (by Patient Adem)</strong> Verified Patient</p>
					
					<div class="row2 margin2">
						<div class="col-md-3 padding">
							<h4>Overall Rating</h4>
							
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
			
						<div class="col-md-3 padding">
							<h4>Bedside Manners</h4>
							
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
			
						<div class="col-md-3 padding">
							<h4>Wait Time</h4>
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
					</div>
			
					<p>Aenean enim augue, mattis at mattis a, hendrerit vitae nunc. Phasellus semper efficitur lacus, ac laoreet dolor luctus a. Nullam eu libero mattis dui imperdiet efficitur. In iaculis ante a arcu ullamcorper ultricies. Integer auctor nisl id enim rutrum luctus. Sed blandit massa non nunc hendrerit sagittis.</p>
					
				</div>
			
				<div class="review">
					<p><strong>June 18, 2014 (by Patient Adem)</strong> Verified Patient</p>
					<div class="row2 margin2">
						<div class="col-md-3 padding">
							<h4>Overall Rating</h4>
				
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
				
						<div class="col-md-3 padding">
							<h4>Bedside Manners</h4>
							
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
				
						<div class="col-md-3 padding">
							<h4>Wait Time</h4>
							<div class="star-ratingbox star-ratingbox2">
								<ul class="star-rating star-rating2">
									<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
									<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
									<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
									<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
									<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
								</ul>
							</div>
						</div>
					</div>
			
					<p>Aenean enim augue, mattis at mattis a, hendrerit vitae nunc. Phasellus semper efficitur lacus, ac laoreet dolor luctus a. Nullam eu libero mattis dui imperdiet efficitur. In iaculis ante a arcu ullamcorper ultricies. Integer auctor nisl id enim rutrum luctus. Sed blandit massa non nunc hendrerit sagittis.</p>
					<div class="divider2 margin-divider"></div>
				</div>
			</div>
		
			<div class="col-md-4">
				<div class="sidebar bg">
					<h4>Similar Doctors</h4>
<?php
	/*
	for($i=0;$i<count($similar);$i++) {
		// Get the doctor's first and last name
    	$exp = explode(' ', $similar[$i]['name']);
    	$first = strtolower($exp[0]);
    	$last = strtolower($exp[count($exp)-1]);

		// Define the path to the image
	    $img = $img_url.'doctors/'.strtolower($first).'_'.strtolower($last).'.jpg';
	    $img_path = 'public/images/doctors/'.strtolower($first).'_'.strtolower($last).'.jpg';
	    $exists = file_exists($img_path);

	   	// echo $img_path.'<br>';
	    // See if the file exists and that it's not empty
	    if($exists) {
	        $size = filesize($img_path);

	        // Get the new dimensions of the pics
	        if($size > 0) {
	            $dimensions = ResizePic($first, $last, 50);
	            // FormatArray($dimensions);
	            $new_height = $dimensions['height'];
	            $new_width = $dimensions['width'];
	            $style = $dimensions['style'];
	        } else {
	            $img = $img_url.'misc/unknown.png';
	            $new_height = 50;
	            $new_width = 50;
	            $style = '';
	        }
	    } else {
	    	$img = $img_url.'misc/unknown.png';
	        $new_height = 50;
	        $new_width = 50;
	        $style = '';
	    }
?>
					<div class="doc-box">
						<div class="top-part">
							<div class="col-md-4 padding doctor-img" style="<?php echo $style; ?>">
								<img src="<?php echo $img; ?>" alt="<?php echo ucwords(strtolower($similar[$i]['name'])); ?>" width="50">
							</div>
							
							<div class="col-md-7 padding doctor-content">
								<h5><a href="<?php echo $base_url.'doctors/'.$similar[$i]['id']; ?>"><?php echo ucwords(strtolower($similar[$i]['name'])); ?></a></h5>
								<p>Plastic Surgeon</p>

								<div class="star-ratingbox">
									<ul class="star-rating star-rating2">
										<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
										<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
										<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
										<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
										<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="doc-location">
							<p>
								<strong>Address:</strong> <?php echo $similar[$i]['address']; ?><br>
								<strong>City:</strong> <?php echo $similar[$i]['city']; ?><br>
								<strong>State:</strong> <?php echo $similar[$i]['state']; ?><br>
								<span class="loc"><strong>Phone:</strong> <?php echo $similar[$i]['phone']; ?></span>
								<span class="loc"><strong>Website:</strong> <a href="<?php echo $similar[$i]['website']; ?><" target="_blank"><?php echo $similar[$i]['website']; ?></a> </span>
							</p>
						</div>
					</div>
<?php
	}
	*/
?>
				</div>
			</div>
		</div>
	</div>
</div>

