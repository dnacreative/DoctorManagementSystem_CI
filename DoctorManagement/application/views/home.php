 <?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';
    $dest_url = $img_url.'destinations/';

    // Get the controller name
    $controller = $this->router->fetch_class();

    // Get the method
    $method = $this->router->fetch_method();
?>
		<div class="video-banner">
			<div class="search-box">
				<div class="container">
					<h1 style="position: initial;">
						VoyagerMed: <?php echo TranslateText("Find & travel to the best U.S. doctors.", 'en', $lang); ?>
					</h1>

					<div id="opacity">
                        <p class="sr-only">
                        	VoyagerMed <?php echo TranslateText("finds you the most cutting edge medical treatments anywhere in the world. Search, learn, go", 'en', $lang); ?>
                        </p>

                        <form method="GET" action="<?php echo $base_url; ?>search" class="search-form" id="main-search-form">
                            <div class="container-fluid">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="search_input" name="procedure" placeholder="<?php echo TranslateText("What kind of procedure do you need?", 'en', $lang); ?>">
                                    <div id="autocomplete" class="autocomplete"></div>
                                </div>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="location" name="location" placeholder="<?php echo TranslateText("Where do you want to go?", 'en', $lang); ?>">
                                    <div id="autocomplete_locations" class="autocomplete"></div>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"><?php echo TranslateText("Search", 'en', $lang); ?></button>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </form>
                        
                        
                    </div>
                    
                    <div id="watchvideo-div">
                        <a href="https://www.youtube.com/watch?v=UrzyBcue5tY" target="_blank" style="color: white;">
                            <img src="/public/images/video.jpg">
                            <span>Watch Video</span>
                        </a>
                    </div>
				</div>
			</div>
		</div>

		<div class="container" id="intro">
			<h2 class="text-center">
				<?php echo TranslateText("How it works", 'en', $lang); ?>
			</h2>

			<div id="nest">
				<div class="col-lg-4">
					<i class="fa fa-stethoscope fa-4x"></i>

					<p>
						<?php echo TranslateText("Tell us what treatment you need and where in America you want to go.", 'en', $lang); ?>
						<br><br><a href="<?php echo $base_url; ?>search"><?php echo TranslateText("Find a Treatment", 'en', $lang); ?></a>
					</p>
				</div>

				<div class="col-lg-4">
					<i class="fa fa-user-md fa-4x"></i>

					<p>
						<?php echo TranslateText("We search thousands of doctors and hospital websites for the best quality at a price you can afford.", 'en', $lang); ?>
						<br><a href="<?php echo $base_url; ?>doctors"><?php echo TranslateText("Find a Doctor", 'en', $lang); ?></a>
					</p>
				</div>

				<div class="col-lg-4">
					<i class="fa fa-plane fa-4x"></i>

					<p>
						<?php echo TranslateText("Compare based on ratings, price and location. Then choose and go!", 'en', $lang); ?>
						<!--<br><br><a href="" id="compare_contact" onclick="return false;"><?php echo TranslateText("Contact", 'en', $lang); ?></a>-->
                        <br><br><a href="mailto:info@voyagermed.com" id="compare_contact1" ><?php echo TranslateText("Contact", 'en', $lang); ?></a>
					</p>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

		<div class="hospitals">
			<div class="container">
				<h3>
					<?php echo TranslateText("Destinations", 'en', $lang); ?>
				</h3>
				
				<p>
					<?php echo TranslateText("Discover hospitals, doctors and clinics in some of America's most popular destinations.", 'en', $lang); ?>
				</p>
				
				<div class="row hospital-row">
					<div class="hospital col-xs-6">
						<a href="<?php echo $base_url; ?>search/Breast-Augmentation/Miami-FL/">
							<img src="<?php echo $dest_url; ?>miami.jpg" class="img-responsive" alt="Miami">
							
							<h2>
								<?php echo TranslateText("Breast Augmentation", 'en', $lang); ?>
								in Miami, FL
								
								<ul class="list-inline">
									<li><i class="fa fa-usd"></i> <?php echo $prices['miami']['usd']; ?></li>
									<li><i class="fa fa-gbp"></i> <?php echo $prices['miami']['gbp']; ?></li>
									<li><i class="fa fa-eur"></i> <?php echo $prices['miami']['eur']; ?></li>
								</ul>
							</h2>
						</a>
					</div>

					<div class="hospital col-xs-6">
						<a href="<?php echo $base_url; ?>search/Face-Lift/Los-Angeles-CA/">
							<img src="<?php echo $dest_url; ?>los_angeles.jpg" class="img-responsive" alt="Los Angeles">
							
							<h2>
								<?php echo TranslateText("Face Lift", 'en', $lang); ?>
								in Los Angeles, CA

								<ul class="list-inline">
									<li><i class="fa fa-usd"></i> <?php echo $prices['los_angeles']['usd']; ?></li>
									<li><i class="fa fa-gbp"></i> <?php echo $prices['los_angeles']['gbp']; ?></li>
									<li><i class="fa fa-eur"></i> <?php echo $prices['los_angeles']['eur']; ?></li>
								</ul>
							</h2>
						</a>
					</div>

					<div class="hospital col-xs-6">
						<a href="<?php echo $base_url; ?>doctors/Struan-Coleman">
							<img src="<?php echo $dest_url; ?>new_york.jpg" class="img-responsive" alt="New York">
							
							<h2>
								<?php echo TranslateText("Knee Replacement", 'en', $lang); ?>
								in New York, NY <br>
								<?php echo TranslateText("Contact Us", 'en', $lang); ?>
								
								<?php /*
								<ul class="list-inline">
									<li><i class="fa fa-usd"></i> <?php echo $prices['new_york']['usd']; ?></li>
									<li><i class="fa fa-gbp"></i> <?php echo $prices['new_york']['gbp']; ?></li>
									<li><i class="fa fa-eur"></i> <?php echo $prices['new_york']['eur']; ?></li>
								</ul>
								*/ ?>
							</h2>
						</a>
					</div>

					<div class="hospital col-xs-6">
						<a href="<?php echo $base_url; ?>doctors/John-Peloza">
							<img src="<?php echo $dest_url; ?>scottsdale.jpg" class="img-responsive" alt="Scottsdale">
							
							<h2>
								<?php echo TranslateText("Spine Surgery", 'en', $lang); ?>
								in Dallas, TX <br>
								<?php echo TranslateText("Contact Us", 'en', $lang); ?>

								<?php /*
								<ul class="list-inline">
									<li><i class="fa fa-usd"></i> <?php echo $prices['beverly_hills']['usd']; ?></li>
									<li><i class="fa fa-gbp"></i> <?php echo $prices['beverly_hills']['gbp']; ?></li>
									<li><i class="fa fa-eur"></i> <?php echo $prices['beverly_hills']['eur']; ?></li>
								</ul>
								*/ ?>
							</h2>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- The doctors rows -->
		<div class="doctors">
			<div class="container">
				<h1>
					<?php echo TranslateText("Doctors", 'en', $lang); ?>
				</h1>
				
				<p>
					<?php echo TranslateText("Find great doctors for your treatment in the United States.", 'en', $lang); ?>
				</p>
				
				<div class="doctor-row">
