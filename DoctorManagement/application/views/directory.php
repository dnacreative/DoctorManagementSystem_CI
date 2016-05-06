<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
		<div class="container" id="login_box">
				<img id = "browse_img" width="575" height="367" src="/public/images/doctor_teacher_group_2_5_0.png"></img>

				<h1>Doctors</h1>
				<h3 id="dox_directory_about">Choosing a doctor isn't always easy, especially when looking for life-changing treatment. Our doctors are some of the best out there. We've selected highly-qualified physicians to participate in our network of practitioners, which
				consists of the top doctors the U.S. has to offer. These doctors consist of leading professionals who participate in the following
				specialties: Cardiology, <a href="https://voyagermed.com/search/Dental/all">Cosmetic Dentistry</a>, Oncology, <a href="https://voyagermed.com/search/Orthopedic/all">Orthopedic Surgery</a>, <a href="https://voyagermed.com/search/Plastic-Surgery/all">Plastic Surgery</a>, Reproductive Medicine, <a href="https://voyagermed.com/search/Spine/all">Spinal Cord Injury Medicine</a> and Thoracic Surgery.</h3>
			<h2>Search by name:</h2>
				<form id="search_by_name_form">
					<input id="doc_search_name" value="" type="text" placeholder="Search Doctors..." required>
                    <input id="doc_search_name_btn" type="button" value="Search">       
                    <div id="doc_autocomplete_name"></div>             
				</form>
			<br>
			<h2>
				Sort by last name:
			</h2>

			<ul id="letter_list">
<?php
	for($i=0;$i<count($letters);$i++) {
		if($letters[$i] == $letter) {
			$class = 'active';
		} else {
			$class = '';
		}
?>

			<!--fized navigation so letters are displayed in uppercase and spaced out better -->

				<li><a href="" class="browse_letter_link <?php echo $class; ?>" data-letter="<?php echo($letters[$i]);?>"><?php echo strtoupper($letters[$i]); ?> </a></li>
<?php
	}
?>
				
			</ul>

			<!--javascript needs to be fixed to navigate between the different letters [A-Z] -->
				<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js">

					var browse_letter = $("#browse_letter_link");

					$(document).ready(function(){
						$("#browse_letter_link a").click(function(e){
							e.preventdefault();
								$.ajax({
								url: base_url+"doctors/browse",
								data: {
									letter: letter
								},
								success: function(data){
									$("#browse_letter_link").class("active");
								}
								
							});

						});
					});
				</script>
			</ul>
            <div class="ajax-loader">
                <i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
            </div>
            
			<div id="load_box">
                
            </div>
            
		</div>
