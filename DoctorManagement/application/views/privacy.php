<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
    
    // Define the privacy block of text
    $privacy = "The only information that VoyagerMed obtains about individual visitors to its website is that supplied voluntarily by visitors. You grant the site the right to transmit, monitor, retrieve, store and use your information in connection with the operation of the site.
				VoyagerMed employs strict security measures to safeguard online communications; personal information is stored in a secure database.
				In order to provide visitors with other valuable information, VoyagerMed may provide links to third-party sites. However, VoyagerMed exercises no authority over third-party sites, each of which maintains independent privacy and data collection policies and procedures.
				We do not warrant or represent that the information submitted to the site will be protected against, loss, misuse, or alteration by third parties.
				VoyagerMed assumes no responsibility or liability for these independent methods or actions and is not responsible for the independent policies or procedures of destination sites. The site cannot and does not assume responsibility or liability for any information you submit to the site or for third parties’ use or misuse of information transmitted or received from this site.
				You are responsible for taking all reasonable steps to ensure that no unauthorized person shall have access to your site password or account. It is your sole responsibility to (1) control the dissemination and use of activation codes and passwords; (2) authorize, monitor and control access to and use of your site account and password; and (3) promptly inform the site of any need to deactivate a password.
				These destination links are provided only for your convenience and, as such, you access them at your own risk. However, VoyagerMed wishes to assure the integrity of its site and its destination links, so any comments pertaining to our site or any sites accessed through our site links are greatly appreciated.";
?>
		<div class="container" id="login_box">
			<h2>
                <?php echo TranslateText("Privacy Policy", 'en', $lang); ?>
			</h2>

			<p>
				<?php echo TranslateText($privacy, 'en', $lang); ?>
			</p>
		</div>
