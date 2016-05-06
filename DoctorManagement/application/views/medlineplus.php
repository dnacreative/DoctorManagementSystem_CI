<?php
    $base_url = $this->config->base_url(); 
    $public_url = $base_url.'public/';
                                    
?>
    <div id="search-reveal-toggle" class="navbar navbar-default navbar-fixed-top hidden-sm hidden-md hidden-lg">
        <button data-canvas="#search-results-canvas" data-target="#search-reveal" data-recalc="false" data-toggle="offcanvas" class="navbar-toggle" type="button">
            <i class="fa fa-search"></i>
        </button>
        <h2>
            <?php echo TranslateText('Search', 'en', $lang); ?>
        </h2>
    </div>

    <div class="container" id="main_part">
        <div class="row">
            <div class="col-sm-4 col-md-3" id="fixed_side">
                <div id="fixed_bar_shim">
                    <div id="fixed_bar" class="hidden-xs">
                        <h1 id="search_name">
                            <?php echo $header; ?>
                        </h1>
                        <br>
                        <div id="search_box">
                            <h2>
                                <i class="fa fa-search"></i> <?php echo TranslateText('Search', 'en', $lang); ?>
                            </h2>

                            <div>
                                <form method="GET" action="<?php echo $base_url; ?>search" name="search_procedures" id="search_procedures">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="<?php echo TranslateText('Search', 'en', $lang); ?>" id="search_input" name="procedure" value="<?php echo $procedure; ?>">
                                        <div class="autocomplete" id="autocomplete"></div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Location" id="location" name="state" value="<?php echo $loc_text; ?>">
                                        <div class="autocomplete" id="autocomplete_locations"></div>
                                    </div>

                                    <button class="btn btn-primary" type="submit" name="submit" value="submit" style="width: 100%;"><?php echo TranslateText('Search', 'en', $lang); ?></button>
                                </form>
                            </div>
                        </div>
<?php                    
    // Display the filters
    if($id && $count > 0) {      
?>
        <?php 
            if (!$max_distance) $max_distance = 1;  
            if (!$max_price) $max_price = 1;
        ?>
        
        <?php if($distance_price && $max_price) { ?>
        <br>
        <div style="position: relative; border: solid 1px #ddd;border-radius: 6px;">
            <div style=" padding: 8px; font-size: 18px; border-bottom: solid 1px #ddd; text-transform: uppercase; background: #f0f0f0; ">
                <?php echo TranslateText('Price', 'en', $lang); ?>
            </div>
            <div style="padding: 10px;">
                <input type="text" id="price" value="" name="price" />
            </div>

        </div>
        <?php } ?>
        <br>
        <?php if($distance_filter && $max_distance) { ?>
        <div style="position: relative; border: solid 1px #ddd;border-radius: 6px;">
            <div style=" padding: 8px; font-size: 18px; border-bottom: solid 1px #ddd; text-transform: uppercase; background: #f0f0f0; ">
                <?php echo TranslateText('Distance', 'en', $lang); ?>
            </div>
            <div style="padding: 10px;">
                <input type="text" id="distance" value="" name="distance" />
            </div>

        </div>
        <?php } ?> 
        <script>
            $script.ready(['matchMedia', 'ssm', 'jQuery'],function() {
                $(function () {

                    <?php if($distance_filter && $max_distance) { ?>
                    $("#distance").ionRangeSlider({
                        hide_min_max: true,
                        keyboard: true,
                        min: 0,
                        max: <?=$max_distance?>,
                        type: 'double',
                        step: 1,
                        prefix: "",
                        grid: true,
                        onFinish: function (data) {
                            var price = $("#price").val().split(";");
                            var from = price[0];
                            var to = price[1];

                            var distance_from = data.from;
                            var distance_to = data.to;

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
                            var val = $('#sort_by').val();
                            var procedure = $('#search_input').val();
                            var location = $('#location').val();
                            var price = '';

                            // If the user hasn't selected any states, then set the 'all' variable to 'everywhere'
                            if(location == '' || location == ',') {
                                var location = 'all';
                            }
                            // If search-reveal is open, hide it
                            if($('#search-reveal').hasClass('in')) {
                                $('#search-reveal').offcanvas('hide');
                            }
                            $('#search-reveal').offcanvas('hide');
                            $('#load_box').html('<div class="ajax-loader"><i class="fa fa-circle-o-notch fa-3x fa-spin"></i></div>');
                            var string = 'type='+ val +'&procedure='+ procedure +'&location='+ location + '&page=0&edu='+ edu_str +'&hosp='+ hosp_str + "&from=" + from + "&to=" + to  + "&distance_from=" + distance_from + "&distance_to=" + distance_to ;
                            $('#load_box').load('<?=$base_url?>' +'search/Backend', encodeURI(string), function() {
                                $('.ajax-loader').fadeOut();
                                $('body').css('overflow', 'visible');
                            });
                        }
                    });
                    <?php } ?>

                    <?php if($distance_price && $max_price) { ?>
                    $("#price").ionRangeSlider({
                        hide_min_max: true,
                        keyboard: true,
                        min: 0,
                        max: <?=$max_price?>,
                        type: 'double',
                        step: 1,
                        prefix: "$",
                        grid: true,
                        onFinish: function (data) {
                            <?php if($distance_filter) { ?>
                            var distance = $("#distance").val().split(";");
                            var distance_from = distance[0];
                            var distance_to = distance[1];
                            <?php } ?>

                            var from = data.from;
                            var to = data.to;
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
                            var val = $('#sort_by').val();
                            var procedure = $('#search_input').val();
                            var location = $('#location').val();
                            var price = '';

                            // If the user hasn't selected any states, then set the 'all' variable to 'everywhere'
                            if(location == '' || location == ',') {
                                var location = 'all';
                            }
                            // If search-reveal is open, hide it
                            if($('#search-reveal').hasClass('in')) {
                                $('#search-reveal').offcanvas('hide');
                            }
                            $('#search-reveal').offcanvas('hide');
                            $('#load_box').html('<div class="ajax-loader"><i class="fa fa-circle-o-notch fa-3x fa-spin"></i></div>');

                            <?php if($distance_filter) : ?>
                            var string = 'type='+ val +'&procedure='+ procedure +'&location='+ location + '&page=0&edu='+ edu_str +'&hosp='+ hosp_str + "&from=" + from + "&to=" + to  + "&distance_from=" + distance_from + "&distance_to=" + distance_to ;
                            <?php else : ?>
                            var string = 'type='+ val +'&procedure='+ procedure +'&location='+ location + '&page=0&edu='+ edu_str +'&hosp='+ hosp_str + "&from=" + from + "&to=" + to;
                            <?php endif; ?>
                            $('#load_box').load('<?=$base_url?>' +'search/Backend', encodeURI(string), function() {
                                $('.ajax-loader').fadeOut();
                                $('body').css('overflow', 'visible');
                            });
                        }
                    });
                    <?php } ?>
                });
            });
        </script>

                        <div id="filter_box">
<?php
        foreach($filters as $key => $val) {
?>
                            <div class="header">
                                <?php echo TranslateText($key, 'en', $this->session->userdata('lang')); ?>
                                <span class="pull-right" data-toggle="modal" data-target="#<?php echo $key; ?>_modal"><?php echo TranslateText('See all', 'en', $lang); ?></span>
                            </div>

<?php
            $end = (count($val) < 4 ? count($val) : 4);           
            for($i=0;$i<$end;$i++) {
?>
                            <span name="<?php echo $key; ?>">
                                <input type="checkbox" name="<?php echo $key; ?>" value="<?php echo trim($val[$i]['name']); ?>">
                                <?php echo trim($val[$i]['name']); ?>
                            </span>
<?php
            }
        }
?>
                        </div>
<?php
    }
