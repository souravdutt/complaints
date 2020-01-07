<?php
    require_once("includes/config/config.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Complaint Numbers</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="shortcut" href="assets/images/icon/title.png">
    <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
        <div class="container" style="width:100%; overflow-x: hidden;">
        <a href="index.php" target="_blank" style="color:white; position:absolute; top:10px; right:20px; font-size:110%;">Home</a>
        <div class="find_center">            
            <p class="intro">
                Welcome, <b>Mr. Dutt!</b> Let's add some data to the database.
            </p>
            <br>
            <br>
            <form action="" method="POST">
                <div class="search_box">
                    <div class="select_opts">
                        <div class="row">
                            <?php
                                $error = "";
                                $error.= "<div class='error' style='color:red;'>Errors:<br>";
                                $error_sr = 1;
                            ?>
                            <div class="cell">
                                <span>Country*</span>
                                <select name="countries" id="countries" disabled>
                                    <option value="0">---Select Country---</option>
                                    <option value="91" selected>India</option>
                                    <option value="2">USA</option>
                                    <option value="3">Russia</option>
                                    <option value="4">England</option>
                                </select>
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    
                                    #Till data available for India only
                                    $_POST['countries'] = '91';
                                    if(!isset($_POST['countries']) || $_POST['countries'] == '0'){
                                        $error.=$error_sr.". Please select <b>Country</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>State*</span>
                                <select name="states" id="states">
                                    <?php
                                        if(isset($_POST['states']) && $_POST['states'] != '0')
                                            $state = $_POST['states'];
                                    ?>
                                    <option value="0">---Select State---</option>
                                    <option value="1" <?php if(isset($state) && $state=="1") echo"selected";?> >Punjab</option>
                                    <option value="2" <?php if(isset($state) && $state=="2") echo"selected";?> >Himachal Pradesh</option>
                                    <option value="3" <?php if(isset($state) && $state=="3") echo"selected";?> >Bihar</option>
                                    <option value="4" <?php if(isset($state) && $state=="4") echo"selected";?> >Uttar Pradesh</option>
                                </select>
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if(!isset($_POST['states']) || $_POST['states'] == '0'){
                                        $error.=$error_sr.". Please select <b>State</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>District*</span>
                                <select name="districts" id="districts">
                                    <?php
                                        if(isset($_POST['districts']) && $_POST['districts'] != '0')
                                            $district = $_POST['districts'];
                                    ?>
                                    <option value="0">---Select District---</option>
                                    <option value="148001" <?php if(isset($district) && $district=="148001") echo"selected";?> >Sangrur</option>
                                    <option value="147001" <?php if(isset($district) && $district=="147001") echo"selected";?> >Patiala</option>
                                    <option value="3" <?php if(isset($district) && $district=="3") echo"selected";?> >Bathinda</option>
                                    <option value="4" <?php if(isset($district) && $district=="4") echo"selected";?> >Amritsar</option>
                                </select>
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if(!isset($_POST['districts']) || $_POST['districts'] == '0'){
                                        $error.=$error_sr.". Please select <b>District</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>City*</span>
                                <input type="text" placeholder="Enter City Name" name="city" minlength="3"
                                    <?php
                                        if(isset($_POST['city']))
                                            echo "value=\"".$_POST['city']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['city'] == ''){
                                        $error.=$error_sr.". Please enter <b>City</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>Pincode*</span>
                                <input type="text" placeholder="Enter Pincode (6-digit)" name="pincode" minlength="6" maxlength="6"
                                    <?php
                                        if(isset($_POST['pincode']))
                                            echo "value=\"".$_POST['pincode']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['pincode'] == ''){
                                        $error.=$error_sr.". Please enter valid <b>City Pincode</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>Address*</span>
                                <input type="text" placeholder="Enter Address" name="address" minlength="8"
                                    <?php
                                        if(isset($_POST['address']))
                                            echo "value=\"".$_POST['address']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['address'] == ''){
                                        $error.=$error_sr.". Please enter <b>Address</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                        </div>
                        <br>
                        <div class="row">
                            <div class="cell">
                                <span>Department Name*</span>
                                <input type="text" placeholder="Department Name" name="department" minlength="3"
                                    <?php
                                        if(isset($_POST['department']))
                                            echo "value=\"".$_POST['department']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['department'] == ''){
                                        $error.=$error_sr.". Please enter <b>Department</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>Officer Name/Desig.</span>
                                <input type="text" placeholder="Officer Name / Designation" name="officer" minlength="3"
                                    <?php
                                        if(isset($_POST['officer']))
                                            echo "value=\"".$_POST['officer']."\"";
                                    ?>
                                />
                            </div>
                            <div class="cell">
                                <span>Mobile*</span>
                                <input type="tel" placeholder="Mobile Number" minlength="3" name="mobile" minlength="10" maxlength="10"
                                    <?php
                                        if(isset($_POST['mobile']))
                                            echo "value=\"".$_POST['mobile']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['mobile'] == ''){
                                        $error.=$error_sr.". Please enter <b>Mobile Number</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>Email ID*</span>
                                <input type="email" style="text-transform:lowercase" placeholder="Email Address" name="email"
                                    <?php
                                        if(isset($_POST['email']))
                                            echo "value=\"".$_POST['email']."\"";
                                    ?>
                                />
                            </div>
                            <?php
                                if(isset($_POST['submit_btn'])){
                                    if($_POST['email'] == ''){
                                        $error.=$error_sr.". Please enter <b>Email Address</b>.<br>";
                                        $error_sr++;
                                    }
                                }
                            ?>
                            <div class="cell">
                                <span>Facebook Link</span>
                                <input type="text" style="text-transform:lowercase" placeholder="Facebook Link" name="link1"
                                    <?php
                                        if(isset($_POST['link1']))
                                            echo "value=\"".$_POST['link1']."\"";
                                    ?>
                                />
                            </div>
                            <div class="cell">
                                <span>Twitter Link</span>
                                <input type="text" style="text-transform:lowercase" placeholder="Twitter Link" name="link2"
                                    <?php
                                        if(isset($_POST['link2']))
                                            echo "value=\"".$_POST['link2']."\"";
                                    ?>
                                />
                            </div>
                            <div class="cell">
                                <span>LinkedIn Link</span>
                                <input type="text" style="text-transform:lowercase" placeholder="LinkedIn Link" name="link3"
                                    <?php
                                        if(isset($_POST['link3']))
                                            echo "value=\"".$_POST['link3']."\"";
                                    ?>
                                />
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="button" id="search_result" value="Add" name="submit_btn"/>
                    </div>
                </div>
            </form>
            <br>
            <?php
                $error.= "</div>";
                if(isset($_POST['submit_btn'])){
                    if(!isset($_POST['countries']) || !isset($_POST['states']) || !isset($_POST['districts']) || $_POST['countries'] == '0' || $_POST['states'] == '0' || $_POST['districts'] == '0' || $_POST['city'] == '' || $_POST['address'] == '' || $_POST['department'] == '' || $_POST['mobile'] == '' || $_POST['email'] == '' ){
                        echo $error;
                        return false;
                    }
                    else{
                        $country = $_POST['countries'];
                        $state = $_POST['states'];
                        $district = $_POST['districts'];
                        $city = $_POST['city'];
                        $pincode = $_POST['pincode'];
                        $address = $_POST['address'];
                        $department = $_POST['department'];
                        $officer = $_POST['officer'];
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $link1 = $_POST['link1'];
                        $link2 = $_POST['link2'];
                        $link3 = $_POST['link3'];
                    
                        $sel_country_tab_q = "SELECT country_name FROM country_list WHERE country_code = $country LIMIT 1";
                        $sel_country_tab = mysqli_query($db_conn, $sel_country_tab_q);
                        $get_country = mysqli_fetch_array($sel_country_tab);
                        $country_name = $get_country['country_name'];
                        
                        $sel_state_tab_q = "SELECT state_name FROM state_list WHERE country_code = $country AND state_code = $state LIMIT 1";
                        $sel_state_tab = mysqli_query($db_conn, $sel_state_tab_q);
                        $get_state = mysqli_fetch_array($sel_state_tab);
                        $state_name = $get_state['state_name'];

                        $sel_district_tab_q = "SELECT district_name FROM district_list WHERE country_code = $country AND state_code = $state AND district_code = $district LIMIT 1";
                        $sel_district_tab = mysqli_query($db_conn, $sel_district_tab_q);
                        $get_district = mysqli_fetch_array($sel_district_tab);
                        $district_name = $get_district['district_name'];
                        
                        $insert_q = "INSERT INTO `complaint_list`
                        (`id`, `country_code`, `country`, `state_code`, `state`, `distt_code`, `distt`, `city_code`, `city`, `department_code`, `department`, `department_add`, `officer`, `mobile`, `email`, `website`, `social_1`, `social_2`, `social_3`) VALUES ('','$country','$country_name','$state','$state_name','$district','$district_name','$pincode','$city','','$department','$address','$officer','$mobile','$email','','$link1','$link2','$link3')";
                        
                        $insert = mysqli_query($db_conn, $insert_q);
                        
                        echo "<div class='success' style='width:100%;'><b>Congrats!</b> Data has been saved successfuly.</div>";

                        $_POST['countries'] = '';
                        $_POST['states'] = '';
                        $_POST['districts'] = '';
                        $_POST['city'] = '';
                        $_POST['pincode'] = '';
                        $_POST['address'] = '';
                        $_POST['department'] = '';
                        $_POST['officer'] = '';
                        $_POST['mobile'] = '';
                        $_POST['email'] = '';
                        $_POST['link1'] = '';
                        $_POST['link2'] = '';
                        $_POST['link3'] = '';
                    }
                }
            ?>

        </div>
    </div>

</body>
