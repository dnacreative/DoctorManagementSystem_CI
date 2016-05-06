<?php
    $base_url = $this->config->base_url(); 
    $public_url = $base_url.'public/';
                                    
?>
    <div style="max-width: 1170px; margin: 0 auto;">
        <div class="col-xs-12" style="margin-top:15px">                    
            <h2> Find right Doctor anywhere in the world  </h2>
            <div style="padding: 30px;background-color: #eee;">
                <form method="GET" action="https://voyagermed.com/search" class="search-form" id="search-form">
                    <div class="container-fluid">
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="search_input" name="procedure" placeholder="What kind of procedure do you need?">
                            <div id="autocomplete" class="autocomplete"></div>
                        </div>

                        <div class="col-md-5">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Where do you want to go?">
                            <div id="autocomplete_locations" class="autocomplete"></div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>            
            </div>
        </div>
        
        <div class="col-xs-12 col-md-8 col-lg-8 search-block">
            <h3>Find Doctors By Specialty </h3>  
            <br>
            <div class="clearfix">
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/Cancer/all/distance-desc"> Oncology </a> </li>
                    <li> <a href="/search/Dental/all/distance-desc"> Dental </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3"> 
                    <li> <a href="/search/Fertility/all/distance-desc"> Fertility </a> </li>
                    <li> <a href="/search/Heart/all/distance-desc"> Heart </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/Orthopedic/all/distance-desc"> Orthopedics </a> </li>
                    <li> <a href="/search/Plastic-Surgery/all/distance-desc"> Plastic Surgery </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/Spine/all/distance-desc"> Spine </a> </li>                    
                </ul>
            </div>
        </div>            
                      
        <div class="col-xs-12 col-md-8 col-lg-8 search-block">
            <h3>Find Doctors By Treatment</h3>  
            <br>
            <div class="clearfix">
            <?php    
                $count = ceil($procedures['count'] / 4); 
                for($i=0;$i<4;$i++){
            ?>
                <ul class="col-xs-12 col-md-6 col-lg-3">
            
                <?php                                        
                    
                    for($j=$i*$count;$j<$i*$count + $count;$j++)
                    {
                        $p_name = $procedures['data'][$j]['name'];
                        $p_name1 = str_replace(' ', '-', $p_name);
                ?>                   
                    <li> <a href="/search/<?php echo $p_name1; ?>/all/distance-desc"> <?php echo $p_name; ?> </a> </li>
                <?php
                    }
                ?>
                </ul>
            <?php } ?> 
            </div>               
        </div>            
                
                    
        <div class="col-xs-12 col-md-8 col-lg-8 search-block">
            <h3>Find Doctors By City </h3>  
            <br>
            <div class="clearfix">
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/Atlanta-GA/distance-desc"> Atlanta </a> </li>
                    <li> <a href="/search/all/Baltimore-MD/distance-desc"> Baltimore </a> </li>
                    <li> <a href="/search/all/Beverly-Hills-CA/distance-desc"> Beverly Hills </a> </li>
                    <li> <a href="/search/all/Boston-MA/distance-desc"> Boston </a> </li>
                    <li> <a href="/search/all/Charlotte-NC/distance-desc"> Charlotte </a> </li>
                    <li> <a href="/search/all/Chicago-IL/distance-desc"> Chicago </a> </li>
                    <li> <a href="/search/all/Cincinnati-OH/distance-desc"> Cincinnati </a> </li>
                    <li> <a href="/search/all/Cleveland-OH/distance-desc"> Cleveland </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3"> 
                    <li> <a href="/search/all/Dallas-TX/distance-desc"> Dallas </a> </li>
                    <li> <a href="/search/all/Denver-CO/distance-desc"> Denver </a> </li>
                    <li> <a href="/search/all/Durham-NC/distance-desc"> Durham </a> </li>
                    <li> <a href="/search/all/Houston-TX/distance-desc"> Houston </a> </li>
                    <li> <a href="/search/all/Las-Vegas-NV/distance-desc"> Las Vegas </a> </li>
                    <li> <a href="/search/all/Los-Angeles-CA/distance-desc"> Los Angeles </a> </li>
                    <li> <a href="/search/all/Miami-FL/distance-desc"> Miami </a> </li>
                    <li> <a href="/search/all/Minneapolis-MN/distance-desc"> Minneapolis </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/New-York-NY/distance-desc"> New York City </a> </li>
                    <li> <a href="/search/all/Oklahoma-City-OK/distance-desc"> Oklahoma City </a> </li>
                    <li> <a href="/search/all/Orlando-FL/distance-desc"> Orlando </a> </li>
                    <li> <a href="/search/all/Philadelphia-PA/distance-desc"> Philadelphia </a> </li>
                    <li> <a href="/search/all/Phoenix-AZ/distance-desc"> Poenix </a> </li>
                    <li> <a href="/search/all/Pittsburgh-PA/distance-desc"> Pittsburgh </a> </li>
                    <li> <a href="/search/all/Portland-OR/distance-desc"> Portland </a> </li>
                    <li> <a href="/search/all/Raleigh-NC/distance-desc"> Raleigh </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/San-Diego-CA/distance-desc"> San Diego </a> </li>     
                    <li> <a href="/search/all/San-Francisco-CA/distance-desc"> San Francisco </a> </li>
                    <li> <a href="/search/all/Seattle-WA/distance-desc"> Seattle </a> </li>
                    <li> <a href="/search/all/St-Louis-MO/distance-desc"> St. Louis </a> </li>
                    <li> <a href="/search/all/Washington-DC/distance-desc"> Washington DC </a> </li>                    
                </ul>
            </div>
        </div>            
        
                   
        <div class="col-xs-12 col-md-8 col-lg-8 search-block">
            <h3>Find Doctors by State </h3>  
            <br>
            <div class="clearfix">
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/all-AL/distance-desc"> Alabama </a> </li>
                    <li> <a href="/search/all/all-AK/distance-desc"> Alaska </a> </li>
                    <li> <a href="/search/all/all-AZ/distance-desc"> Arizona </a> </li>
                    <li> <a href="/search/all/all-AR/distance-desc"> Arkansas </a> </li>
                    <li> <a href="/search/all/all-CA/distance-desc"> California </a> </li>
                    <li> <a href="/search/all/all-CO/distance-desc"> Colorado </a> </li>
                    <li> <a href="/search/all/all-CT/distance-desc"> Connecticut </a> </li>
                    <li> <a href="/search/all/all-DE/distance-desc"> Delaware </a> </li>
                    <li> <a href="/search/all/all-FL/distance-desc"> Florida </a> </li>
                    <li> <a href="/search/all/all-GA/distance-desc"> Georgia </a> </li>
                    <li> <a href="/search/all/all-HI/distance-desc"> Hawaii </a> </li>
                    <li> <a href="/search/all/all-ID/distance-desc"> Idaho </a> </li>
                    <li> <a href="/search/all/all-IL/distance-desc"> Illinois </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3"> 
                    <li> <a href="/search/all/all-IN/distance-desc"> Indiana </a> </li>
                    <li> <a href="/search/all/all-IA/distance-desc"> Iowa </a> </li>
                    <li> <a href="/search/all/all-KS/distance-desc"> Kansas </a> </li>
                    <li> <a href="/search/all/all-KY/distance-desc"> Kentucky </a> </li>
                    <li> <a href="/search/all/all-LA/distance-desc"> Louisiana </a> </li>
                    <li> <a href="/search/all/all-ME/distance-desc"> Maine </a> </li>
                    <li> <a href="/search/all/all-MD/distance-desc"> Maryland </a> </li>
                    <li> <a href="/search/all/all-MA/distance-desc"> Massachusetts </a> </li>
                    <li> <a href="/search/all/all-MI/distance-desc"> Michigan </a> </li>
                    <li> <a href="/search/all/all-MN/distance-desc"> Minnesota </a> </li>
                    <li> <a href="/search/all/all-MS/distance-desc"> Mississippi </a> </li>
                    <li> <a href="/search/all/all-MO/distance-desc"> Missouri </a> </li>
                    <li> <a href="/search/all/all-MT/distance-desc"> Montana </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/all-NE/distance-desc"> Nebraska </a> </li>
                    <li> <a href="/search/all/all-NV/distance-desc"> Nevada </a> </li>
                    <li> <a href="/search/all/all-NH/distance-desc"> New Hampshire </a> </li>
                    <li> <a href="/search/all/all-NJ/distance-desc"> New Jersey </a> </li>
                    <li> <a href="/search/all/all-NM/distance-desc"> New Mexico </a> </li>
                    <li> <a href="/search/all/all-NY/distance-desc"> New York </a> </li>
                    <li> <a href="/search/all/all-NC/distance-desc"> North Carolina </a> </li>
                    <li> <a href="/search/all/all-ND/distance-desc"> North Dakota </a> </li>
                    <li> <a href="/search/all/all-OH/distance-desc"> Ohio </a> </li>
                    <li> <a href="/search/all/all-OK/distance-desc"> Oklahoma </a> </li>
                    <li> <a href="/search/all/all-OR/distance-desc"> Oregon </a> </li>
                    <li> <a href="/search/all/all-PA/distance-desc"> Pennsylvania </a> </li>
                    <li> <a href="/search/all/all-/distance-desc"> Puerto Rico </a> </li>
                </ul>
                <ul class="col-xs-6 col-md-3">
                    <li> <a href="/search/all/all-RI/distance-desc"> Rhode Island </a> </li>   
                    <li> <a href="/search/all/all-SC/distance-desc"> South Carolina </a> </li>
                    <li> <a href="/search/all/all-SD/distance-desc"> South Dakota </a> </li>
                    <li> <a href="/search/all/all-TN/distance-desc"> Tennessee </a> </li>
                    <li> <a href="/search/all/all-TX/distance-desc"> Texas </a> </li>
                    <li> <a href="/search/all/all-UT/distance-desc"> Utah </a> </li>
                    <li> <a href="/search/all/all-VT/distance-desc"> Vermont </a> </li>
                    <li> <a href="/search/all/all-VA/distance-desc"> Virginia </a> </li>
                    <li> <a href="/search/all/all-WA/distance-desc"> Washington </a> </li>
                    <li> <a href="/search/all/all-DC/distance-desc"> Washington DC </a> </li>
                    <li> <a href="/search/all/all-WV/distance-desc"> West Virginia </a> </li>
                    <li> <a href="/search/all/all-WI/distance-desc"> Wisconsin </a> </li>
                    <li> <a href="/search/all/all-WY/distance-desc"> Wyoming  </a> </li>                                     
                </ul>
            </div>
        </div>            
        
    </div>

  

