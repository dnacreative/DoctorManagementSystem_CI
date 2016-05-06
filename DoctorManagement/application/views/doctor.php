<?php    
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';
?>
        <div id="map_trigger" class="hidden"></div>
        
        <!-- About -->
        <div class="doctors" itemprop="about" itemref="PostalAddress" itemscope="" itemtype="http://schema.org/Physician">
        	<!-- Specialty -->
            <link itemprop="medicalSpecialty" itemscope="" itemtype="http://schema.org/PlasticSurgery">

			<!-- GeoCoordinates -->
            <span itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
               <meta content="<?php echo $doctor['lat']; ?>" itemprop="latitude">
               <meta content="<?php echo $doctor['lon']; ?>" itemprop="longitude">
            </span>

			<!-- Address -->
            <span id="PostalAddress" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
             	<meta content="<?php echo $doctor['address']; ?>" itemprop="streetAddress">
             	<meta content="<?php echo $doctor['city']; ?>" itemprop="addressLocality">
             	<meta content="<?php echo $doctor['state']; ?>" itemprop="addressRegion">
             	<meta content="<?php echo $doctor['zip']; ?>" itemprop="postalCode">
            	<meta content="US" itemprop="addressCountry">
          	</span>

          	<meta content="MD" itemprop="honorificsuffix">
          	<meta content="Physician" itemprop="jobTitle">

            
            
            <?php 
            if($doctor['is_street_image'] == '1'){
                
            ?>
                <div class="doc-banner" id="pano1">
                    <?php if($doctor['is_bme'] == '1'){ ?>
                    <div class="doctor-bme-image">
                        <img src="<?php echo $base_url . 'public/images/VoyagerMed Board of Medical Experts Award.png'; ?>">
                    </div>
                    <?php } ?>
                    <div class="container" style="max-width: 1347px; max-height: 400px;">
                        <img class="img-responsive" width="100%" src="<?php echo $base_url . 'public/images/doctors/location/' . $doctor['first'] . '_' . $doctor['last'] . '.jpg'?>">                    
                    </div>
                </div> 
            <?php
            }
            else
            {
            ?>
                <div class="doc-banner" id="pano">
                    <?php if($doctor['is_bme'] == '1'){ ?>
                    <div class="doctor-bme-image">
                        <img src="<?php echo $base_url . 'public/images/VoyagerMed Board of Medical Experts Award.png'; ?>">
                    </div>
                    <?php } ?>
                    
                    <div class="ajax-loader">
                        <i class="fa fa-cog fa-3x fa-spin"></i>
                    </div>
                </div>
            <?php
            } 
            ?>
            
            <?php 
                $profile_display = "";
                if($doctor["is_full_profile"] == 0){ 
                    $profile_display = 'style="display: none;"';
                }
            ?>  
            
            <div class="clearfix">
                <div class="container" itemprop="employee" itemscope="" itemtype="http://schema.org/Person">
                    <div id="top_wrapper">
                        <div class="col-md-8 bg padding" id="left_box_two">
                            <div class="doc-content">
                                <div id="doc-title" class="doc-title affix-top">
                                    <div class="container">
                                        <span id="doc-title-img">
                                            <span class="clip">
                                                <img src="<?php echo $base_url.$doctor['img']; ?>" class="svg img-responsive" alt="<?php echo $doctor['name']; ?>" itemprop="image">
                                            </span>
                                        </span>

                                        <h1 itemprop="name">
<?php 
if(($doctor['title'] != '') && ($doctor['title'] != NULL))
    $title = $doctor['title'].' - '.TranslateText(FormatProfession($doctor['field']), 'en', $lang).', '.$doctor['city'];
else
	$title = $doctor['name'].' - '.TranslateText(FormatProfession($doctor['field']), 'en', $lang).', '.$doctor['city'];

