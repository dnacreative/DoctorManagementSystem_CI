<?php        

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
   
    // Define all of the URLs for the pubic files
    $base_url = $this->config->base_url();  
    $img_url = $base_url.'public/images/';
    $css_url = $base_url.'public/css/';
    $js_url = $base_url.'public/js/';
//var_dump($title);exit;
    // Get the controller name
    $controller = $this->router->fetch_class();

    // Get the method
    $method = $this->router->fetch_method();
    // The doctors
    $docs = array('Dental', 'Orthopedic', 'Plastic Surgery', 'Spine', 'Cancer', 'Fertility', 'Heart');

     // Body procedures
    $procedures_body = array('Body Lift', 'Brazilian Butt Lift', 'Breast Augmentation', 'Breast Lift',
                            'Breast Reduction', 'Laser Hair Removal', 'Liposuction', 'Mommy Makeover', 
                            'Tummy Tuck');

    // Face procedures
    $procedures_face = array('Botox', 'Chemical Peel', 'Chin Implant', 'Eyelid Surgery', 'Face Lift', 
                            'Fat Transfer', 'Forehead Lift', 'Juvederm',
                            'Lip Augmentation', 'Mini Lift', 'Rhinoplasty', 'Wrinkle Treatment');

    // Smile procedures
    $procedures_smile = array('Dental Implants', 'Invisalign', 'Veneers', 'ZOOM! Whitening');

    // Orthopedics procedures
    $procedures_ortho = array('Hip Replacement', 'Knee Replacement');

    // Spinal procedures
    $procedures_spine = array('Artificial Disc Replacement', 'Spinal Fusion', 'Stem Cell Treatment');

    // Put all of the procedures into one array
    $procedures = array(array('name' => 'body', 'results' => $procedures_body),
                        array('name' => 'face', 'results' => $procedures_face),
                        array('name' => 'smile', 'results' => $procedures_smile),
                        array('name' => 'orthopedics', 'results' => $procedures_ortho),
                        array('name' => 'spine', 'results' => $procedures_spine));
                        
?>
<!doctype html>
    <!--[if lt IE 9]> <html class="no-js lt-ie9" lang=""> <![endif]-->
    <!--[if gt IE 9]><!--><html class="no-js" lang=""><!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo base_url('public/images/favicon.png')?>">

        <!-- Google security code -->
        <meta name="google-site-verification" content="eXHSmxBmy5YLrfiolAOp-_jUT8PbOBXNWLLv4ZU54_A" />
        <!-- Google Plus -->
        <link rel="publisher" href="http://plus.google.com/+voyagermed/">
