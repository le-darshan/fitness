<?php 
/**
*  Template Name: Register
*/
get_header();
 
?>
<style>
.form-group > label{margin-right:3%;float:left;width:20%;color:#fff;}
.form-group > label.error{ float: left;    text-align: center;    width: 100%;}
</style>
<div class="bg-container single-post-body <?php echo $woocommerce_class;?>">
  <div class="body-top-color">
    <!---->
  </div>
  <div class="background-color">
    <!---->
  </div>
  <div class="container">
    <div class="container-pad">
      <div class="row-fluid">
        <div class="span6">
          <form id="register" class="ajax-auth form-table"  action="register" method="post">
			  <div class="vc_col-sm-12 wpb_column vc_column_container">
				<div class="wpb_wrapper">
						<div class="box-style-1 heading-shortcode" id="heading-id16872">
							<div class="module-title">
								<h2 class="title def_style" style="color:  !important">
									<span>
										<span class="firstword" style="color:  !important">FILL UP THE FORM AND START TODAY</span>
									</span>
								</h2>
							</div>
						</div>
					</div> 
				</div>
			<p class="status"></p>
            <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
         	<div style="margin-top:3%;"></div>
		    <div class="form-group">
              <label for="signonname">FullName<span>*</span></label>
              <input id="signonname" type="text" name="signonname" class="required">
            </div>
         
		    <div class="form-group">
              <label> Date of Birth<span>*</span></label>
              <input type="date"  value=""  class="required" name="birthdate" id="birthdate"/>
            </div>
         
		    <div class="form-group">
              <label>Gender<span>*</span></label>
              <select name="gender" id="gender" class="required">
                <option>--select--</option>
                <option  value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
         
		    <div class="form-group">
              <label for="email">Email<span>*</span></label>
              <input id="email" type="text" class="required email" name="email">
            </div>
         
		    <div class="form-group">
              <label for="signonpassword">Password<span>*</span></label>
              <input id="signonpassword" type="password" class="required" name="signonpassword" >
            </div>
         
		    <div class="form-group">
              <label for="password2">Confirm Password<span>*</span></label>
              <input type="password" id="password2" class="required" name="password2">
            </div>
         
		    <div class="form-group">
              <label>Country</label>
              <select name="country" id="country"  class="form-control hastip1">
                <option  value="">-Select-</option>
                <option  data-id="93" value="Afghanistan">Afghanistan</option>
                <option  data-id="355" value="Albania">Albania</option>
                <option  data-id="213" value="Algeria">Algeria</option>
                <option  data-id="1809" value="Amer.Virgin Is.">Amer.Virgin Is.</option>
                <option  data-id="376" value="Andorra">Andorra</option>
                <option  data-id="244" value="Angola">Angola</option>
                <option  data-id="1809" value="Anguilla">Anguilla</option>
                <option  data-id="672" value="Antarctica">Antarctica</option>
                <option  data-id="1809" value="Antigua/Barbuda">Antigua/Barbuda</option>
                <option  data-id="54" value="Argentina">Argentina</option>
                <option  data-id="374" value="Armenia">Armenia</option>
                <option  data-id="297" value="Aruba">Aruba</option>
                <option  data-id="61" value="Australia">Australia</option>
                <option  data-id="43" value="Austria">Austria</option>
                <option  data-id="994" value="Azerbaijan">Azerbaijan</option>
                <option  data-id="1809" value="Bahamas">Bahamas</option>
                <option  data-id="973" value="Bahrain">Bahrain</option>
                <option  data-id="880" value="Bangladesh">Bangladesh</option>
                <option  data-id="1809" value="Barbados">Barbados</option>
                <option  data-id="375" value="Belarus">Belarus</option>
                <option  data-id="32" value="Belgium">Belgium</option>
                <option  data-id="501" value="Belize">Belize</option>
                <option  data-id="229" value="Benin">Benin</option>
                <option  data-id="1809" value="Bermuda">Bermuda</option>
                <option  data-id="975" value="Bhutan">Bhutan</option>
                <option  data-id="591" value="Bolivia">Bolivia</option>
                <option  data-id="387" value="Bosnia-Herz.">Bosnia-Herz.</option>
                <option  data-id="267" value="Botswana">Botswana</option>
                <option  data-id="" value="Bouvet Islands">Bouvet Islands</option>
                <option  data-id="55" value="Brazil">Brazil</option>
                <option  data-id="" value="Brit.Ind.Oc.Ter">Brit.Ind.Oc.Ter</option>
                <option  data-id="1809" value="Brit.Virgin Is.">Brit.Virgin Is.</option>
                <option  data-id="673" value="Brunei Daruss.">Brunei Daruss.</option>
                <option  data-id="359" value="Bulgaria">Bulgaria</option>
                <option  data-id="226" value="Burkina Faso">Burkina Faso</option>
                <option  data-id="95" value="Burma">Burma</option>
                <option  data-id="257" value="Burundi">Burundi</option>
                <option  data-id="855" value="Cambodia">Cambodia</option>
                <option  data-id="237" value="Cameroon">Cameroon</option>
                <option  data-id="1" value="Canada">Canada</option>
                <option  data-id="238" value="Cape Verde">Cape Verde</option>
                <option  data-id="236" value="CAR">CAR</option>
                <option  data-id="1809" value="Cayman Islands">Cayman Islands</option>
                <option  data-id="235" value="Chad">Chad</option>
                <option  data-id="56" value="Chile">Chile</option>
                <option  data-id="86" value="China">China</option>
                <option  data-id="61" value="Christmas Islnd">Christmas Islnd</option>
                <option  data-id="672" value="Coconut Islands">Coconut Islands</option>
                <option  data-id="57" value="Colombia">Colombia</option>
                <option  data-id="269" value="Comoros">Comoros</option>
                <option  data-id="682" value="Cook Islands">Cook Islands</option>
                <option  data-id="506" value="Costa Rica">Costa Rica</option>
                <option  data-id="225" value="Cote d'Ivoire">Cote d Ivoire</option>
                <option  data-id="385" value="Croatia">Croatia</option>
                <option  data-id="53" value="Cuba">Cuba</option>
                <option  data-id="599" value="Curacao">Curacao</option>
                <option  data-id="357" value="Cyprus">Cyprus</option>
                <option  data-id="420" value="Czech Republic">Czech Republic</option>
                <option  data-id="242" value="Dem. Rep. Congo">Dem. Rep. Congo</option>
                <option  data-id="45" value="Denmark">Denmark</option>
                <option  data-id="253" value="Djibouti">Djibouti</option>
                <option  data-id="1809" value="Dominica">Dominica</option>
                <option  data-id="1802" value="Dominican Rep.">Dominican Rep.</option>
                <option  data-id="599" value="Dutch Antilles">Dutch Antilles</option>
                <option  data-id="670" value="East Timor">East Timor</option>
                <option  data-id="670" value="East Timor">East Timor</option>
                <option  data-id="593" value="Ecuador">Ecuador</option>
                <option  data-id="20" value="Egypt">Egypt</option>
                <option  data-id="503" value="El Salvador">El Salvador</option>
                <option  data-id="240" value="Equatorial Guin">Equatorial Guin</option>
                <option  data-id="291" value="Eritrea">Eritrea</option>
                <option  data-id="372" value="Estonia">Estonia</option>
                <option  data-id="251" value="Ethiopia">Ethiopia</option>
                <option  data-id="500" value="Falkland Islnds">Falkland Islnds</option>
                <option  data-id="298" value="Faroe Islands">Faroe Islands</option>
                <option  data-id="679" value="Fiji">Fiji</option>
                <option  data-id="358" value="Finland">Finland</option>
                <option  data-id="33" value="France">France</option>
                <option  data-id="594" value="French Guayana">French Guayana</option>
                <option  data-id="" value="French S.Territ">French S.Territ</option>
                <option  data-id="689" value="Frenc.Polynesia">Frenc.Polynesia</option>
                <option  data-id="241" value="Gabon">Gabon</option>
                <option  data-id="220" value="Gambia">Gambia</option>
                <option  data-id="995" value="Georgia">Georgia</option>
                <option  data-id="49" value="Germany">Germany</option>
                <option  data-id="233" value="Ghana">Ghana</option>
                <option  data-id="350" value="Gibraltar">Gibraltar</option>
                <option  data-id="30" value="Greece">Greece</option>
                <option  data-id="299" value="Greenland">Greenland</option>
                <option  data-id="1809" value="Grenada">Grenada</option>
                <option  data-id="590" value="Guadeloupe">Guadeloupe</option>
                <option  data-id="671" value="Guam">Guam</option>
                <option  data-id="502" value="Guatemala">Guatemala</option>
                <option  data-id="224" value="Guinea">Guinea</option>
                <option  data-id="245" value="Guinea-Bissau">Guinea-Bissau</option>
                <option  data-id="592" value="Guyana">Guyana</option>
                <option  data-id="509" value="Haiti">Haiti</option>
                <option  data-id="" value="Heard/McDon.Isl">Heard/McDon.Isl</option>
                <option  data-id="504" value="Honduras">Honduras</option>
                <option  data-id="852" value="Hong Kong">Hong Kong</option>
                <option  data-id="36" value="Hungary">Hungary</option>
                <option  data-id="354" value="Iceland">Iceland</option>
                <option  data-id="91" value="India">India</option>
                <option  data-id="62" value="Indonesia">Indonesia</option>
                <option  data-id="98" value="Iran">Iran</option>
                <option  data-id="964" value="Iraq">Iraq</option>
                <option  data-id="353" value="Ireland">Ireland</option>
                <option  data-id="972" value="Israel">Israel</option>
                <option  data-id="39" value="Italy">Italy</option>
                <option  data-id="1809" value="Jamaica">Jamaica</option>
                <option  data-id="81" value="Japan">Japan</option>
                <option  data-id="962" value="Jordan">Jordan</option>
                <option  data-id="7" value="Kazakhstan">Kazakhstan</option>
                <option  data-id="254" value="Kenya">Kenya</option>
                <option  data-id="686" value="Kiribati">Kiribati</option>
                <option  data-id="965" value="Kuwait">Kuwait</option>
                <option  data-id="996" value="Kyrgyzstan">Kyrgyzstan</option>
                <option  data-id="856" value="Laos">Laos</option>
                <option  data-id="371" value="Latvia">Latvia</option>
                <option  data-id="961" value="Lebanon">Lebanon</option>
                <option  data-id="266" value="Lesotho">Lesotho</option>
                <option  data-id="231" value="Liberia">Liberia</option>
                <option  data-id="218" value="Libya">Libya</option>
                <option  data-id="41" value="Liechtenstein">Liechtenstein</option>
                <option  data-id="370" value="Lithuania">Lithuania</option>
                <option  data-id="352" value="Luxembourg">Luxembourg</option>
                <option  data-id="853" value="Macau">Macau</option>
                <option  data-id="389" value="Macedonia">Macedonia</option>
                <option  data-id="261" value="Madagascar">Madagascar</option>
                <option  data-id="265" value="Malawi">Malawi</option>
                <option  data-id="60" value="MYMalaysia">MYMalaysia</option>
                <option  data-id="960" value="Maldives">Maldives</option>
                <option  data-id="223" value="Mali">Mali</option>
                <option  data-id="356" value="Malta">Malta</option>
                <option  data-id="692" value="Marshall Islnds">Marshall Islnds</option>
                <option  data-id="596" value="Martinique">Martinique</option>
                <option  data-id="222" value="Mauretania">Mauretania</option>
                <option  data-id="230" value="Mauritius">Mauritius</option>
                <option  data-id="269" value="Mayotte">Mayotte</option>
                <option  data-id="52" value="Mexico">Mexico</option>
                <option  data-id="691" value="Micronesia">Micronesia</option>
                <option  data-id="" value="Minor Outl.Isl.">Minor Outl.Isl.</option>
                <option  data-id="373" value="Moldova">Moldova</option>
                <option  data-id="377" value="Monaco">Monaco</option>
                <option  data-id="976" value="Mongolia">Mongolia</option>
                <option  data-id="1809" value="Montserrat">Montserrat</option>
                <option  data-id="212" value="Morocco">Morocco</option>
                <option  data-id="258" value="Mozambique">Mozambique</option>
                <option  data-id="264" value="Namibia">Namibia</option>
                <option  data-id="674" value="Nauru">Nauru</option>
                <option  data-id="977" value="Nepal">Nepal</option>
                <option  data-id="31" value="Netherlands">Netherlands</option>
                <option  data-id="687" value="New Caledonia">New Caledonia</option>
                <option  data-id="64" value="New Zealand">New Zealand</option>
                <option  data-id="505" value="Nicaragua">Nicaragua</option>
                <option  data-id="227" value="Niger">Niger</option>
                <option  data-id="234" value="Nigeria">Nigeria</option>
                <option  data-id="683" value="Niue">Niue</option>
                <option  data-id="670" value="N.Mariana Islnd">N.Mariana Islnd</option>
                <option  data-id="6723" value="Norfolk Islands">Norfolk Islands</option>
                <option  data-id="850" value="North Korea">North Korea</option>
                <option  data-id="47" value="Norway">Norway</option>
                <option  data-id="968" value="Oman">Oman</option>
                <option  data-id="92" value="Pakistan">Pakistan</option>
                <option  data-id="680" value="Palau">Palau</option>
                <option  data-id="970" value="Palestine">Palestine</option>
                <option  data-id="507" value="Panama">Panama</option>
                <option  data-id="675" value="Pap. New Guinea">Pap. New Guinea</option>
                <option  data-id="595" value="Paraguay">Paraguay</option>
                <option  data-id="51" value="Peru">Peru</option>
                <option  data-id="63" value="Philippines">Philippines</option>
                <option  data-id="" value="Pitcairn Islnds">Pitcairn Islnds</option>
                <option  data-id="48" value="Poland">Poland</option>
                <option  data-id="351" value="Portugal">Portugal</option>
                <option  data-id="1809" value="Puerto Rico">Puerto Rico</option>
                <option  data-id="974" value="Qatar">Qatar</option>
                <option  data-id="242" value="Rep.of Congo">Rep.of Congo</option>
                <option  data-id="262" value="Reunion">Reunion</option>
                <option  data-id="40" value="Romania">Romania</option>
                <option  data-id="7" value="Russian Fed.">Russian Fed.</option>
                <option  data-id="250" value="Rwanda">Rwanda</option>
                <option  data-id="290" value="Saint Helena">Saint Helena</option>
                <option  data-id="685" value="Samoa">Samoa</option>
                <option  data-id="684" value="Samoa, America">Samoa, America</option>
                <option  data-id="378" value="San Marino">San Marino</option>
                <option  data-id="966" value="Saudi Arabia">Saudi Arabia</option>
                <option  data-id="221" value="Senegal">Senegal</option>
                <option  data-id="381" value="Serbia">Serbia</option>
                <option  data-id="381" value="Serbia/Monten.">Serbia/Monten.</option>
                <option  data-id="248" value="Seychelles">Seychelles</option>
                <option  data-id="232" value="Sierra Leone">Sierra Leone</option>
                <option  data-id="65" value="Singapore">Singapore</option>
                <option  data-id="421" value="Slovakia">Slovakia</option>
                <option  data-id="386" value="Slovenia">Slovenia</option>
                <option  data-id="677" value="Solomon Islands">Solomon Islands</option>
                <option  data-id="252" value="Somalia">Somalia</option>
                <option  data-id="27" value="South Africa">South Africa</option>
                <option  data-id="82" value="South Korea">South Korea</option>
                <option  data-id="34" value="Spain">Spain</option>
                <option  data-id="94" value="Sri Lanka">Sri Lanka</option>
                <option  data-id="" value="Sandwich Ins">Sandwich Ins</option>
                <option  data-id="1809" value="Kitts&amp;Nevis">St. Kitts&Nevis </option>
                <option  data-id="1809" value="St. Lucia">St. Lucia</option>
                <option  data-id="239" value="S.Tome,Principe">S.Tome,Principe</option>
                <option  data-id="508" value="St.Pier,Miquel.">St.Pier,Miquel.</option>
                <option  data-id="1784" value="St. Vincent">St. Vincent</option>
                <option  data-id="249" value="Sudan">Sudan</option>
                <option  data-id="597" value="Suriname">Suriname</option>
                <option  data-id="" value="Svalbard">Svalbard</option>
                <option  data-id="268" value="Swaziland">Swaziland</option>
                <option  data-id="46" value="Sweden">Sweden</option>
                <option  data-id="41" value="Switzerland">Switzerland</option>
                <option  data-id="963" value="Syria">Syria</option>
                <option  data-id="886" value="Taiwan">Taiwan</option>
                <option  data-id="992" value="Tajikistan">Tajikistan</option>
                <option  data-id="255" value="Tanzania">Tanzania</option>
                <option  data-id="66" value="Thailand">Thailand</option>
                <option  data-id="228" value="Togo">Togo</option>
                <option  data-id="690" value="Tokelau Islands">Tokelau Islands</option>
                <option  data-id="676" value="Tonga">Tonga</option>
                <option  data-id="1809" value="Trinidad,Tobago">Trinidad,Tobago</option>
                <option  data-id="216" value="Tunisia">Tunisia</option>
                <option  data-id="90" value="Turkey">Turkey</option>
                <option  data-id="993" value="Turkmenistan">Turkmenistan</option>
                <option  data-id="1809" value="Turksh Caicosin">Turksh Caicosin</option>
                <option  data-id="688" value="Tuvalu">Tuvalu</option>
                <option  data-id="256" value="Uganda">Uganda</option>
                <option  data-id="38" value="Ukraine">Ukraine</option>
                <option  data-id="44" value="United Kingdom">United Kingdom</option>
                <option  data-id="598" value="Uruguay">Uruguay</option>
                <option  data-id="1" value="USA">USA</option>
                <option  data-id="971" value="Utd.Arab Emir.">Utd.Arab Emir.</option>
                <option  data-id="998" value="Uzbekistan">Uzbekistan</option>
                <option  data-id="678" value="Vanuatu">Vanuatu</option>
                <option  data-id="39" value="Vatican City">Vatican City</option>
                <option  data-id="58" value="Venezuela">Venezuela</option>
                <option  data-id="84" value="Vietnam">Vietnam</option>
                <option  data-id="681" value="Wallis,Futuna">Wallis,Futuna</option>
                <option  value="West Sahara">West Sahara</option>
                <option  data-id="967" value="Yemen">Yemen</option>
                <option  data-id="260" value="Zambia">Zambia</option>
                <option  data-id="263" value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
         
		    <div class="form-group">
              <label>Telephone</label>
              <input type="tel" class="le_phone required digits form-control" id="phone" value="" name="phone" maxlength="10" />
            </div>
         
		    <div class="checkbox">
              <label>
              <input type="checkbox"  value="1" />
              I agree with the Terms & Condition </label>
            </div>
         
		    <input class="submit_button" type="submit" value="SIGNUP">
          </form>
        </div>
		<div class="span6" >
		<img src="/wp-content/uploads/2014/11/registration.png" />
		</div>
      </div>
    </div>
  </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer();?>
