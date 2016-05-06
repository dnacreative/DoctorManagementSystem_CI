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
            <div class="col-sm-7 col-md-8" id="right_box">
                <div id="procedure_desc">
                    <h3> <?php echo $procedure; ?></h3>
                    <br>
                    <?php echo($proc_desc);?>
                </div>
                
                <div id="load_box">
                    <h3> <?php echo $procedure; ?></h3>    
                    <div class="ajax-loader">
                        <i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-5 col-md-4" id="fixed_side">
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
                                <form method="GET" action="<?php echo $base_url; ?>procedures" name="search_procedures" id="search_procedures">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="<?php echo TranslateText('Search', 'en', $lang); ?>" id="search_input" name="procedure" value="<?php echo $procedure; ?>">
                                        <div class="autocomplete" id="autocomplete"></div>
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="submit" value="submit" style="width: 100%;"><?php echo TranslateText('Search', 'en', $lang); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Doctors -->
                <div id="doctors_box">
                    <h3>
                        <?php echo TranslateText('Doctors performing ' . $procedure, 'en', $lang); ?>
                    </h3>

                    <div class="sidebar bg">
                        <div id="doctors_load">
                            <div class="ajax-loader"><i class="fa fa-cog fa-3x fa-spin"></i></div>
                        </div>
                    </div>
                </div>
                
            </div>
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