<?php
    if($controller == 'doctors') {
        if($single) {
?>
        <!-- Meta Tags -->
        <meta name="title" content="<?php echo $title; ?>">
        <meta name="description" content="<?php echo $description; ?>">

        <!-- Meta Keywords -->
        <meta name="keywords" content="Doctors,Plastic Surgery,Medical Tourism">    
        
        <!-- Profile Meta Tags -->
        <meta property"profile:first_name" content="<?php echo $first; ?>">
        <meta property"profile:last_name" content="<?php echo $last; ?>">

        <!-- Open Graph Tags -->
        <meta property="og:locale" content="en_US"> 
        <meta property="og:type" content="profile"> 
        <meta property="og:image" content="<?php echo base_url($img); ?>"> 
        <meta property="og:title" content="<?php echo $title; ?>"> 
        <meta property="og:description" content="<?php echo $description ?>">   
        <meta property="og:url" content="<?php echo base_url('doctors/' . $first.'-'.$last);?>">

        <!-- Twitter Cards -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@voyagermed">
        <meta name="twitter:creator" content="@voyagermed">
<?php
        }
    } 
    elseif($controller == 'home') {
?>
        <meta name="title" content="<?php echo $title; ?>">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="Plastic Surgery, Orthopedics, Spine, Dental, Fertility, Heart Surgery, Cancer Treatment, Weightloss Surgery, Sports Medicine, Cosmetic Dentistry, Back Pain, Breast Augmentation, Tummy Tuck, Mommy Makeover, Liposuction, Medical Tourism, Knee Replacement, Hip Replacement, Joint Pain"> 

        <meta property="og:title" content="<?php echo $title; ?>">
        <meta property="og:site_name" content="VoyagerMed">
        <meta property="og:image" content="<?php echo base_url('public/images/favicon.png')?>">
        <meta property="og:type" content="website">
        <meta property="og:description" content="<?php echo $description; ?>">
        <meta property="og:url" content="<?php echo $base_url;?>">
<?php
    } 
    elseif($controller == 'search') {
?>
        <meta name="title" content="<?php echo $title; ?>">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $procedure; ?>">   

        <meta property="og:title" content="<?php echo $title; ?>">
        <meta property="og:site_name" content="VoyagerMed">
        <meta property="og:image" content="<?php echo base_url('public/images/favicon.png')?>">
        <meta property="og:type" content="website">
        <meta property="og:description" content="<?php echo $description; ?>">
        <meta property="og:url" content="<?php echo base_url('search/' . $procedure . '/' . $location . '/');?>">
<?php
    } 
    elseif($controller == 'community') {
        $sentence = explode('.', $description);
?>
        <meta name="title" content="<?php echo $title; ?>">
        <meta name="description" content="<?php echo $sentence[0]; ?>">

        <meta property="og:title" content="<?php echo $title; ?>">
        <meta property="og:site_name" content="VoyagerMed">
        <meta property="og:image" content="<?php echo base_url('public/images/favicon.png')?>">
        <meta property="og:type" content="website">
        <meta property="og:description" content="<?php echo $sentence[0]; ?>">
        <meta property="og:url" content="<?php echo base_url('community/' . $term);?>">
<?php
    }   
    
