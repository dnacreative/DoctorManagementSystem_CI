<?php
	$base_url = $this->config->base_url();;
	$js_url = $base_url.'public/js/';

	// Get the controller name
	$controller = $this->router->fetch_class();
     

    // Get the method
    $method = $this->router->fetch_method();

    $list = array('Breast Augmentation' => 'Breast Augmentation',
                'Tummy Tuck' => 'Tummy Tuck' ,
                'Liposuction' => 'Liposuction',
                'Mommy Makeover' => 'Mommy Makeover',
                'Face Lift' => 'Face Lift',
                'Brazilian Butt Lift' => 'Brazilian Butt Lift',
                'Orthopedic' => 'Orthopedic',
                'Knee Replacement' => 'Knee Replacement',
                'Hip Replacement' => 'Hip Replacement',
                'ACL Repair' => 'ACL Reconstruction (Patellar Tendon)',
                'Disc Replacement' => 'Artificial Disc Replacement',
                'Spine Surgery' => 'Spine Surgery',
                'Scoliosis' => 'Scoliosis',
                'Spinal Fusion' => 'Spinal Fusion',
                'Dental Crowns' => 'Dental Crown',
                'Whitening' => 'ZOOM! Whitening',
                'Dental Implants' => 'Dental Implants');

    $docs = array('Terry Dubrow' => 'California',
                'Shim Ching' => 'Hawaii',
                'Mel Ortega' => 'Miami',
                'Julius Few' => 'Chicago',
                'Paul Vitenas' => 'Houston',
                'Sanjay Grover' => 'Newport Beach',
                'Michael Bogdan' => 'Dallas',
                'Jason Emer' => 'Beverly Hills',
                'Elizabeth Morgan' => 'Atlanta',
                'Dennis Hurwitz' => 'Pittsburgh',                
                'Victoria Veytsman' => 'Manhattan',
                'Struan Coleman' => 'Manhattan',
                'George Peck' => '',
                'Robert Silich' => '',                
                );
?>
        </main><!-- /#page-main -->

		<footer id="footer">
<?php 
    if($controller == 'home') {
?>
            <div id="mission_text">
                <div  class="container">
                    <h1 class="text-center">
                        <?php echo TranslateText("What We Do at VoyagerMed", 'en', $lang); ?>
                    </h1>
                    
                    <p>
<?php
    $slogan = "VoyagerMed is redefining the way people access life changing medical innovation. Traveling for medical care is a new concept for Americans. But people from Europe, Asia, Australia and Latin America have been using medical tourism for decades to save money on lower cost medical procedures and surgeries like: <a href='".$base_url."search/Plastic-Surgery/all/distance-desc'>plastic surgery</a>, orthopedics, spine, heart surgery, weight loss surgery, dental care and more. <br><br> 
            We built an on online marketplace for medical tourism that will help you search, evaluate and travel to the best doctors in the United States for your particular medical condition.  And we also help you find an affordable healthcare option that fits your budget through our VoyagerMed Real Price network of doctors and healthcare providers who give you the lowest price surgery without sacrificing the quality that the American healthcare system provides.";
    echo TranslateText($slogan, 'en', $lang);
?>
                    </p>
                </div>
            </div>
<?php 
    }
?>
            <div id="sub_footer" class="container">
                <div class="row">
                    <div class="col-lg-4 clearfix">
                        <div class="list_header">
                            VoyagerMed
                        </div>

                        <div class="list_columns">
                            <ul class="col-sm-6 list-group">
                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>"><?php echo TranslateText('Home', 'en', $lang); ?></a>
                                </li>

                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>about"><?php echo TranslateText('About', 'en', $lang); ?></a>
                                </li>

                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>privacy"><?php echo TranslateText('Privacy', 'en', $lang); ?></a>
                                </li>

                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>terms"><?php echo TranslateText('Terms of Service', 'en', $lang); ?></a>
                                </li>

                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>sitemap.xml"><?php echo TranslateText('Sitemap', 'en', $lang); ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>search"><?php echo TranslateText('Search', 'en', $lang); ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>doctors"><?php echo TranslateText('Doctors', 'en', $lang); ?></a>
                                </li>
                                
                                <li class="list-group-item">
                                    <a href="http://blog.voyagermed.com"><?php echo TranslateText('Blog', 'en', $lang); ?></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 clearfix">
                        <div class="list_header">
                            <?php echo TranslateText('Browse Procedures', 'en', $lang); ?>
                        </div>

                        <div class="list_columns">
                            <ul class="col-sm-6 list-group">