<?php
	for($i=0;$i<4;$i++) {
?>
					<div class="doctor-box col-xs-6 col-md-4 col-lg-3">
						<div class="doc-img">
							<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $doctors[$i]['name'])); ?>"><img src="<?php echo $base_url; ?>public/images/doctors/original/<?php echo $doctors[$i]['pic']; ?>" alt="<?php echo $doctors[$i]['name']; ?>" class="img-responsive"></a>
							<h2><a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $doctors[$i]['name'])); ?>">Dr. <?php echo $doctors[$i]['name']; ?></a></h2>
						</div>

						<div class="doc-content">
							<p><?php echo TranslateText($doctors[$i]['title'], 'en', $lang); ?> in <?php echo $doctors[$i]['city']; ?></p>
<?php
		for($x=0;$x<count($doctors[$i]['specialties']);$x++) {
            $specialty = str_replace(" ", "-", $doctors[$i]['specialties'][$x]);
?>
							<a href="<?php echo $base_url.'search/' . $specialty . '/all/'; ?>" class="tags"><?php echo TranslateText($doctors[$i]['specialties'][$x], 'en', $lang); ?></a>
<?php
		}
?>
						</div>
					</div>
<?php
	}
?>
				</div>

				<div class="doctor-row">
<?php
	for($i=4;$i<8;$i++) {
?>
					<div class="doctor-box col-xs-6 col-md-4 col-lg-3">
						<div class="doc-img">
							<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $doctors[$i]['name'])); ?>"><img src="<?php echo $base_url; ?>public/images/doctors/original/<?php echo $doctors[$i]['pic']; ?>" alt="<?php echo $doctors[$i]['name']; ?>" class="img-responsive"></a>
							
							<h2>
								<a href="<?php echo $base_url.'doctors/'.strtolower(str_replace(' ', '-', $doctors[$i]['name'])); ?>">Dr. <?php echo $doctors[$i]['name']; ?></a>
							</h2>
						</div>

						<div class="doc-content">
							<p><?php echo TranslateText("Plastic Surgeon", 'en', $lang); ?> in <?php echo $doctors[$i]['city']; ?></p>
