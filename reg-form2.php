<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Healtopedia - Dashboard </title>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
   <!-- Custom fonts for this template -->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">

   <!-- Custom styles for this page -->
   <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="dtsel.css" />
   <script src="dtsel.js"></script>
</head>
<?php

//error_reporting(0); // Turn off all error reporting

if (strpos($nationality, "WARGANEGARA") !== false) {
   $nationality = "Malaysia";
}
$no = substr($ic_no, 11, 11);
$int = (int)$no;
if ($int % 2 == 0) {
   $gender = "Female";
} else {
   $gender = "Male";
}

$servername = "localhost";
$username = "myhealtopedia";
$password = "Healit20.";
$dbname = "AppsOnsite";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
?>

<!-- Begin Page Content -->
<div class="text-center">
   <img src="https://manage.healtopedia.com/img/logo.png" width="250px" height="80px">
   <h1 class="h5 text-gray-900 mb-4">Healtopedia Registration Form</h1>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-12 col-lg-12">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Walk-In Registration Form</h6>
            </div>
            <div class="card-body">
               <form action="https://pms.healtopedia.com/function2.php" method="POST">
                  <p><b>Client Details</b></p>
                  <hr>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <small><label class="col-form-label">Name :</label></small>
                           <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class=" form-group">
                           <small><label class="col-form-label">IC/Passport (without - ):</label></small>
                           <input type="text" class="form-control" name="ic" id="ic" required><br>
                           <input type="button" value="Autofill Date of Birth and Gender" id="filler2" onClick="fillValuesNoJQuery()" class="btn btn-primary btn-sm">
                        </div>
                        <div class=" form-group">
                           <small><label class="col-form-label">Gender :</label></small>
                           <!-- <input type="text" class="form-control" name="gender" id="gender" required> -->
                           <select class="form-control" name="gender" required>
                              <option value="Male" selected>Male</option>
                              <option value="Female">Female</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <small><label class="col-form-label">Address :</label></small>
                           <textarea type="text" class="form-control" name="current_address" id="address" value="-" required></textarea>
                        </div>

                     </div>


                     <div class="col-md-6">

                        <div class="form-group">
                           <small><label class="col-form-label">Nationality :</label></small>
                           <select class="form-control" name="nation" required>
                              <option value="CHN" selected>China</option>
                              <option value="MYS">Malaysia</option>
                              <option value="SGP">Singapore</option>
                              <option value="IDN">Indonesia</option>
                              <option value="USA">United States</option>
                              <option value="GBR">United Kingdom</option>
                              <option value="AUS">Australia</option>
                              <option value="CAN">Canada</option>
                              <option value="IND">India</option>
                              <option value="BRA">Brazil</option>
                              <option value="ALB">Albania</option>
                              <option value="DZA">Algeria</option>
                              <option value="AND">Andorra</option>
                              <option value="AGO">Angola</option>
                              <option value="AIA">Anguilla</option>
                              <option value="ATG">Antigua and Barbuda</option>
                              <option value="ARG">Argentina</option>
                              <option value="ARM">Armenia</option>
                              <option value="ABW">Aruba</option>
                              <option value="AUT">Austria</option>
                              <option value="AZE">Azerbaijan Republic</option>
                              <option value="BHS">Bahamas</option>
                              <option value="BHR">Bahrain</option>
                              <option value="BRB">Barbados</option>
                              <option value="BGD">Bangladesh</option>
                              <option value="BEL">Belgium</option>
                              <option value="BLZ">Belize</option>
                              <option value="BEN">Benin</option>
                              <option value="BMU">Bermuda</option>
                              <option value="BTN">Bhutan</option>
                              <option value="BOL">Bolivia</option>
                              <option value="BIH">Bosnia and Herzegovina</option>
                              <option value="BWA">Botswana</option>
                              <option value="VGB">British Virgin Islands</option>
                              <option value="BRN">Brunei</option>
                              <option value="BGR">Bulgaria</option>
                              <option value="BFA">Burkina Faso</option>
                              <option value="BDI">Burundi</option>
                              <option value="KHM">Cambodia</option>
                              <option value="CPV">Cape Verde</option>
                              <option value="CYM">Cayman Islands</option>
                              <option value="TCD">Chad</option>
                              <option value="CHL">Chile</option>
                              <option value="CHN">China Worldwide</option>
                              <option value="COL">Colombia</option>
                              <option value="COM">Comoros</option>
                              <option value="COK">Cook Islands</option>
                              <option value="CRI">Costa Rica</option>
                              <option value="HRV">Croatia</option>
                              <option value="CYP">Cyprus</option>
                              <option value="CZE">Czech Republic</option>
                              <option value="COD">Democratic Republic of the Congo</option>
                              <option value="DNK">Denmark</option>
                              <option value="DJI">Djibouti</option>
                              <option value="DMA">Dominica</option>
                              <option value="DOM">Dominican Republic</option>
                              <option value="ECU">Ecuador</option>
                              <option value="SLV">El Salvador</option>
                              <option value="ERI">Eritrea</option>
                              <option value="EST">Estonia</option>
                              <option value="ETH">Ethiopia</option>
                              <option value="FLK">Falkland Islands</option>
                              <option value="FRO">Faroe Islands</option>
                              <option value="FSM">Federated States of Micronesia</option>
                              <option value="FJI">Fiji</option>
                              <option value="FIN">Finland</option>
                              <option value="FRA">France</option>
                              <option value="GUF">French Guiana</option>
                              <option value="PYF">French Polynesia</option>
                              <option value="GAB">Gabon Republic</option>
                              <option value="GMB">Gambia</option>
                              <option value="DEU">Germany</option>
                              <option value="GIB">Gibraltar</option>
                              <option value="GRC">Greece</option>
                              <option value="GRL">Greenland</option>
                              <option value="GRD">Grenada</option>
                              <option value="GLP">Guadeloupe</option>
                              <option value="GTM">Guatemala</option>
                              <option value="GIN">Guinea</option>
                              <option value="GNB">Guinea Bissau</option>
                              <option value="GUY">Guyana</option>
                              <option value="HND">Honduras</option>
                              <option value="HKG">Hong Kong</option>
                              <option value="HUN">Hungary</option>
                              <option value="ISL">Iceland</option>
                              <option value="IRL">Ireland</option>
                              <option value="ISR">Israel</option>
                              <option value="ITA">Italy</option>
                              <option value="JAM">Jamaica</option>
                              <option value="JPN">Japan</option>
                              <option value="JOR">Jordan</option>
                              <option value="KAZ">Kazakhstan</option>
                              <option value="KEN">Kenya</option>
                              <option value="KIR">Kiribati</option>
                              <option value="KWT">Kuwait</option>
                              <option value="KGZ">Kyrgyzstan</option>
                              <option value="LAO">Laos</option>
                              <option value="LVA">Latvia</option>
                              <option value="LSO">Lesotho</option>
                              <option value="LIE">Liechtenstein</option>
                              <option value="LTU">Lithuania</option>
                              <option value="LUX">Luxembourg</option>
                              <option value="MDG">Madagascar</option>
                              <option value="MWI">Malawi</option>
                              <option value="MDV">Maldives</option>
                              <option value="MLI">Mali</option>
                              <option value="MLT">Malta</option>
                              <option value="MHL">Marshall Islands</option>
                              <option value="MTQ">Martinique</option>
                              <option value="MRT">Mauritania</option>
                              <option value="MUS">Mauritius</option>
                              <option value="MYT">Mayotte</option>
                              <option value="MEX">Mexico</option>
                              <option value="MNG">Mongolia</option>
                              <option value="MSR">Montserrat</option>
                              <option value="MAR">Morocco</option>
                              <option value="MOZ">Mozambique</option>
                              <option value="NAM">Namibia</option>
                              <option value="NRU">Nauru</option>
                              <option value="NPL">Nepal</option>
                              <option value="NLD">Netherlands</option>
                              <option value="ANT">Netherlands Antilles</option>
                              <option value="NCL">New Caledonia</option>
                              <option value="NZL">New Zealand</option>
                              <option value="NIC">Nicaragua</option>
                              <option value="NER">Niger</option>
                              <option value="NIU">Niue</option>
                              <option value="NFK">Norfolk Island</option>
                              <option value="NOR">Norway</option>
                              <option value="OMN">Oman</option>
                              <option value="PLW">Palau</option>
                              <option value="PAN">Panama</option>
                              <option value="PNG">Papua New Guinea</option>
                              <option value="PER">Peru</option>
                              <option value="PHL">Philippines</option>
                              <option value="PCN">Pitcairn Islands</option>
                              <option value="POL">Poland</option>
                              <option value="PRT">Portugal</option>
                              <option value="QAT">Qatar</option>
                              <option value="COD">Republic of the Congo</option>
                              <option value="REU">Reunion</option>
                              <option value="ROM">Romania</option>
                              <option value="RUS">Russia</option>
                              <option value="RWA">Rwanda</option>
                              <option value="VCT">Saint Vincent and the Grenadines</option>
                              <option value="WSM">Samoa</option>
                              <option value="SMR">San Marino</option>
                              <option value="STP">São Tomé and Príncipe</option>
                              <option value="SAU">Saudi Arabia</option>
                              <option value="SEN">Senegal</option>
                              <option value="SYC">Seychelles</option>
                              <option value="SLE">Sierra Leone</option>
                              <option value="SVK">Slovakia</option>
                              <option value="SVN">Slovenia</option>
                              <option value="SLB">Solomon Islands</option>
                              <option value="SOM">Somalia</option>
                              <option value="ZAF">South Africa</option>
                              <option value="KOR">South Korea</option>
                              <option value="ESP">Spain</option>
                              <option value="LKA">Sri Lanka</option>
                              <option value="SHN">St. Helena</option>
                              <option value="KNA">St. Kitts and Nevis</option>
                              <option value="LCA">St. Lucia</option>
                              <option value="SPM">St. Pierre and Miquelon</option>
                              <option value="SUR">Suriname</option>
                              <option value="SJM">Svalbard and Jan Mayen Islands</option>
                              <option value="SWZ">Swaziland</option>
                              <option value="SWE">Sweden</option>
                              <option value="CHE">Switzerland</option>
                              <option value="TWN">Taiwan</option>
                              <option value="TJK">Tajikistan</option>
                              <option value="TZA">Tanzania</option>
                              <option value="THA">Thailand</option>
                              <option value="TGO">Togo</option>
                              <option value="TON">Tonga</option>
                              <option value="TTO">Trinidad and Tobago</option>
                              <option value="TUN">Tunisia</option>
                              <option value="TUR">Turkey</option>
                              <option value="TKM">Turkmenistan</option>
                              <option value="TCA">Turks and Caicos Islands</option>
                              <option value="TUV">Tuvalu</option>
                              <option value="UGA">Uganda</option>
                              <option value="UKR">Ukraine</option>
                              <option value="ARE">United Arab Emirates</option>
                              <option value="URY">Uruguay</option>
                              <option value="VUT">Vanuatu</option>
                              <option value="VAT">Vatican City State</option>
                              <option value="VEN">Venezuela</option>
                              <option value="VNM">Vietnam</option>
                              <option value="WLF">Wallis and Futuna Islands</option>
                              <option value="YEM">Yemen</option>
                              <option value="ZMB">Zambia</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <small><label class="col-form-label">Date of Birth :</label></small>
                           <input type="text" class="form-control" name="bod" id="bod">
                        </div>
                        <div class="form-group">
                           <small><label class="col-form-label">Phone No. :</label></small>
                           <input type="text" class="form-control" value="60" name="phone" required>
                        </div>

                        <div class="form-group">
                           <small><label class="col-form-label">Email :</label></small>
                           <input type="text" class="form-control" name="email" id="email" value="-">
                        </div>




                     </div>
                  </div>


                  <p><b>Appointment Details</b></p>
                  <hr>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <small><label class="col-form-label">Test Type :</label></small>
                           <input type="text" class="form-control" name="test_type" required value="IgM/IgG + PCR Test" readonly>
                        </div>

                        <div class="form-group">
                           <small><label class="col-form-label">Method:</label></small>
                           <input type="text" class="form-control" name="test_method" required value="Walk-In" readonly>
                        </div>




                     </div>

                     <div class="col-md-6">

                        <div id="locationdropdown" class="form-group">
                           <small><label class="col-form-label">Location :</label></small>
                           <input type="text" class="form-control" name="location" required value="ALPS" readonly>

                        </div>
                        <div class="form-group">
                           <small><label class="col-form-label">Payment Method:</label></small>
                           <select class="form-control" name="payment_method" required>
                              <option value="" selected>Select Payment Method</option>
                              <option value="Cash Payment">Cash Payment</option>
                              <option value="Bank Transfer">Bank Transfer</option>
                           </select>

                        </div>
                     </div>

                  </div>

                  <hr>

                  <button type="submit" name="add" class="btn btn-success"><i aria-hidden="true"></i> Submit Appointment</button>
                  <button type="button" name="add" class="btn btn-success" onclick='window.location.reload(true);'><i aria-hidden="true"></i> Refresh</button>
               </form>
            </div>
         </div>
      </div>





   </div>
   <!-- /.container-fluid -->



</div>
<script type="text/javascript">
   function SetBilling(checked) {
      if (checked) {
         document.getElementById('current_address').value = document.getElementById('address').value;
      }
   }
   fillValuesNoJQuery = function() {
      var str = document.getElementById("ic").value;
      var yr = str.slice(0, 2);
      var month = str.slice(2, 4);
      var day = str.slice(4, 6);
      var no = str.slice(11, 12);
      var gno = parseInt(no, 10);
      var yer = parseInt(yr, 10);
      var n = str.length;
      if (n !== 12) {
         document.getElementById("gender").value = "IC INPUT ERROR, REFILL IC AGAIN";
      } else {
         if (gno % 2 == 0) {
            var gender = "FEMALE";
         } else {
            var gender = "MALE";
         }

         if (yer <= 21) {
            var year = yer + 2000;
         } else {
            var year = yer + 1900;
         }


         var dob = day + "/" + month + "/" + year;
         document.getElementById("gender").value = gender;
         document.getElementById("bod").value = dob;
      }
   }
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</body>

</html>