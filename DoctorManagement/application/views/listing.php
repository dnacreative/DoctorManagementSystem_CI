<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';

    // Define all of the doctor's info as variables
    $img = $doctor_info['img'];
    $name = $doctor_info['name'];
    $website = $doctor_info['website'];
    $title = $doctor_info['title'];
    $address = $doctor_info['address'];
    $city = $doctor_info['city'];
    $state = $doctor_info['state'];
    $phone = $doctor_info['phone'];
    $bio = $doctor_info['bio'];
    $lon = $doctor_info['lon'];
    $lat = $doctor_info['lat'];

    // Get the doctor's first and last name
    $exp = explode(' ', $name);
    $first = strtolower($exp[0]);
    $last = strtolower($exp[count($exp)-1]);
    
    // Define the path to the image
    $img = $public_url.'images/misc/doctor_pics/'.$first.'_'.$last.'.jpg';
    $img_path = 'images/voyagerpics/'.$first.'_'.$last.'.jpg';
    $exists = file_exists($img_path);


    // See if the file exists and that it's not empty
    if($exists) {
        $size = filesize($img_path);

        // Get the new dimensions of the pics
        if($size > 0) {
            $dimensions = ResizePic($first, $last, 300);
            $new_height = $dimensions['height'];
            $new_width = $dimensions['width'];
            $style = $dimensions['style'];
        } else {
            $img = $public_url.'images/misc/unknown.png';
            $new_height = 300;
            $new_width = 300;
            $style = '';
        }
    }
?>
	<div class="container">
		<h2>
			<?php echo ucwords(strtolower($name)); ?>
		</h2>
		
		<div class="col-md-8 padding">
			<div class="tabs-box">
				<ul class="tabset">
					<li><a href="#tab1" class="active">Photos</a></li>
					<li><a href="#tab2">Maps</a></li>
					<li><a href="#tab3">Treatments</a></li>
				</ul>
		
				<div class="tab-content">
					<div id="tab1" class="photos">
						<img src="images/img-detail.jpg" alt="">
					</div>
			
					<div id="tab2" class="tab-contents">Maps will load here</div>
					<div id="tab3" class="tab-contents">Treatments Content will loat here</div>
				</div>
			</div>
		
			<div class="tabs-box">
				<ul class="tabset">
					<li><a href="#tab4" class="active">Description</a></li>
					<li><a href="#tab5">Amenities</a></li>
				</ul>
		
				<div class="tab-content">
					<div id="tab4" class="description">
						<div class="chart">
							<ul>
								<li class="light">Type <strong>House</strong></li>
								<li class="dark">Website <strong><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></strong></li>
								<li class="light">Phone <strong><?php echo $phone; ?></strong></li>
								<li class="dark">State <strong><a href="#"><?php echo $state; ?></a></strong></li>
								<li class="light">City <strong><a href="#"><?php echo $city; ?></a></strong></li>
								<li class="dark">
									Rating
									<div class="star-ratingbox">
										<ul class="star-rating">
											<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>
											<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>
											<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>
											<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>
											<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
				
						<h2>About</h2>

						<p>
							<?php echo $bio; ?>
						</p>
					</div>
			
					<div id="tab5" class="tab-contents">Maps will load here</div>
				</div>
			</div>
		</div>
	
		<div class="col-md-4">
			<div class="detail-sidebox">
				<select>
					<option>Treatments</option>
				</select>
				<a href="#" class="link">Book Consolation</a>
				<a href="#" class="link">Book Treatment</a>
			</div>
		
			<div class="detail-sidebox">
				<h3>Overview</h3>

				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="images/img-thumbnail.jpg">
								<img src="images/img-slider.jpg" />
							</li>
							<li data-thumb="images/img-thumbnail.jpg">
								<img src="images/img-slider.jpg" />
							</li>
							<li data-thumb="images/img-thumbnail.jpg">
								<img src="images/img-slider.jpg" />
							</li>
							<li data-thumb="images/img-thumbnail.jpg">
								<img src="images/img-slider.jpg" />
							</li>
						</ul>
					</div>
				</section>
		
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut ante eget velit sollicitudin pharetra. Sed lobortis nec lectus id vehicula. Donec sit amet pulvinar metus, a dapibus enim.
				</p>
			</div>
		
			<div class="detail-sidebox">
				<h3>Location Listings</h3>
				<img src="images/img-map2.jpg" alt="" class="img-map">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut ante eget velit sollicitudin pharetra. Sed lobortis nec lectus id vehicula. Donec sit amet pulvinar metus, a dapibus enim.
				</p>
			</div>
		</div>
	</div>