echo $title;
?>
                                        </h1>

                                        <button id="doc-title-btn" type="button" class="btn btn-primary"><?php echo TranslateText('Contact Us', 'en', $lang); ?></button>
                                    </div>
                                </div>
                                
                                <!-- Display the user's name and bio -->
                                <div id="doc-pic-bio" class="row2 content-row">
                                    <div class="col-xs-5 col-sm-3 img_wrapper main_img_wrapper">
                                        <img src="<?php echo $base_url.$doctor['img']; ?>" width="100" height="133" id="main_doc_pic" class="img-responsive" alt="<?php echo $doctor['name']; ?>">
                                    </div>

                                    <div id="doctor-bio-short" class="col-xs-7 col-sm-9">
                                        <div class="ellipsis"><p>
                                        <?php echo BioTrim(TranslateText($doctor['bio'], 'en', $lang), 1000, '<span class="ellip">...</span>'); ?></p></div>

                                        <a href="#" class="detail-link" <?php echo $profile_display;?>><?php echo TranslateText('View Details', 'en', $lang); ?></a>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div id="icon_box">
<?php
	/*
	for($i=0;$i<count($hospitals);$i++) {
		if(is_file('public/images/hospitals/'.$hospitals[$i]['img'])) {
?>
										<img src="<?php echo $img_url.'hospitals/'.$hospitals[$i]['img']; ?>" class="img-thumbnail" width="25" alt="hospital" data-toggle="tooltip" title="<?php echo $hospitals[$i]['name']; ?>">
<?php
		}
	}
	*/
?>
									</div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-md-4 margin2" id="right_box_two">
                            <p id="contact_bar">
                                <?php echo TranslateText('Contact Info', 'en', $lang); ?>
                            </p>

                            <div class="location box-style">
                                <p><strong><?php echo TranslateStatic('address', $lang); ?>:</strong> <span itemprop="streetAddress"><?php echo $doctor['address']; ?></span></p>
                                <p><strong><?php echo TranslateStatic('city', $lang); ?>:</strong> <span itemprop="addressLocality"><?php echo $doctor['city']; ?></span></p>
                                <p><strong><?php echo TranslateStatic('state', $lang); ?>:</strong> <span itemprop="addressRegion"><?php echo $doctor['state']; ?></span></p>
                                <p itemprop="telephone"><strong><?php echo TranslateStatic('phone', $lang); ?>:</strong> <a href="tel:<?php echo $doctor['phone']?>"><?php echo $doctor['phone']?></a></p>
                                <!--
                                <button type="button" class="btn btn-primary" id="contact_doc"><?php echo TranslateText('VoyagerMed Consultation', 'en', $lang); ?></button>
                                -->
                                <p itemprop="telephone"><strong>Email <br>VoyagerMed: </strong> <a href="mailto:info@voyagermed.com"><br>info@voyagermed.com</a></p>
                                 
                                <br>
                                <button type="button" class="btn btn-primary" id="book_appointment"><?php echo TranslateText('VoyagerMed Appointment', 'en', $lang); ?></button>
                                
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            
                
            	<!-- Hotels -->
                <div class="container">
                    <p id="nearby">
                    	<i class="fa fa-map-marker"></i> <?php echo TranslateStatic('hotels', $lang); ?>
						
						<span class="pull-right">
							US/CAN: 1-800-780-5733 - INTL: 00-800-11-20-11-40 - Promo Code 478586
						</span>

						<span class="clearfix"></span>
                    </p>
                    
                    <div class="col-md-12" id="maps_box">
                        <div class="location box-style">
                            <div id="google_maps"></div>
                        </div>
                    </div>
                </div>               
                
            </div>
                        
            <div class="container" id="linkedin" <?php echo $profile_display;?>>
                <div class="col-sm-7 col-md-8" id="ext_doc_info">
                    <div class="bg">

                    	<!-- Specialties -->
                    	<div class="specilaity">    
                            <div id="specialty-header" class="panel-heading">
                                <?php echo TranslateText('Specialties', 'en', $lang); ?>

                                <!-- Display all of the currencies -->
                                <select class="form-control" id="currency_select">