<?php
		for($x=0;$x<count($doctors[$i]['specialties']);$x++) {
?>
							<a href="<?php echo $base_url.'search/'.$doctors[$i]['specialties'][$x].'/all/'; ?>" class="tags"><?php echo TranslateText($doctors[$i]['specialties'][$x], 'en', $lang); ?></a>
<?php
		}
?>
						</div>
					</div>
<?php
	}
?>
				</div>
			</div>
		</div>

		<!-- Modal for video -->
		<!--
		<div class="modal fade" id="video_modal">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title">VoyagerMed</h4>
	                </div>

	                <div class="modal-body text-center">
						<div id="player_container">
							<div id="player"></div>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	    -->

	    <div class="hidden" id="location_text"></div>
	    <div class="hidden" id="procedure_text"></div>

        <!-- The modal for book appointment -->
        <div class="modal fade" id="modal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo TranslateText('Close', 'en', $lang); ?></span></button>
                            <?php echo TranslateText('Contact', 'en', $lang); ?>
                        </h3>
                    </div>

                    <form method="POST" id="contact_form" action="">
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="First Name" name="conntact_first_name"><br>
                            <input type="text" class="form-control" placeholder="Last Name" name="conntact_last_name"><br>                            
                            <input type="text" class="form-control" placeholder="Email" name="conntact_email"><br>
                            <textarea placeholder="Comments" name="conntact_comment" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><?php echo TranslateText('Submit', 'en', $lang); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<!--
	    <script>
		    	var tag = document.createElement('script');
		        tag.src = "https://www.youtube.com/iframe_api";
		        var firstScriptTag = document.getElementsByTagName('script')[0];
		        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		        var player;
		        function onYouTubeIframeAPIReady() {
		            player = new YT.Player('player', {
		                height: '250',
		                width: '410',
		                videoId: '5lHvhyHgSr4',
		                events: {
		                    // 'onReady': onPlayerReady,
		                    'onStateChange': onPlayerStateChange
		                }
		            });
		        }

		        // 4. The API will call this function when the video player is ready.
		        function onPlayerReady(event) {
		            event.target.playVideo();
		        }

		        var done = false;
		        function onPlayerStateChange(event) {
		            if(event.data == YT.PlayerState.PLAYING && !done) {
		                setTimeout(stopVideo, 6000);
		                done = true;
		            }
		        }

		        function stopVideo() {
		            player.stopVideo();
		        }

		        document.getElementsByClassName('close')[0].onclick = function() {
		        	stopVideo();
		        };
	    </script>
	    -->