<?php
                $half = ceil(count($list)/2);
                $i = 0;

                foreach($list as $key => $val) {
                    if($half == $i) {
                        echo '</ul><ul class="col-sm-6 list-group">';
                    }
?>
                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>search/<?php echo str_replace(' ', '-', $val); ?>"><?php echo TranslateText($key, 'en', $lang); ?></a>
                                </li>
<?php
                    $i++;
                }
?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 clearfix">
                        <div class="list_header">
                            <?php echo TranslateText('Browse Doctors', 'en', $lang); ?>
                        </div>

                        <div class="list_columns">
                            <ul class="col-sm-6 list-group">
<?php
                $half = ceil(count($docs) / 2);
                $i = 0;

                foreach($docs as $name => $val) {
                    if ($half == $i){
                        echo '</ul><ul class="col-sm-6 list-group">';
                    }
?>
                                <li class="list-group-item">
                                    <a href="<?php echo $base_url; ?>doctors/<?php echo str_replace(' ', '-', $name); ?>"><?php echo $name; ?></a>
                                </li>
<?php
                    $i++;
                }
?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

			<div class="container text-center" id="copyright_top">
				<span class="copyrights">
					<?php echo TranslateText('Our <a href="'.$base_url.'privacy">Privacy Policy</a> and <a href="'.$base_url.'terms">Terms of Use</a>', 'en', $lang); ?> ©2015&nbsp;VoyagerMed,&nbsp;Inc.
				</span>

				<ul id="social_footer_list">
                	<li><a href="https://www.facebook.com/voyagermed" target="_blank" rel="nofollow"><i class="fa fa-facebook-f"></i> Facebook</a>
                	<li><a href="https://www.instagram.com/voyagermed" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i> Instagram</a>
                	<li><a href="https://www.twitter.com/voyagermed" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i> Twitter</a>
                	<li><a href="https://plus.google.com/+Voyagermed/" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i> Google +</a>
                    <li><a href="https://www.pinterest.com/voyagermed0196/" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i> Pinterest</a>
            	</ul>

                <div class="clearfix"></div>
			</div>
		</footer>
