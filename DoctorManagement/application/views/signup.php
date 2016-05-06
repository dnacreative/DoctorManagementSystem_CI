<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';
?>
        <div id="signup_main">
            <div id="signup_columns">
                <div id="login_box">
                    <h2>
        				<?php echo TranslateText('Create an Account', 'en', $lang); ?>
        			</h2>

        			 <div id="signup_fill">
                         <form method="POST" action="<?php echo $base_url; ?>" id="signup_form">
                            <input class="form-control" placeholder="Email" type="text" id="signin_email">

                            <!-- Email error -->
                            <div class="error_msg" id="signup_valid">
                                <?php echo TranslateText("Please enter a valid email address", 'en', $lang); ?>
                            </div><br>

                            <input class="form-control" placeholder="Password" type="password" id="signin_pass">
                                
                            <!-- Password error -->
                            <div id="signup_pass">
                                *<?php echo TranslateText("Password must be 6 characters or more", 'en', $lang); ?>
                            </div><br>

                            <input class="form-control" placeholder="Confirm Password" type="password" id="signin_confirm">

                            <!-- Incorrect login error -->
                            <div class="error_msg" id="signup_invalid_combo">
                                Incorrect username/password
                                <?php echo TranslateText("Incorrect username/password", 'en', $lang); ?>
                            </div>

                            <!-- Confirm error -->
                            <div class="error_msg" id="signup_confirm">
                                <b><?php echo TranslateText("Your passwords don't match", 'en', $lang); ?></b>
                            </div><br>

                            <input type="checkbox" value="voyagernews"> <?php echo TranslateText("Send me updates from VoyagerMed News", 'en', $lang); ?>
                            <br>
                            <input type="checkbox" value-"voyagerblod"> <?php echo TranslateText("Subscribe to VoyagerMed's Official Blog", 'en', $lang); ?>
                            <br><br>

                            <button class="btn btn-primary" type="submit"><?php echo TranslateText("Sign Up", 'en', $lang); ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
        		</div>
            </div>

            <div id="signup_columns">
                <div id="signHeader">
                    <b>
                        <h2>
                            <?php echo TranslateText("Why Sign Up?", 'en', $lang); ?>
                        </h2>
                    </b>
                </div>
                <div class="transText">
                    <p>
                        <?php echo TranslateText("Creating an account on VoyagerMed allows you to gain access to our 'Real Price' feature for the feature you're looking for", 'en', $lang); ?>
                    </p><br>

                    <p>
                        <?php echo TranslateText("Here are some specific benefits", 'en', $lang); ?>:
                    </p>

                    <ul>
                        <li>One</li>
                        <li>Two</li>
                        <li>Three</li>
                        <li>Four</li>
                        <li>Five</li>
                    </ul>
                </div>

                <div id="signHeader">
                    <b>
                        <h2>
                            <?php echo TranslateText("Already have an Account?", 'en', $lang); ?>
                        </h2>
                    </b>
                </div>

                <div class="container" id="login_box">
                    <form method="POST"action="<?php echo $base_url; ?>" id="login_form">
                        <input class="form-control" placeholder="<?php echo TranslateText("Email", 'en', $lang); ?>" type="text" id="signin_email"><br>
                        <input class="form-control" placeholder="<?php echo TranslateText("Password", 'en', $lang); ?>" type="password" id="signin_pass"><br>

                        <!-- Incorrect login error -->
                        <div class="error_msg" id="signup_invalid_combo">
                            <?php echo TranslateText("Incorrect username/password", 'en', $lang); ?>
                        </div>

                        <button class="btn btn-primary" type="submit"><?php echo TranslateText("Sign In", 'en', $lang); ?></button>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