<?php
    for($i=0;$i<count($currencies);$i++) {
?>
                                    <option value="<?php echo $currencies[$i]; ?>"><?php echo $currencies[$i]; ?></option>
<?php
    }
?>
                                </select>
                            </div>

                            <div id="specialty_load">
                            	<div class="ajax-loader">
                            		<i class="fa fa-cog fa-3x fa-spin"></i>
                            	</div>
                            </div>
                        </div>

                        <div class="panel-group" id="doc-info-accordion" role="tablist" aria-multiselectable="true">
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="bio-heading">
						            <h3>
						                <?php echo TranslateStatic('bio', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-bio" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="bio-heading">
						            <div class="panel-body">
						                <p class="text-left">
						                    <?php echo TranslateText($doctor['bio'], 'en', $lang); ?>
						                </p>
						            </div>
						        </div>
						    </div>

							<!-- Education -->
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="education-heading">
						            <h3>
						                <?php echo TranslateStatic('edu', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-education" class="panel-collapse" role="tabpanel" aria-labelledby="education-heading">
						            <div class="panel-body">
<?php
	if(count($education) > 0) {
?>
						                <ul>
<?php
		for($i=0;$i<count($education);$i++) {
?>
						                    <li itemprop="alumniOf" itemscope="" itemtype="http://schema.org/EducationalOrganization">
						                    	<span itemprop="name"><?php echo $education[$i]['name']; ?></span>
						                    </li>
<?php
		}
?>
						               </ul>
<?php
	}
?>
						            </div>
						        </div>
						    </div>

							<!-- Professional Affiliations -->
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="pro-affiliations-heading">
						            <h3>
						                <?php echo TranslateStatic('professional', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-pro-affiliations" class="panel-collapse" role="tabpanel" aria-labelledby="pro-affiliations-heading">
						            <div class="panel-body">
<?php
	if(count($certs) > 0) {
?>
						                <ul>
<?php
		for($i=0;$i<count($certs);$i++) {
?>
						                    <li itemprop="affiliation" itemtype="http://schema.org/Organization">
						                    	<span itemprop="name"><?php echo $certs[$i]['name']; ?></span>
						                    </li>
<?php
		}
?>
						                </ul>
<?php
	}
?>
						            </div>
						        </div>
						    </div>
	
							<!-- Insurance -->
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="publications-heading">
						            <h3>
						                <?php echo TranslateStatic('insurance', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-publications" class="panel-collapse" role="tabpanel" aria-labelledby="publications-heading">
						            <div class="panel-body">
<?php
	if(count($insurance) > 0) {
?>
						                <ul>
<?php
		for($i=0;$i<count($insurance);$i++) {
?>
						                    <li><?php echo $insurance[$i]['name']; ?></li>
<?php
		}
?>
						                </ul>
<?php
	}
?>
						            </div>
						        </div>
						    </div>

							<!-- Hospital Affiliations -->
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="hospital-heading">
						            <h3>
						                <?php echo TranslateStatic('hospital', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-hospital" class="panel-collapse" role="tabpanel" aria-labelledby="hospital-heading">
						            <div class="panel-body">
<?php
	if(count($hospitals) > 0) {
?>
						                <ul>
<?php
		// Print out the schools
		for($i=0;$i<count($hospitals);$i++) {
?>
						                    <li itemprop="affiliation" itemscope="" itemtype="http://schema.org/Hospital">
						                    	<span itemprop="name"><?php echo $hospitals[$i]['name']; ?></span>
						                    </li>
<?php
		}
?>
						                </ul>
<?php
	}
?>
						            </div>
						        </div>
						    </div>

							<!-- Awards, memberships and interests -->
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="awards-heading">
						            <h3>
						                <?php echo TranslateStatic('ami', $lang); ?>
						            </h3>
						        </div>

						        <div id="collapse-awards" class="panel-collapse" role="tabpanel" aria-labelledby="awards-heading">
						            <div class="panel-body">
<?php
	foreach($ami as $key => $val) {
?>
						                <ul>
<?php
		for($i=0;$i<count($val);$i++) {
?>
						                    <li>
<?php
			if($key == 'awards') {
				echo '<span itemprop="award">'.$val[$i]['award'].'</span>';

				if($val[$i]['name'] != $val[$i]['year'] && !empty($val[$i]['year'])) {
					echo ' - '.$val[$i]['year'];
				}
			} else {
				echo $val[$i]['name']; 
			}
?>
						                    </li>
<?php
		}
?>
						                </ul>
<?php
	}
?>
						            </div>
						        </div>
						    </div>
						</div>

                        <!-- Reviews -->
                        <h3>
                            <?php echo TranslateText('Reviews', 'en', $lang); ?>
                        </h3>
<?php
    // Echo out each review
    if(count($reviews) > 0) {
    	for($i=0;$i<count($reviews);$i++) {
?>
						<div class="review">
							<p>
								<?php echo TranslateText($reviews[$i]['review'], 'en', $lang); ?>
							</p>

							<span><?php echo $reviews[$i]['left_by']; ?></span>
						</div>
<?php
    	}
?>
						
<?php
    } else {
?>
                    	<div class="none"><?php echo TranslateText("This doctor doesn't have any reviews", 'en', $lang); ?></div>
<?php
    }     
    //if($doctor['masonry'] == 1) {
    if(count($pics) >0 ) {
?>
                        <div id="doctor-highlights" class="loading">
                            <h3>
                            	<?php echo TranslateText('Highlights', 'en', $lang); ?>
                            </h3>
                            
                            <div class="ajax-loader" id="masonry_container">
                            	<i class="fa fa-cog fa-3x fa-spin"></i>
                            </div>

                            <ul id="highlight-list" class="list-unstyled">
                                <li class="grid-sizer"></li>
<?php
		// FormatArray($pics);
		for($i=0;$i<$pics['count'];$i++) {
?>
								<li class="item">
                                    <a data-gallery="#doctor-highlights-gallery" href="<?php echo $path.$pics['results'][$i]['img']; ?>">
                                    	<img src="<?php echo $path.$pics['results'][$i]['img']; ?>" class="img-responsive">
                                    </a>
                                    
                                    <div class="gallery-content">
                                        <div class="row">
                                            <div class="gallery-img col-sm-8 col-lg-9"></div>
                                            	<div class="gallery-body col-sm-4 col-md-3">
                                                <h4 class="gallery-title"><?php echo $pics['results'][$i]['title']; ?></h4>
                                                
                                                <p><?php echo $pics['results'][$i]['description']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
<?php
		}
?>
                            </ul>
                    	</div>
<?php
	}
?>
                	</div>
                </div>

                <!-- Similar Doctors -->
                <div class="col-sm-5 col-md-4" id="similar_box">
                    <h4>
                        <?php echo TranslateText('Similar Doctors', 'en', $lang); ?>
                    </h4>

                    <div class="sidebar bg">
                        <div id="similar_load">
                            <div class="ajax-loader"><i class="fa fa-cog fa-3x fa-spin"></i></div>
                        </div>
                    </div>

					<!--
					<div id="searchform_635666171388858535">
						<iframe src="http://widgets.partners.expedia.com/daily/shared/affiliates/WidgetiFrame.aspx?partner=cobrand&eapid=478586&size=250x250&products=flights&widgetname=searchform&divid=searchform_635666171388858535&langid=1033" width="250" height="250" scrolling="no" frameborder="0"></iframe>
					</div>
					-->
<?php
	if($pinterest) {
?>
					<div class="sidebar bg" style="padding: 10px;">
			            <a data-pin-do="embedBoard" 
			            	href="https://www.pinterest.com/voyagermed0196/<?php echo str_replace(' ', '-', $doctor['city']); ?>/" 
			            	data-pin-scale-width="80" 
			            	data-pin-scale-height="200" >        
			            	Follow VoyagerMed 's board <?php echo $doctor['city']; ?> on Pinterest.</a>
			            <script async src="//assets.pinterest.com/js/pinit.js"></script>  
			        </div>
<?php
	}
?> 
	            </div>
	        </div>
            
	    </div> 

		<!-- The modal for booking a reservation -->
	    <div class="modal fade" id="modal">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h3 class="modal-title">
	                    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo TranslateText('Close', 'en', $lang); ?></span></button>
                            <?php echo TranslateText('Contact Us', 'en', $lang); ?>
	                    </h3>
	                </div>

	                <form method="GET" action="<?php echo $base_url; ?>procedures/Book">
	                    <div class="modal-body">
	                    	<input type="text" class="form-control" placeholder="First Name" name="first_name"><br>
	                    	<input type="text" class="form-control" placeholder="Last Name" name="last_name"><br>
	                    	<input type="text" class="form-control" placeholder="Zip Code" name="zip"><br>
	                        <input type="text" class="form-control" placeholder="Email" name="email"><br>
	                        <input type="text" class="form-control" placeholder="Phone" name="phone"><br>
	                        
	                        <select class="form-control" name="procedure">
<?php
	for($i=0;$i<$specialties['count'];$i++) {
?>
								<option value="<?php echo $specialties['results'][$i]['name']; ?>"><?php echo TranslateText($specialties['results'][$i]['name'], 'en', $lang); ?></option>
<?php
	}
?>
								<option value="Other"><?php echo TranslateText('Other', 'en', $lang); ?></option>
	                        </select><br>

	                        <textarea placeholder="Comments" name="comment" class="form-control" rows="5"></textarea>
	                    </div>

	                    <div class="modal-footer">
	                        <button class="btn btn-primary" type="submit"><?php echo TranslateText('Submit', 'en', $lang); ?></button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
        
        <!-- The modal for book appointment -->
        <div class="modal fade" id="modal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo TranslateText('Close', 'en', $lang); ?></span></button>
                            <?php echo TranslateText('Book appointment', 'en', $lang); ?>
                        </h3>
                    </div>

                    <form method="GET" id="appointment_form" action="<?php echo $base_url; ?>procedures/bookAppointment">
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="First Name" name="book_first_name"><br>
                            <input type="text" class="form-control" placeholder="Last Name" name="book_last_name"><br>
                            <input type="text" class="form-control" placeholder="Zip Code" name="book_zip"><br>
                            <input type="text" class="form-control" placeholder="Email" name="book_email"><br>
                            <input type="text" class="form-control" placeholder="Phone" name="book_phone"><br>
                            
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" class="form-control" name="book_datetime">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            
                            
                            <textarea placeholder="Comments" name="book_comment" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><?php echo TranslateText('Submit', 'en', $lang); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

	    <!-- Write all of the variables for the JS to work correctly -->
		<div class="hidden" id="angle"><?php echo $doctor['angle']; ?></div>
		<div class="hidden" id="tilt"><?php echo $doctor['tilt']; ?></div>
		<div class="hidden" id="lon"><?php echo $doctor['lon']; ?></div>
		<div class="hidden" id="lat"><?php echo $doctor['lat']; ?></div>
		<div class="hidden" id="inconsistent"><?php echo $inconsistent; ?></div>
		<div class="hidden" id="map_lon"><?php echo $doctor['map_lon']; ?></div>
		<div class="hidden" id="map_lat"><?php echo $doctor['map_lat']; ?></div>
		<div class="hidden" id="address"><?php echo $doctor['address']; ?></div>
		<div class="hidden" id="abbrev"><?php echo $doctor['abbrev']; ?></div>
		<div class="hidden" id="state"><?php echo $doctor['state']; ?></div>
		<div class="hidden" id="city"><?php echo $doctor['city']; ?></div>
		<div class="hidden" id="doctor_id"><?php echo $doctor['id']; ?></div>

		<!-- The reference for toggling with JS -->
        <div class="hidden" id="edit_ref">0</div>
