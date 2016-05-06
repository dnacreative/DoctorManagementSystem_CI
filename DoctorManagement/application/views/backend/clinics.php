<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/misc/doctor_pics/';

    // Define the number of results
    $count = count($clinics);

    if($count > 0) {
        $per_page = 10;
        $pages = ceil($count/$per_page);

        // Define the starting and ending points
        $start = $page*$per_page;

        if($page == ($pages-1)) {
            $mod = $count%$per_page;

            if($mod > 0) {
                $end = $start+$mod;
            } else {
                $end = $start+$per_page;
            }
        } else {
            $end = $start+$per_page;
        }
?>
    <p>
        Showing results 1 - <?php echo $end.' of '.number_format($count); ?>
    </p>
<?php
        // Set the size for each image
        $size = 120;

        for($i=0;$i<$end;$i++) {
            if($i == 0) {
                $line_style = "border-top: solid 1px #ddd;";
            } else {
                $line_style = NULL;
            }

            $id = $clinics[$i]['id'];
            $name = $clinics[$i]['name'];
            $address = $clinics[$i]['address'];
            $city = $clinics[$i]['city'];
            $state = $clinics[$i]['state'];
            $full_rank = $clinics[$i]['full_rank'];
            $national_rank = $clinics[$i]['national_rank'];
            $score = $clinics[$i]['score'];
            $visitor_rank = $clinics[$i]['visitor_rank'];
?>
    <div class="profile_box" style="<?php echo $line_style; ?>">
        <!--
        <div class="img_wrapper">
            <img src="<?php echo $img; ?>" width="<?php echo $new_width; ?>" height="<?php echo $new_height; ?>" alt="<?php echo $name; ?>" style="<?php echo $style; ?>"/>
        </div>
        -->

        <div class="info_box pull-left"> 
            <h3 class="sub_info">
                <a href="<?php echo $base_url; ?>doctors/<?php echo $id; ?>"><?php echo $name; ?></a>
            </h3>

            <span class="sub_info"><?php echo $city.', '.$state; ?></span>
            <span class="sub_info"><b>Full Rank:</b> <?php echo $full_rank; ?></span>
            <span class="sub_info"><b>National Rank:</b> <?php echo $national_rank; ?></span>
            <span class="sub_info"><b>Visitor Rank:</b> <?php echo $visitor_rank; ?></span>
            <span class="sub_info"><b>Score:</b> <?php echo $score; ?></span>
        </div>

        <div class="clearfix"></div>

        <button class="btn btn-primary pull-right" type="button">Learn more</button>

        <div class="clearfix"></div>
    </div>
<?php
        }

        if($page < ($pages-1)) {
?>
    <button class="btn btn-primary see_more" type="button" id="more_results">See More</button>

    <script>
        var base_url = $('#base_url').text();

        $('#more_results').click(function() {
            var page = '<?php echo $page; ?>';
            var next_page = page+parseInt(1);
            var string = 'page='+ next_page;
            console.log(next_page);

            // Load all of the results
            $('#load_box').load(base_url +'clinics/Backend', string);
        }); 
    </script>
<?php
        }
    } else {
?>
    <div class="none">
        There are no results
    </div>
<?php
    }
?>