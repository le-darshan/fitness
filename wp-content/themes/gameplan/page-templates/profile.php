<?php
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */

/* Get user info. */

global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) ) 
	  
        update_user_meta( $current_user->ID, 'user_url', esc_url( $_POST['url'] ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['gender'] ) )
        update_user_meta($current_user->ID, 'gender', esc_attr( $_POST['gender'] ) );
	if ( !empty( $_POST['country'] ) )
        update_user_meta($current_user->ID, 'country', esc_attr( $_POST['country'] ) );
	if ( !empty( $_POST['town'] ) )
        update_user_meta($current_user->ID, 'town', esc_attr( $_POST['town'] ) );
	if ( !empty( $_POST['phone'] ) )
        update_user_meta($current_user->ID, 'phone', esc_attr( $_POST['phone'] ) );
	if ( !empty( $_POST['user_url'] ) )
        update_user_meta($current_user->ID, 'user_url', esc_attr( $_POST['user_url'] ) );
	if ( !empty( $_POST['user_email'] ) )
        update_user_meta($current_user->ID, 'user_email', esc_attr( $_POST['user_email'] ) );
    if ( !empty( $_POST['food'] ) )
        update_user_meta($current_user->ID, 'food', esc_attr( $_POST['food'] ) );
	if ( !empty( $_POST['exercise'] ) )
        update_user_meta($current_user->ID, 'exercise', esc_attr( $_POST['exercise'] ) );
	if ( !empty( $_POST['quote'] ) )
        update_user_meta($current_user->ID, 'quote', esc_attr( $_POST['quote'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    if ( !empty( $_POST['birth_date'] ) )
        update_user_meta( $current_user->ID, 'birth_date', esc_attr( $_POST['birth_date'] ) );
	if ( !empty( $_POST['telephone'] ) )
        update_user_meta( $current_user->ID, 'telephone', esc_attr( $_POST['telephone'] ) ); 
		 
	
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect(" http://cleaverfitness.com/user-view-profile/ ");
        exit;
    }
}

get_header();?>

<script type="text/javascript">
jQuery(document).ready(function ($) {
 
 $( "#datepicker" ).datepicker({  maxDate: new Date() });

});
</script>

<div class="bg-container single-post-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
	    <div class="background-color"><!----></div> 
    		<div class="container">
				<div class="container-pad">
					<div class="row-fluid">
					<div class="vc_col-sm-12 wpb_column vc_column_container">
				<div class="wpb_wrapper">
						<div class="box-style-1 heading-shortcode" id="heading-id16872">
							<div class="module-title">
								<h2 class="title def_style" style="color:  !important">
									<span>
										<span class="firstword" style="color:  !important"><?php the_title();?></span>
									</span>
								</h2>
							</div>
						</div>
					</div> 
				</div>
						<div class="span6">
							<?php
								 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								    <div id="post-<?php the_ID(); ?>">
								        <div class="entry-content entry">
								            <?php the_content(); ?>
									            <?php if ( !is_user_logged_in() ) : ?>
												
								                    <p class="warning">
								                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
								                    </p><!-- .warning -->
									            <?php else : ?>
												
								                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
				
									                <form method="post" id="adduser" action="<?php the_permalink(); ?>" class="form-group " enctype="multipart/form-data">

       									         	    <p class="form-username form-group">
															<label for="first-name"><?php _e('First Name', 'profile'); ?></label>
															<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( "first_name", $current_user->ID ); ?>" />
								                    	</p><!-- .form-username -->
														
														<p class="form-username form-group">
															<label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
															<input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>"  />
														</p><!-- .form-username -->
														
														<p class="form-bdate form-group">
															<label for="last-name"><?php _e('Date of birth', 'profile'); ?></label>
															<input type="text" class="text-input" id="datepicker" name="birth_date" / value="<?php the_author_meta( 'birth_date', $current_user->ID ); ?>"  />
														</p>
														
														<p class="form-gender form-group">
															<label for="gender"><?php _e('Gender', 'profile'); ?></label>
															<select class="text-input" name="gender" id="gender" >
																<option value="male" <?php echo the_author_meta( 'gender', $current_user->ID ) == "male" ?'selected':'' ?>  >Male</option>
																<option value="female"<?php echo the_author_meta( 'gender', $current_user->ID ) == "female" ?'selected':'' ?> >Female</option>
															</select>
														</p><!-- .form-Country -->
														  
														<p class="form-country form-group">
															<label for="country"><?php _e('Country', 'profile'); ?></label>
															<select class="text-input" name="country"  id="country" >
																<option value="0">-- select --</option>
																<option value="Afghanistan" >Afghanistan</option>
																<option value="Albania" >Albania</option>
																<option value="Amer.Virgin Is.">Amer.Virgin Is.</option>
																<option value="Andorra">Andorra</option>
																<option value="Angola">Angola</option>
																<option value="Anguilla">Anguilla</option>
																<option value="Antarctica">Antarctica</option>
																<option value="Antigua/Barbuda">Antigua/Barbuda</option>
																<option value="Argentina">Argentina</option> 
																<option value="Armenia">Armenia</option>
																<option value="Aruba">Aruba</option>
																<option value="Australia">Australia</option>
																<option value="Austria">Austria</option>
																<option value="Azerbaijan">Azerbaijan</option>
																<option value="Bahamas">Bahamas</option>
																<option value="Bahrain">Bahrain</option>
																<option value="Bangladesh">Bangladesh</option>
																<option value="Barbados">Barbados</option>
																<option value="Belarus">Belarus</option>
																<option value="Belgium">Belgium</option>
																<option value="Belize">Belize</option>
																<option value="Benin">Benin</option>
																<option value="Bermuda">Bermuda</option>
																<option value="Bhutan">Bhutan</option>
																<option value="Bolivia">Bolivia</option>
																<option value="Bosnia-Herz.">Bosnia-Herz.</option>
																<option value="Botswana">Botswana</option>
																<option value="Bouvet Islands">Bouvet Islands</option>
																<option value="Brazil">Brazil</option>
																<option value="Brit.Ind.Oc.Ter">Brit.Ind.Oc.Ter</option>
																<option value="Brit.Virgin Is.">Brit.Virgin Is.</option>
																<option value="Brunei Daruss.">Brunei Daruss.</option>
																<option value="Bulgaria">Bulgaria</option>
																<option value="Burkina Faso">Burkina Faso</option>
																<option value="Burma">Burma</option>
																<option value="Burundi">Burundi</option>
																<option value="Cambodia">Cambodia</option>
																<option value="Cameroon">Cameroon</option>
																<option value="Canada">Canada</option>
																<option value="Cape Verde">Cape Verde</option>
																<option value="CAR">CAR</option>
																<option value="Cayman Islands">Cayman Islands</option>
																<option value="Chad">Chad</option>
																<option value="Chile">Chile</option>
																<option value="China">China</option>
																<option value="Christmas Islnd">Christmas Islnd</option>
																<option value="Coconut Islands">Coconut Islands</option>
																<option value="Colombia">Colombia</option>
																<option value="Comoros">Comoros</option>
																<option value="Cook Islands">Cook Islands</option>
																<option value="Costa Rica">Costa Rica</option>
																<option value="Cote d'Ivoire">Cote d'Ivoire</option>
																<option value="Croatia">Croatia</option>
																<option value="Cuba">Cuba</option>
																<option value="Curacao">Curacao</option>
																<option value="Cyprus">Cyprus</option>
																<option value="Czech Republic">Czech Republic</option>
																<option value="Dem. Rep. Congo">Dem. Rep. Congo</option>
																<option value="Denmark">Denmark</option>
																<option value="Djibouti">Djibouti</option>
																<option value="Dominica">Dominica</option>
																<option value="Dominican Rep.">Dominican Rep.</option>
																<option value="Dutch Antilles">Dutch Antilles</option>
																<option value="East Timor">East Timor</option>
																<option value="East Timor">East Timor</option>
																<option value="Ecuador">Ecuador</option>
																<option value="Egypt">Egypt</option>
																<option value="El Salvador">El Salvador</option>
																<option value="Equatorial Guin">Equatorial Guin</option>
																<option value="Eritrea">Eritrea</option>
																<option value="Estonia">Estonia</option>
																<option value="Ethiopia">Ethiopia</option>
																<option value="Falkland Islnds">Falkland Islnds</option>
																<option value="Faroe Islands">Faroe Islands</option>
																<option value="Fiji">Fiji</option>
																<option value="Finland">Finland</option>
																<option value="France">France</option>
																<option value="French Guayana">French Guayana</option>
																<option value="French S.Territ">French S.Territ</option>
																<option value="Frenc.Polynesia">Frenc.Polynesia</option>
																<option value="Gabon">Gabon</option>
																<option value="Gambia">Gambia</option>
																<option value="Georgia">Georgia</option>
																<option value="Germany">Germany</option>
																<option value="Ghana">Ghana</option>
																<option value="Gibraltar">Gibraltar</option>
																<option value="Greece">Greece</option>
																<option value="Greenland">Greenland</option>
																<option value="Grenada">Grenada</option>
																<option value="Guadeloupe">Guadeloupe</option>
																<option value="Guam">Guam</option>
																<option value="Guatemala">Guatemala</option>
																<option value="Guinea">Guinea</option>
																<option value="Guinea-Bissau">Guinea-Bissau</option>
																<option value="Guyana">Guyana</option>
																<option value="Haiti">Haiti</option>
																<option value="Heard/McDon.Isl">Heard/McDon.Isl</option>
																<option value="Honduras">Honduras</option>
																<option value="Hong Kong">Hong Kong</option>
																<option value="Hungary">Hungary</option>
																<option value="Iceland">Iceland</option>
																<option value="India">India</option>
																<option value="Indonesia">Indonesia</option>
																<option value="Iran">Iran</option>
																<option value="Iraq">Iraq</option>
																<option value="Ireland">Ireland</option>
																<option value="Israel">Israel</option>
																<option value="Italy">Italy</option>
																<option value="Jamaica">Jamaica</option>
																<option value="Japan">Japan</option>
																<option value="Jordan">Jordan</option>
																<option value="Kazakhstan">Kazakhstan</option>
																<option value="Kenya">Kenya</option>
																<option value="Kiribati">Kiribati</option>
																<option value="Kuwait">Kuwait</option>
																<option value="Kyrgyzstan">Kyrgyzstan</option>
																<option value="Laos">Laos</option>
																<option value="Latvia">Latvia</option>
																<option value="Lebanon">Lebanon</option>
																<option value="Lesotho">Lesotho</option>
																<option value="Liberia">Liberia</option>
																<option value="Libya">Libya</option>
																<option value="Liechtenstein">Liechtenstein</option>
																<option value="Lithuania">Lithuania</option>
																<option value="Luxembourg">Luxembourg</option>
																<option value="Macau">Macau</option>
																<option value="Macedonia">Macedonia</option>
																<option value="Madagascar">Madagascar</option>
																<option value="Malawi">Malawi</option>
																<option value="MYMalaysia">MYMalaysia</option>
																<option value="Maldives">Maldives</option>
																<option value="Mali">Mali</option>
																<option value="Malta">Malta</option>
																<option value="Marshall Islnds">Marshall Islnds</option>
																<option value="Martinique">Martinique</option>
																<option value="Mauretania">Mauretania</option>
																<option value="Mauritius">Mauritius</option>
																<option value="Mayotte">Mayotte</option>
																<option value="Mexico">Mexico</option>
																<option value="Micronesia">Micronesia</option>
																<option value="Minor Outl.Isl.">Minor Outl.Isl.</option>
																<option value="Moldova">Moldova</option>
																<option value="Monaco">Monaco</option>
																<option value="Mongolia">Mongolia</option>
																<option value="Montserrat">Montserrat</option>
																<option value="Morocco">Morocco</option>
																<option value="Mozambique">Mozambique</option>
																<option value="Namibia">Namibia</option>
																<option value="Nauru">Nauru</option>
																<option value="Nepal">Nepal</option>
																<option value="Netherlands">Netherlands</option>
																<option value="New Caledonia">New Caledonia</option>
																<option value="New Zealand">New Zealand</option>
																<option value="Nicaragua">Nicaragua</option>
																<option value="Niger">Niger</option>
																<option value="Nigeria">Nigeria</option>
																<option value="Niue">Niue</option>
																<option value="N.Mariana Islnd">N.Mariana Islnd</option>
																<option value="Norfolk Islands">Norfolk Islands</option>
																<option value="North Korea">North Korea</option>
																<option value="Norway">Norway</option>
																<option value="Oman">Oman</option>
																<option value="Pakistan">Pakistan</option>
																<option value="Palau">Palau</option>
																<option value="Palestine">Palestine</option>
																<option value="Panama">Panama</option>
																<option value="Pap. New Guinea">Pap. New Guinea</option>
																<option value="Paraguay">Paraguay</option>
																<option value="Peru">Peru</option>
																<option value="Philippines">Philippines</option>
																<option value="Pitcairn Islnds">Pitcairn Islnds</option>
																<option value="Poland">Poland</option>
																<option value="Portugal">Portugal</option>
																<option value="Puerto Rico">Puerto Rico</option>
																<option value="Qatar">Qatar</option>
																<option value="Rep.of Congo">Rep.of Congo</option>
																<option value="Reunion">Reunion</option>
																<option value="Romania">Romania</option>
																<option value="Russian Fed.">Russian Fed.</option>
																<option value="Rwanda">Rwanda</option>
																<option value="Saint Helena">Saint Helena</option>
																<option value="Samoa">Samoa</option>
																<option value="Samoa, America">Samoa, America</option>
																<option value="San Marino">San Marino</option>
																<option value="Saudi Arabia">Saudi Arabia</option>
																<option value="Senegal">Senegal</option>
																<option value="Serbia">Serbia</option>
																<option value="Serbia/Monten.">Serbia/Monten.</option>
																<option value="Seychelles">Seychelles</option>
																<option value="Sierra Leone">Sierra Leone</option>
																<option value="Singapore">Singapore</option>
																<option value="Slovakia">Slovakia</option>
																<option value="Slovenia">Slovenia</option>
																<option value="Solomon Islands">Solomon Islands</option>
																<option value="Somalia">Somalia</option>
																<option value="South Africa">South Africa</option>
																<option value="South Korea">South Korea</option>
																<option value="Spain">Spain</option>
																<option value="Sri Lanka">Sri Lanka</option>
																<option value="Sandwich Ins">Sandwich Ins</option>
																<option value="Kitts&amp;Nevis">Kitts&amp;Nevis</option>
																<option value="St. Lucia">St. Lucia</option>
																<option value="S.Tome,Principe">S.Tome,Principe</option>
																<option value="St.Pier,Miquel.">St.Pier,Miquel.</option>
																<option value="St. Vincent">St. Vincent</option>
																<option value="Sudan">Sudan</option>
																<option value="Suriname">Suriname</option>
																<option value="Svalbard">Svalbard</option>
																<option value="Swaziland">Swaziland</option>
																<option value="Sweden">Sweden</option>
																<option value="Switzerland">Switzerland</option>
																<option value="Syria">Syria</option>
																<option value="Taiwan">Taiwan</option>
																<option value="Tajikistan">Tajikistan</option>
																<option value="Tanzania">Tanzania</option>
																<option value="Thailand">Thailand</option>
																<option value="Togo">Togo</option>
																<option value="Tokelau Islands">Tokelau Islands</option>
																<option value="Tonga">Tonga</option>
																<option value="Trinidad,Tobago">Trinidad,Tobago</option>
																<option value="Tunisia">Tunisia</option>
																<option value="Turkey">Turkey</option>
																<option value="Turkmenistan">Turkmenistan</option>
																<option value="Turksh Caicosin">Turksh Caicosin</option>
																<option value="Tuvalu">Tuvalu</option>
																<option value="Uganda">Uganda</option>
																<option value="Ukraine">Ukraine</option>
																<option value="United Kingdom">United Kingdom</option>
																<option value="Uruguay">Uruguay</option>
																<option value="USA">USA</option>
																<option value="Utd.Arab Emir.">Utd.Arab Emir.</option>
																<option value="Uzbekistan">Uzbekistan</option>
																<option value="Vanuatu">Vanuatu</option>
																<option value="Vatican City">Vatican City</option>
																<option value="Venezuela">Venezuela</option>
																<option value="Vietnam">Vietnam</option>
																<option value="Wallis,Futuna">Wallis,Futuna</option>
																<option value="West Sahara">West Sahara</option>
																<option value="Yemen">Yemen</option>
																<option value="Zambia">Zambia</option>
																<option value="Zimbabwe">Zimbabwe</option>
															 </select>
														<?php $try= the_author_meta( 'town', $current_user->ID );  ?>
														</p><!-- .form-Gender -->
													   
														<p class="form-town form-group">
														<label for="town"><?php _e('Town', 'profile'); ?></label>
														<select class="text-input" name="town"  id="town">
															<option value="">-Select-</option>
															<option value="town_1" <?php if($try=='town_1') echo ' selected'; ?>>town_1</option>
															<option value="town_2" <?php if($try=='town_2') echo ' selected'; ?>>town_2</option>
															<option value="town_3" <?php if($try=='town_3') echo ' selected'; ?>>town_3</option>
															<option value="town_4" <?php if($try=='town_4') echo ' selected'; ?>>town_4</option>
															<option value="town_5" <?php if($try=='town_5') echo ' selected'; ?>>town_5</option>
															<option value="town_5" <?php if($try=='town_6') echo ' selected'; ?>>town_6</option>
															<option value="town_7"  <?php if($try=='town_7') echo ' selected'; ?>>town_7</option>
														</select>
														</p>	
														
														 <p class="form-tel form-group">
															<label for="url"><?php _e('Telephone', 'profile'); ?></label>
															<input class="text-input" name="telephone" type="text" id="telephone" value="<?php the_author_meta( 'telephone', $current_user->ID ); ?>"  />
														</p><!-- .form-url -->
														<p class="form-group">
															<label for="email"><?php _e('E-mail *', 'profile'); ?></label>
															<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>"  />
														</p><!-- .form-email -->
														
														<p class="form-url form-group">
															<label for="url"><?php _e('Website', 'profile'); ?></label>
															<input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>"  />
														</p><!-- .form-url -->
														
														<p class="form-password form-group">
														<!-- .form-food-->
														<h4>About Me</h4>
														
														<p class="form-food form-group">
															<label for="food"><?php _e('Favorite Food', 'profile'); ?></label>
															<input class="text-input" name="food" type="text" id="food" value="<?php the_author_meta( 'food', $current_user->ID ); ?>"  />
														</p><!-- .form-food-->
														
														<!-- .form-exercise-->
														<p class="form-exercise form-group">
															<label for="exercise"><?php _e('Favorite Exercise', 'profile'); ?></label>
															<input class="text-input" name="exercise" type="text" id="exercise" value="<?php the_author_meta( 'exercise', $current_user->ID ); ?>"  />
														</p><!-- .form-exercise-->
														
														<!-- .form-Quote-->
														<p class="form-Quote form-group">
															<label for="quote"><?php _e('Favorite Motivation Quote', 'profile'); ?></label>
															<input class="text-input" name="quote" type="text" id="quote" value="<?php the_author_meta( 'quote', $current_user->ID ); ?>" />
														</p><!-- .form-Quote-->
														<p class="form-group">
															<label for="pass1 "><?php _e('Password *', 'profile'); ?> </label>
															<input class="text-input" name="pass1" type="password" id="pass1"  />
														</p><!-- .form-password -->
														
														<p class="form-password form-group">
															<label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
															<input class="text-input" name="pass2" type="password" id="pass2" />
														</p><!-- .form-password -->
														
														<p class="form-textarea form-group" style="display:none">
															<label for="description"><?php _e('Biographical Information', 'profile') ?></label>
															<textarea name="description" id="description" rows="3" cols="50" readonly="readonly"><?php the_author_meta( 'description', $current_user->ID );  ?> </textarea>
														</p><!-- .form-textarea -->
									
														<p class="form-photo form-group">
														<label for="photo"><?php _e('','profile') ?> </label>
														<?php 
															//action hook for plugin and extra fields
															do_action('edit_user_profile',$current_user); 
														?>
														</p>
														<p class="form-submit" style="float:left;width:auto;">
															<?php echo $referer; ?>
															<input  name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
															<?php wp_nonce_field( 'update-user' ) ?>
										<input name="action" type="hidden" id="action" value="update-user" />
														</p><!-- .form-submit -->
														
                								</form><!-- #adduser -->
            									<?php endif; ?>
       									 </div><!-- .entry-content -->
  						 			 </div><!-- .hentry .post -->
  				 					 <?php endwhile; ?>
									<?php else: ?>
								<p class="no-data">
									<?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
								</p><!-- .no-data -->
								<?php endif; ?>
						</div>
					</div>
			</div>
	</div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>