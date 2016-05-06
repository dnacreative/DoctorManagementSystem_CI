<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/doctors/';   

    if($procedure != 'everything') {
        if($count > 0) {
            for($i=0;$i<$end;$i++) {
                $result = $procedures['results'][$i];

                // Resize each pic
                $sizes = ResizePic($result['first'], $result['last'], 110);
?>

<script type="text/javascript">
    $(function() {          
        $('.star-p').each(function(){
           var $this = $(this);
           var mark = parseInt($this.find(".stars-mark").html());
           $this.find(".stars").html("<span></span>");
           $this.find(".stars").find("span").width(Math.max(0, mark * 16/20));   
        });     
    });
    
</script>

    <div class="profile_box media">
        <div class="pull-left">
            <a href="/doctors/<?php echo $result['first'].'-'.$result['last']; ?>" class="img_wrapper">
                <div class="clip">
                    <img class="media-object" src="<?php echo $base_url.$result['pic']; ?>" alt="<?php echo $result['first'].' '.$result['last']; ?>">
                </div>                 
            </a>
            
            <?php if($result['is_bme'] == '1'){ ?>
            <div class="doctor-bme-image-mobile">
                <img src="<?php echo $base_url . 'public/images/VoyagerMed Board of Medical Experts Award.png'; ?>">
            </div>
            <?php } ?>
        </div>

        <div class="media-body">
            <div class="row">  
                <h3 class="col-md-8 col-lg-9 media-heading">
                    <a href="/doctors/<?php echo $result['first'].'-'.$result['last']; ?>"><?php echo $result['first'].' '.$result['last']; ?></a>
                </h3>

                <div class="price col-md-4 col-lg-3 pull-right text-right">
<?php
            if($base_url == '' || $base_url == '/voyagermed/') {   //var_dump($base_url);exit;
                if($result['price'] > 0) {
?>
                    <span class="text-nowrap">
                        <i class="fa fa-usd"></i>
                        <?php echo number_format($result['price']).($result['is_avg'] ? ' <a data-toggle="tooltip" title="'.$tooltip.'">avg</a>' : ''); ?>
                    </span>
<?php
                    if(!$result['is_avg']) {
                        echo ' <small><span class="text-nowrap"><i class="fa fa-certificate" style="color:gold;"></i> VoyagerMed</span> Real&nbsp;Price</small>';
                    }
                }
            } else {
                if($session) {
                    if($result['price'] > 0) {
?>
                    <span class="text-nowrap">
                        <i class="fa fa-usd"></i>
                        <?php echo number_format($result['price']).($result['is_avg'] ? ' <a data-toggle="tooltip" title="'.$tooltip.'">avg</a>' : ''); ?>
                    </span>
<?php
                    }

                    if(!$result['is_avg']) {
                        echo ' <small><span class="text-nowrap"><i class="fa fa-certificate" style="color:gold;"></i> VoyagerMed</span> Real&nbsp;Price</small>';
                    }
                }
            }

            if($see_price) {   
                echo $procedures['results'][$i]['procedure'];
            }
?>
                </div>

                <div class="col-md-8 col-lg-9">
                    <p>
<?php 
            if(empty($result['bio'])) {
                echo TranslateText(GenerateBio($result['field']), $result, 'en', $lang);
            } else {
               echo TranslateText(substr($result['bio'], 0, 200), 'en', $lang).'...';  
            } 
?>
                    </p>

                    <p class="doctor-address">
                        <i class="fa fa-map-marker"></i> <!--<?php echo number_format($result['distance']); ?> miles away--> 
                        <?php echo $result['address'].', '.$result['city'].', '.$result['state']; ?>
                    </p>

                    <div class="star-p">
                        <span class="stars" style="float: left;"></span>
                        <span class="stars-mark" style="margin-left: 10px; display: none;"><?php if($result['rating']=='') echo 0; else echo $result['rating']; ?></span>                        
                    </div>
                </div>
                
                <?php if($result['is_bme'] == '1'){ ?>
                <div class="doctor-bme-image">
                    <img src="<?php echo $base_url . 'public/images/VoyagerMed Board of Medical Experts Award.png'; ?>">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
            }
?>
    <div id="append"></div>

    <!-- Write the procedure and location for the JS to work -->
    <div class="hidden" id="procedure"><?php echo $procedure; ?></div>
    <div class="hidden" id="first_lon"><?php echo $procedures['results'][0]['lon']; ?></div>
    <div class="hidden" id="first_lat"><?php echo $procedures['results'][0]['lat']; ?></div>
<?php
            if($page < ($pages-1)) {
?>
    <button class="btn btn-primary see_more" type="button" id="more_results"><?php echo TranslateText('See More', 'en', $this->session->userdata('lang')); ?></button>
<?php
            }
?>
<?php
        } else {
?>
    <div class="none">
        <?php echo TranslateText('Sorry, no results were found for '.$procedure, 'en', $lang); ?>
    </div>
<?php
        }
?>
    <script>
        var base_url = '/';
        var count = <?php if($count==null) echo 0; else echo $count; ?>;
        // console.log(count);
        $('#result_num span').text(count);

        $('#more_results').click(function(e) {
            e.preventDefault();
            var page = '<?php echo $page; ?>';
            var next_page = parseInt(page)+parseInt(1);
            
            var edu = [];
            var all = $('input[name=schools]');
            $.each(all, function(index, item) {
                // console.log($(item).attr('name'));

                if($(item).is(':checked')) {
                    edu.push($(item).val());
                }
            });

            var hosp = [];
            var all = $('input[name=hospitals]');
            $.each(all, function(index, item) {
                // console.log($(item).attr('name'));

                if($(item).is(':checked')) {
                    hosp.push($(item).val());
                }
            });

            var edu_str = edu.join(', ');
            var hosp_str = hosp.join(', ');

            var sort = '<?php echo $sort; ?>';
            var procedure = '<?php echo $procedure; ?>';
            var location = '<?php echo $location; ?>';
            var string = 'type='+ sort +'&procedure='+ procedure +'&location='+ location +'&page='+ next_page +'&hosp='+ hosp_str +'&edu='+ edu_str;

            // Load all of the results
            $('#append').html('<div class="ajax-loader"><i class="fa fa-circle-o-notch fa-3x fa-spin"></i></div>');
            $('#load_box').load(base_url +'search/Backend', string, function() {
                $('#append .ajax-loader').fadeOut(); 
            });
        });
    </script>
<?php
    } 
    else {
?>
    There is no performing doctors for <?php echo($proc_name);?>

<?php
    }
?>
