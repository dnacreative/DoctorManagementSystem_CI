<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';
?>
		<!-- <?php echo TranslateText('', 'en', $lang); ?> -->
		<!-- Header starts here -->
	    <div class="header-wrap  center" id="home" name="home">
	        <header class="clearfix">
	            <h1 class="animated fadeInUp" style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	VoyagerMed
	            </h1>
	            
	            <p class="animated fadeInUp" style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	<?php echo TranslateText('about us', 'en', $lang); ?>.
	            </p>
                
                <a href="#" class="down-arrow-scroll">
                	<span class="fa fa-chevron-circle-down" style="font-size: -webkit-xxx-large; color: white;"></span>
                </a>
	        </header>       
	    </div>
    
		<!-- Services/Features section starts here -->
	    <div class="services-wrap  center" id="about_columns">
	        <div class="row">
	            <div class="col-lg-3 callout">
	                <span class="icon icon-plane"></span>
	                <h2><?php echo TranslateText('Medical Tourism', 'en', $lang); ?></h2>
	                
	                <p style="text-align: -webkit-auto; margin: 0 15px 0 15px;">
<?php
	$block = "Traveling to the U.S. for healthcare from overseas can be challenging. We help make it a breeze! Search, evaluate and choose the doctors for you in a place you would like to visit. We offer access to great surgeons for treatments including: cosmetic, dental, orthopedic, spine, heart, cancer, weight loss and more.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	                    
	            <div class="col-lg-3 callout">
	                <span class="icon icon-stethoscope"></span>
	                <h2><?php echo TranslateText('Doctors', 'en', $lang); ?></h2>
	                
	                <p style="text-align: -webkit-auto; margin: 0 15px 0 15px;">
<?php
	$block = "We only select top doctors in their fields who have an interest in working with traveling patients from all over the world, even from other places in the U.S.  We hand pick each of our doctors to ensure they meet the VoyagerMed criteria for excellence in medical care as well as attention to meet the unique needs of medical tourism patients.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	                
	            <div class="col-lg-3  callout">
	                <span class="icon  icon-female"></span>
	                <h2><?php echo TranslateText('Patient Care', 'en', $lang); ?></h2>
	                
	                <p style="text-align: -webkit-auto; margin: 0 15px 0 15px;">
<?php
	$block = "When you become a patient of one of VoyagerMed’s doctors, we will be here to help facilitate all your needs around travel and logistics.  You need to get lots of information together for your doctor to plan the trip to great surgeons in the U.S.  We’re here to help! So contact us if you have any questions at all any time in your journey to health!";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	                
	            <div class="col-lg-3  callout">
	                <span class="icon  icon-smile"></span>
	                <h2><?php echo TranslateText('Satisfaction', 'en', $lang); ?></h2>
	                
	                <p style="text-align: -webkit-auto; margin: 0 15px 0 15px;">
<?php
	$block = "Your wellness is our business.  We’re here to help match you with the best doctor for your medical condition. Whether you’re traveling just across the state to save money or coming here from the other side of the world to get the top expert medical innovator in the country, we help you connect with the healthcare provider that can help you the most.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	        </div>
	    </div>
	    
	    <!-- #1 Divider with few words/quote -->
	    <section class="divider  divider-bg-1  center">
	        <div class="container">
	            <h1 style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	<?php echo TranslateText('What We Do', 'en', $lang); ?>
	            </h1><hr>
	        </div>
	    </section>
	    
	    <!-- About section starts here -->
	    <div class="container" id="about" name="about">
	        <div class="row">
	            <br>
				<!-- <h1 class="center">WHO WE ARE</h1> -->
	            <hr><br>

	            <div class="col-lg-4">
	                <p>
<?php
	$block = "VoyagerMed is redefining the way people access life changing medical innovation. Traveling for medical care is a new concept for Americans. But people from Europe, Asia, Australia and Latin America have been using medical tourism for decades to save money on lower cost medical procedures and surgeries like: plastic surgery, orthopedics, spine, heart surgery, weight loss surgery, dental care and more.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	            
	            <div class="col-lg-4">
	                <p>
<?php
	$block = "We built an online marketplace for medical tourism that will help you search, evaluate and travel to the best doctors in the United States for your particular medical condition.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>

	            <div class="col-lg-4">
	                <p>
<?php
	$block = "And  we also help you find an affordable healthcare option that fits your budget through our VoyagerMed Real Price network of doctors and healthcare providers who give you the lowest price surgery without sacrificing the quality that the American healthcare system provides.";
	echo TranslateText($block, 'en', $lang);
?>
	                </p>
	            </div>
	        </div><br>
	    </div>
	    
	    <!-- #2 Divider with few words/quote -->
	    <section class="divider  divider-bg-2  center">
	        <div class="container">
	            <h1 style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	<?php echo TranslateText('Search. Evaluate. Travel.', 'en', $lang); ?>
	            </h1><hr>
	        </div>
	    </section>
	    
	    <!-- #1 Screenshot section (knee search) starts here -->
	    <div class="feature-wrap  left" id="features" name="features">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-6  center">
	                    <img class="img-responsive" src="<?php echo $base_url; ?>public/images/Screenshot_knee.jpg">
	                </div>

	                <div class="col-lg-6">
	                    <h2>
	                    	<?php echo TranslateText('Search for treatment and destination', 'en', $lang); ?>.
	                    </h2>

	                    <p>