?>


    
        <link rel="stylesheet" href="<?php echo $css_url; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css_url; ?>font-awesome.min.css">
        <!--<link href="<?php echo $css_url; ?>stateface.css" rel="stylesheet" media="all">-->

        <!-- jQuery UI CSS -->
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css" rel="stylesheet">

        <!-- Font-Awesome CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Flexslider CSS -->
        
        <link href="<?php echo $css_url; ?>flexslider.min.css" rel="stylesheet" media="screen">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.15.2/css/blueimp-gallery.min.css" rel="stylesheet" media="screen">
        

        <!-- Slider CSS -->
        
        <link rel="stylesheet" href="<?php echo $css_url; ?>slider.min.css">
        
        
        <!-- About page CSS -->
        <link href="<?php echo $css_url; ?>style3.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $css_url; ?>animate.min.css" rel="stylesheet" type="text/css"> 

        <!-- Custom Style Sheets -->
        <link href="<?php echo $css_url; ?>style.css" rel="stylesheet" media="all">
        <link href="<?php echo $css_url; ?>custom.css" rel="stylesheet" media="all">

	<!-- rangeSlider -->
    <!--
        <link href="<?php echo $css_url; ?>ion.rangeSlider.css?time=<?php echo time(); ?>" rel="stylesheet" media="all">
        <link href="<?php echo $css_url; ?>ion.rangeSlider.skinFlat.css?time=<?php echo time(); ?>" rel="stylesheet" media="all">        
    -->
        <link href="<?php echo $css_url; ?>ion.rangeSlider.min.css" rel="stylesheet" media="all">
        <link href="<?php echo $css_url; ?>ion.rangeSlider.skinFlat.min.css" rel="stylesheet" media="all">
        
        <!--  for datetime picker -->
        <link href="<?php echo $css_url; ?>bootstrap-datetimepicker.css" rel="stylesheet" media="all">
        
        
        <!-- Load modernizr blocking to prevent flicker of unstyled content -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>  

        <script>
            (function(e,t){typeof module!="undefined"&&module.exports?module.exports=t():typeof define=="function"&&define.amd?define(t):this[e]=t()})("$script",function(){function p(e,t){for(var n=0,i=e.length;n<i;++n)if(!t(e[n]))return r;return 1}function d(e,t){p(e,function(e){return!t(e)})}function v(e,t,n){function g(e){return e.call?e():u[e]}function y(){if(!--h){u[o]=1,s&&s();for(var e in f)p(e.split("|"),g)&&!d(f[e],g)&&(f[e]=[])}}e=e[i]?e:[e];var r=t&&t.call,s=r?t:n,o=r?e.join(""):t,h=e.length;return setTimeout(function(){d(e,function t(e,n){if(e===null)return y();e=!n&&e.indexOf(".js")===-1&&!/^http?:\/\//.test(e)&&c?c+e+".js":e;if(l[e])return o&&(a[o]=1),l[e]==2?y():setTimeout(function(){t(e,!0)},0);l[e]=1,o&&(a[o]=1),m(e,y)})},0),v}function m(n,r){var i=e.createElement("script"),u;i.onload=i.onerror=i[o]=function(){if(i[s]&&!/^c|loade/.test(i[s])||u)return;i.onload=i[o]=null,u=1,l[n]=2,r()},i.async=1,i.src=h?n+(n.indexOf("?")===-1?"?":"&")+h:n,t.insertBefore(i,t.lastChild)}var e=document,t=e.getElementsByTagName("head")[0],n="string",r=!1,i="push",s="readyState",o="onreadystatechange",u={},a={},f={},l={},c,h;return v.get=m,v.order=function(e,t,n){(function r(i){i=e.shift(),e.length?v(i,r):v(i,t,n)})()},v.path=function(e){c=e},v.urlArgs=function(e){h=e},v.ready=function(e,t,n){e=e[i]?e:[e];var r=[];return!d(e,function(e){u[e]||r[i](e)})&&p(e,function(e){return u[e]})?t():!function(e){f[e]=f[e]||[],f[e][i](t),n&&n(r)}(e.join("|")),v},v.done=function(e){v([null],e)},v})
        </script>
        
        <script>
            /* Polyfill - Enable matchMedia in browsers without support */
            if(!window.matchMedia) { 
                $script('<?php echo $js_url; ?>third_party/media.match.min.js', function (){ 
                    $script.done('matchMedia'); 
                }); 
            } else { 
                $script.done('matchMedia'); 
            }

            // Simple State Manager (js media queries)
            $script('https://cdnjs.cloudflare.com/ajax/libs/simplestatemanager/2.2.5/ssm.min.js', 'ssm');

            // jQuery
            $script('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', 'jQuery');

            // Google Maps API JS (yes, this requires a global callback in order to avoid google sending a document.write!)
            googleMapsDone = function() { 
                $script.done('Google Maps'); 
            };

            $script('https://maps.googleapis.com/maps/api/js?sensor=false&callback=googleMapsDone');
        
            
                
            // Scripts with jQuery dependencies
            $script.ready('jQuery', function() {
                // Bootstrap
                debugger;
                //ion.rangeSlider
                $script('<?php echo $js_url; ?>ion.rangeSlider.min.js', 'range slider');
            
                // $script('<?php echo $js_url; ?>bootstrap/bootstrap.min.js','Bootstrap');
                $script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js', 'Bootstrap');
                $script('https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js', 'Jasny Bootstrap');

                // jQuery UI (with touch punch)
                $script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', function() {
                    $script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', 'jQuery UI');
                });

                // FlexSlider JS
                $script('<?php echo $js_url; ?>third_party/jquery.flexslider-min.js', 'FlexSlider');

                // Blueimp
                $script('https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.15.2/js/jquery.blueimp-gallery.min.js', 'Blueimp');

                // Blueimp
                $script('<?php echo $js_url; ?>slider.min.js', 'slider');

                $script('https://www.youtube.com/iframe_api', 'youtube');

                
                // Isotope libraries (set script.js flag once all have loaded
                $script('https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.min.js', 'iso-core', function() {
                    $script('<?php echo $js_url; ?>third_party/packery-mode.pkgd.min.js', 'iso-layout');
                });
                
                $script('https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js', 'ImagesLoaded');
                
                $script.ready(['iso-core', 'iso-layout', 'ImagesLoaded'], function() {
                    $script.done('Isotope');
                });
                
                //datepicker  
                $script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js', 'moment', function(){
                    $script('<?php echo $js_url; ?>bootstrap-datetimepicker.min.js', 'datetime_picker', function(){
                        $('#datetimepicker1').datetimepicker();
                    });    
                });
                
                // Sharing Buttons
                $script('https://ws.sharethis.com/button/buttons.js', 'button');
                $script('https://ss.sharethis.com/loader.js', 'loader');
                
            });

            // When global scripts are ready, set script.js flag indicating such
            $script.ready(['matchMedia', 'ssm', 'jQuery', 'Google Maps', 'Bootstrap', 'Jasny Bootstrap', 'jQuery UI', 'FlexSlider', 'Blueimp', 'Isotope', 'youtube'],function() {
                $script.done('global');
            });
        </script>

        <title><?php echo ucwords($title); ?></title>
    </head>

<?php  
    if($controller == 'doctors') {
?>
    <body itemscope="" itemtype="https://schema.org/ProfilePage" class="animated fadeIn" data-spy="scroll" data-offset="0" data-target="#navbar-main">
        <link href="https://schema.org/Patient" itemprop="audience"> 
<?php
    } 
    else {
?>
    <body class="animated fadeIn" data-spy="scroll" data-offset="0" data-target="#navbar-main">
<?php
    }
?>
        <header id="page-header">
            <!-- Fixed navbar -->
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <div id="logo_div" >
                            <a id="brand-logo" class="navbar-brand" href="<?php echo $base_url; ?>">
                                <img src="<?php echo $img_url; ?>logo.jpg" alt="logo" class="svg">
                            </a>
                        </div>

<?php    
    // Display the sign in if it's the staging site
    if(ENVIRONMENT != 'production') {
?>
                        <!-- Sign In/Sign Out button -->
                        <div class="navbar-right pull-right" id="signin_box">   
<?php
        if($session) {
?>
                            <button class="btn btn-primary" onclick="location.href='<?php echo $base_url; ?>users/Logout'"> <?php echo TranslateText("Sign Out", 'en', $lang); ?></button>
<?php
        } else {
?>
                            <a href="<?php echo $base_url; ?>signup"><button class="btn btn-primary" id="signin_button"> <?php echo TranslateText("Sign In", 'en', $lang); ?></button></a>
<?php
        }
?>
                        </div>
<?php
    }            
?>

                        <div id="question_div">                        
                            <p style="font-size: 14px; margin-bottom: 5px;">Questions?</p>
                            <p style="font-size: 12px; color: rgba(71,141,200,1);margin-bottom: 5px;"><a href="tel:1-503-601-5251">(+1)503-601-5251</a><br><a href="mailto:info@voyagermed.com">info@voyagermed.com</a></p>
                        </div>

                        <div class="navbar-right pull-right" id="lang_div">                        
                            <select class="form-control" id="change_lang">
<?php
    if(!empty($langs)) {
        foreach($langs as $key => $val) {
            $set = ($key == $lang ? "selected='selected'" : '');
?>
                                <option value="<?php echo $key; ?>" <?php echo $set; ?>><?php echo $val; ?></option>
<?php
        }
    }
?>
                            </select>
                        </div>

                        <div class="navbar-right pull-right" id="search_nav">
                            <input class="form-control" id="doc_search" placeholder=" <?php echo TranslateText("Search for a doctor", 'en', $lang); ?>" value="" autocomplete="off">
                            
                            <!-- The div where the autocomplete results will be loaded -->
                            <div id="doc_autocomplete"></div>
                        </div>

                        <!-- Dropdown Menu Procedures -->
                        <div class="navbar-right dropdown pull-right">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" onclick="location.href='<?php echo $base_url; ?>about'">
                                <?php echo TranslateText("About", 'en', $lang); ?>
                            </button>
                        </div>

                        <!-- Dropdown Menu Doctors -->
                        <div class="navbar-right dropdown pull-right">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <?php echo TranslateText("Doctors", 'en', $lang); ?>
                            </button>
                            
                            <ul class="dropdown-menu">
<?php
    for($i=0;$i<count($docs);$i++) {
?>
                                <li><a href="<?php echo $base_url.'search/'.str_replace(' ', '-', strtolower($docs[$i])); ?>/all/"><?php echo $docs[$i]; ?></a></li>
<?php
    }
?>
                            </ul>
                        </div>

                        <!-- Dropdown Menu Procedures -->
                        <div class="navbar-right dropdown pull-right">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <?php echo TranslateText("Procedures", 'en', $lang); ?>
                            </button>
                            
                            <div class="dropdown-menu" id="procedure_dropdown">
<?php
    $cols = 4;
    
    for($i=0;$i<count($procedures);$i++) {    
?>                                          
                                <span class="procedure_name">
                                    <?php     
                                    echo ucwords(TranslateText($procedures[$i]['name'], 'en', 'lang'));     
                                    ?>
                                </span><br>

<?php
        $row_count = count($procedures[$i]['results']);
        $rows = ceil($row_count/$cols);
                
        for($x=0;$x<$rows;$x++) {      
?>
                                <div class="newrow">
<?php
            $start = $x*$cols;
            if($x < ($rows-1)) {
                $end = $start+$cols;
            } else {
                $end = $row_count;
            }
            
            for($y=$start;$y<$end;$y++) {   
?>
                                    <div class="col-lg-3">
                                        <a href="<?php echo $base_url.'search/'.str_replace(' ', '-', $procedures[$i]['results'][$y]).'/all/'; ?>"><?php echo TranslateText($procedures[$i]['results'][$y], 'en', $lang); ?></a>
                                    </div>  
<?php                
            }
?>
                                    <div class="clearfix"></div>
                                </div>
<?php
            
           
        }
         
?>

<?php
    }
?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </nav>
        </header>

<?php
    /*
    $sharethis_pub_key = TRUE;
    
    if($sharethis_pub_key) {
        $this->load->helper('sharethis_helper');
        echo '<div id="sthoverbuttons" class="sthoverbuttons-pos-left">';
        echo sharethis();
        echo '</div>';  
    }
    */

    // Display the sign in modal
    if(!$session) {
?>
        <div class="modal fade" id="signin_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <span id="modal_title"><?php echo TranslateText("Sign In", 'en', $lang); ?></span>
                        </h3>
                    </div>

                    <form method="POST" action="<?php echo $base_url; ?>users/signin" id="signin_form">
                        <div class="modal-body">
                            <input class="form-control" placeholder="Email" type="text" id="signin_email">

                            <div class="error_msg" id="valid">
                                <?php echo TranslateText("Please enter a valid email address", 'en', $lang); ?>
                            </div><br>

                            <input class="form-control" placeholder="Password" type="password" id="signin_pass">

                            <div class="error_msg" id="pass">
                                <?php echo TranslateText("Please enter a password", 'en', $lang); ?>
                            </div>

                            <div class="error_msg" id="invalid_combo">
                                <?php echo TranslateText("Incorrect username/password", 'en', $lang); ?>
                            </div>
                            
                            <span class="pull-right" id="signup_click" onclick="location.href='<?php echo $base_url; ?>signup'">Sign Up</span>
                            <span class="clearfix"></span>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><?php echo TranslateText("Sign In", 'en', $lang); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
     }
?>
        <!-- Variables for JS to work -->
        <div class="hidden" id="base_url"><?php echo $base_url; ?></div>

<?php
    // If $controller is search, open '#search-results-canvas' container
    // NOTE: opening tag is here, closing tag is inside a conditional in footer.php
    if($controller == 'search') {
?>
        <div id="search-reveal" class="navmenu navmenu-default navmenu-fixed-left hidden-sm hidden-md hidden-lg"></div>
        
        <div id="search-results-canvas">
<?php   
    }   
 ?>
     
        <main id="page-main" class="clearfix">