?>
                    </div>

                    <!--
                    <div id="price_box">
                        <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                        
                        <p>
                            Price
                        </p>
                    </div>
                    -->
                </div>
            </div>

            <div class="col-sm-8 col-md-9" id="right_box">
                
                <div id="results-summary" class="clearfix">
<?php
    // Display the result count
    if($id) {
?>
                    <div class="pull-left help-block" id="result_num">
                        <?php echo TranslateText('Total Results', 'en', $lang); ?>: <span class="count"></span>
                    </div>

                    <!-- Sort Filter -->
                    <div class="pull-right">
                        <select class="form-control" id="sort_by">
                            <option value="<?php echo $sorts[$spot]; ?>"><?php echo ucwords(TranslateText($sorts[$spot], 'en', $this->session->userdata('lang'))); ?></option>
<?php
        for($i=0;$i<count($sorts);$i++) {
            if($i != $spot) {
?>
                            <option value="<?php echo $sorts[$i]; ?>"><?php echo ucwords(TranslateText($sorts[$i], 'en', $this->session->userdata('lang'))); ?></option>
<?php
            }
        }
?>
                        </select>
                    </div>

                    <div class="clearfix"></div>
<?php
    }
?>
                </div>

                <!-- The box where the results will be loaded -->
                <div id="load_box">
                    <div class="ajax-loader">
                        <i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

<?php
    foreach($filters as $key => $val) {
?>
    <div class="modal fade" id="<?php echo $key; ?>_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h3 class="modal-title">
                        <?php echo TranslateText('All', 'en', $lang); ?> <?php echo $key; ?>
                    </h3>
                </div>

                <div class="modal-body">
<?php
        for($i=0;$i<count($val);$i++) {
?>
                    <span name="<?php echo $key; ?>">
                        
                        <input type="checkbox" name="<?php echo $key; ?>" value="<?php echo trim($val[$i]['name']); ?>">
                        <?php echo trim($val[$i]['name']).' ('.$val[$i]['count'].')'; ?><br>
                    </span>
<?php
        }
?>
                </div>

                <div class="modal-footer">
                
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>

<!-- Save the states info for the JS to work -->
<div class="hidden" id="location_text"><?php echo $location; ?></div>
<div class="hidden" id="procedure_text"><?php echo str_replace(' ', '-', urldecode($procedure)); ?></div>

<!--
<script src="<?php echo $base_url; ?>public/js/slider.js"></script>
<script>
    var slider = new Slider('#ex1', {
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });
</script>
-->