<?php
	$block = "We have found the best doctors for your medical condition. Narrow down by using our simple search bar for treatments and destinations.";
	echo TranslateText($block, 'en', $lang);
?>
	                    </p> <!-- Description -->
	                </div>                  
	            </div>
	        </div><br><br>
	    </div><hr>
	    
	    <!-- #2 Screenshot section (treatment results) starts here -->
	    <div class="feature-wrap">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-6">
	                    <h2>
	                    	<?php echo TranslateText('Evaluate your options', 'en', $lang); ?>.
	                    </h2>
	                    
	                    <p>
<?php
	$block = "VoyagerMed gives you doctors that treat your specific condiiton and you can evaluate based on reviews, cost, distance, insurance, education and hospital affirmation.";
	echo TranslateText($block, 'en', $lang);
?>
	                    </p>
	                </div>      

	                <div class="col-lg-6  center">
	                    <img class="img-responsive" src="<?php echo $base_url; ?>public/images/Screenshot_treatment.jpg">
	                </div>              
	            </div>
	        </div><br><br>
	    </div><hr>
	    
	    <!-- #3 Screenshot section (doctor profile) starts here -->
	    <div class="feature-wrap  left" id="features" name="features">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-6  center">
	                    <img class="img-responsive" src="<?php echo $base_url; ?>public/images/Screenshot_doctor.jpg">
	                </div>

	                <div class="col-lg-6">
	                    <h2>
	                    	<?php echo TranslateText('Choose the right doctor', 'en', $lang); ?>.
	                    </h2>

	                    <p>
<?php
	$block = "You can see all about your doctor, where they are located, their experience and insurance accepted.";
	echo TranslateText($block, 'en', $lang);
?>
	                    </p> <!-- Description -->
	                </div>                  
	            </div>
	        </div><br><br>
	    </div><hr>

        <!-- #4 Screenshot (youtube video) section starts here -->
        <div class="feature-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>
                        	<?php echo TranslateText("Choose your hotel in that doctor's location", 'en', $lang); ?>.
                        </h2>
                        
                        <p>
<?php
	$block = "Make your reservations right from your chosen doctor's page! We make it simple to search, evaluate and go!";
	echo TranslateText($block, 'en', $lang);
?>
                        </p>
                    </div>      

                    <div class="col-lg-6  center">
                        <img class="img-responsive" src="<?php echo $base_url; ?>public/images/Screenshot_hotels.jpg">
                    </div>              
                </div>
            </div><br><br>
        </div>

	    <!-- #3 Divider with few words/quote -->
	    <section class="divider  divider-bg-3  center">
	        <div class="container">
	            <h1 style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	<?php echo TranslateText("Meet the Team", 'en', $lang); ?>
	            </h1><hr>
	        </div>
	    </section>
	    
	    <!-- Team/staff section starts here -->
	    <div class="container" id="team" name="team">
	        <br>
	        <div class="row center">
	            <br>
	            <hr><br><br>
	            
	            <!-- Single team member -->
	            <div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>anthony_girand_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Anthony Girand</b>
	                </h4>
	           
	                <p>
	                	CEO/Co-Founder
	                </p>
	            </div>

	            <div class="col-lg-3 center">
	                <img class="img img-circle  team-member" src="<?php echo $img_url; ?>struan_coleman_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Struan Coleman, MD/PhD</b>
	                </h4>
	               
	                <p>Co-founder</p>
	            </div>

	            <div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>kate_lemasters_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Kate Lemasters</b>
	                </h4>
	                
	                <p><?php echo TranslateText("Head of Content", 'en', $lang); ?></p>
	           	</div>

	            <div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>david_lundquist_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>David Lundquist</b>
	                </h4>
	           
	                <p><?php echo TranslateText("Strategic Advisor", 'en', $lang); ?></p>
	            </div>
	        </div><br>

	        <div class="row center">
				
	            <div class="col-lg-3 center">
	                <img class="img img-circle  team-member" src="<?php echo $img_url; ?>bryan_hanypsicak_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Bryan Hanypsiak, MD</b>
	                </h4>
	               
	                <p><?php echo TranslateText("Chief Medical Officer", 'en', $lang); ?></p>
	            </div>

	            <div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>sal_borea_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Sal Borea</b>
	                </h4>
	                
	                <p><?php echo TranslateText("VP of Sales", 'en', $lang); ?></p>
	            </div>

	            <div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>emily_hufnagel_voyagermed.png" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Emily Hufnagel</b>
	                </h4>
	           
	                <p><?php echo TranslateText("Director of Talent", 'en', $lang); ?></p>
	            </div>

			<div class="col-lg-3 center">
	                <img class="img img-circle team-member" src="<?php echo $img_url; ?>ahmed_fattouh_voyagermed.jpg" height="155px" width="155px" alt="">
	                <br>
	                
	                <h4>
	                	<b>Ahmed Fattouh</b>
	                </h4>
	           
	                <p><?php echo TranslateText("Strategic Adviso", 'en', $lang); ?></p>
	            </div>

	        </div>
	    </div>

	    <!-- #4 Divider with few words/quote -->
	    <section class="divider  divider-bg-4  center">
	        <div class="container">
	            <h1 style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	VoyagerMed
	            </h1>
	            <hr>
	            
	            <p style="font-weight: bold; text-shadow: 0 0 6px #020202;">
	            	<?php echo TranslateText("Redefining the way people access life-changing medical innovations", 'en', $lang); ?>
	            </p>
	        </div>
	    </section>