<?php
    // Close '#search-results-canvas' container started in views/search.php
    if($controller == 'search'){ ?>
    </div>
    <?php
    } ?>

		<!-- Include optional/page-specific javascript -->
        <script>   
            // Set up bootstrap breakpoints for js use
            $script.ready(['matchMedia', 'ssm', 'jQuery'],function() {
                var $win = $(window), $doc = $(document);

                // Create bootstrap breakpoints
                ssm.addStates([
                    // xxs not really in bootstrap, but bootstrap xs covers a lot of ground...
                    {
                        id: 'xxs',
                        maxWidth: Math.round(0.75 * 767),
                        onEnter: function() {
                            $doc.trigger('mqMatch','xxs');
                        }
                    },
                    // Here are the real bootstrap breakpoints
                    {
                        id: 'xs',
                        minWidth: Math.round(0.75 * 767) + 1,
                        maxWidth: 767,
                        onEnter: function() {
                            $doc.trigger('mqMatch','xs');
                        }
                    },
                    {
                        id: 'sm',
                        minWidth: 768,
                        maxWidth: 991,
                        onEnter: function() {
                            $doc.trigger('mqMatch','sm');
                        }
                    },
                    {
                        id: 'md',
                        minWidth: 992,
                        maxWidth: 1199,
                        onEnter: function() {
                            $doc.trigger('mqMatch','md');
                        }
                    },
                    {
                        id: 'lg',
                        minWidth: 1200,
                        onEnter: function() {
                            $doc.trigger('mqMatch','lg');
                        }
                    }
                ]).ready();

                // Bind document mqInit/mqMatch events
                $doc.data('mqCurrent',false).on('mqInit',function(e) {
                    // Determine which media query matches
                    var bestMatch;
                    if(ssm.isActive('xxs')) bestMatch = 'xxs';
                    if(ssm.isActive('xs')) bestMatch = 'xs';
                    if(ssm.isActive('sm')) bestMatch = 'sm';
                    if(ssm.isActive('md')) bestMatch = 'md';
                    if(ssm.isActive('lg')) bestMatch = 'lg';
                    $doc.trigger('mqMatch', bestMatch).data('mqCurrent', bestMatch);
                })
                
                // Global function to run when media queries are matched
                .on('mqMatch',function(e,size) {
                });

                // On document.ready, mqInit
                $(function() { 
                    $doc.trigger('mqInit'); 
                });
            });
            
            // Load main js and each page's javascript file
            
            $script('<?php echo $js_url; ?>main.js');
            $script('<?php echo $js_url.$controller; ?>.js');
        </script>

        <!--Sharing Buttons-->
        <script>var switchTo5x=true;</script>
        
        <script src="https://ws.sharethis.com/button/buttons.js"></script>
        <script src="https://ss.sharethis.com/loader.js"></script>

        <script src="<?php echo $js_url; ?>ion.rangeSlider.min.js"></script>
        
        <script>
            stLight.options({publisher: "61910d00-783e-4a16-9540-a91a122b3154", doNotHash: false, doNotCopy: false, hashAddressBar: false});
        </script>

        <script> 
            var options={ "publisher": "61910d00-783e-4a16-9540-a91a122b3154", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "linkedin", "email", "sharethis"]}};
            var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
        </script>
        
<?php
     
    //if($base_url != '/voyagermed/') 
    {
?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-67898658-1', 'auto');
            ga('send', 'pageview');
        </script>

        <!-- Start of StatCounter Code for Default Guide -->
        <script type="text/javascript">
            var sc_project=10507976; 
            var sc_invisible=1; 
            var sc_security="0fff9e0a"; 
            var sc_https=1; 
            var scJsHost = (("https:" == document.location.protocol) ?
            "https://secure." : "http://www.");
            document.write("<sc"+"ript type='text/javascript' src='" +
            scJsHost+
            "statcounter.com/counter/counter.js'></"+"script>");
        </script>
        <noscript>
            <div class="statcounter">
            <a title="free hitcounter" href="http://statcounter.com/" target="_blank"><img
                class="statcounter"
                src="http://c.statcounter.com/10507976/0/0fff9e0a/1/"
                alt="free hit counter"></a>
            </div>
        </noscript>
        <!-- End of StatCounter Code for Default Guide -->
<?php
    }
?>
        <!-- Google Code for Free medical consultation form submission Conversion Page -->  
        
        <script>
            /* <![CDATA[ */
            var google_conversion_id = 976775656;
            var google_conversion_language = "en";
            var google_conversion_format = "0";
            var google_conversion_color = "c4c4c4";
            var google_conversion_label = "A6peCNWa71gQ6NPh0QM";
            var google_remarketing_only = false;
            /* ]]> */
        </script>  
        <script src="//www.googleadservices.com/pagead/conversion.js"></script>
       
        <noscript>
            <div style="display: none;">
                <img height="1" width="1" style="border-style: none;" alt="" src="//www.googleadservices.com/pagead/conversion/976775656/?label=A6peCNWa71gQ6NPh0QM&amp;guid=ON&amp;script=0">
            </div>
        </noscript>
        
        <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser which is not supported by this site. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <noscript>
            <p class="js-required">This site requires javascript. Please enable it to improve your experience.</p>
        </noscript>
        
        <!-- Start of LiveChat (www.livechatinc.com) code -->
        <script type="text/javascript">
        window.__lc = window.__lc || {};
        window.__lc.license = 6824811;
        (function() {
          var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
          lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
        })();
        </script>
        <!-- End of LiveChat code -->
	</body>
</html>