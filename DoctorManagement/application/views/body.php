<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    $img_url = $public_url.'images/';

    // Get the controller name
    $controller = $this->router->fetch_class();

    // Get the method
    $method = $this->router->fetch_method();
?>
    <section id="portfolio">
        <div class="container">
            <div class="box" style="padding: 10px 0;">
                <form method="GET" action="<?php echo $base_url; ?>procedures/search" name="search_procedures">
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Search" id="search" name="procedure">
                        <div class="autocomplete" id="autocomplete"></div>
                    </div>

                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location" id="locations" name="locations">
                        <div class="autocomplete" id="autocomplete_locations"></div>
                    </div>

                    <div class="col-lg-2">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit" style="width: 100%;">Search</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="box">
                        <div id="google_maps"></div>
                    </div>
                </form>
            </div>
        </div>
    </section>