<?php
    if(isset($_POST['submit_btn'])){
        if(!isset($_POST['countries']) || !isset($_POST['states']) || !isset($_POST['districts']) || $_POST['countries'] == '0' || $_POST['states'] == '0' || $_POST['districts'] == '0' || $_POST['city'] == '' || $_POST['address'] == '' || $_POST['department'] == '' || $_POST['mobile'] == '' || $_POST['email'] == '' ){
            $error.= "</div>";
            echo $error;
            return false;
        }
        else{
            $country = $_POST['countries'];
            $state = $_POST['states'];
            $district = $_POST['districts'];
            $city = $_POST['city'];
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

            $sel_district_tab_q = "SELECT district_name FROM district_list WHERE country_code = $country AND state_code = $state AND distrcit_code = $district LIMIT 1";
            $sel_district_tab = mysqli_query($db_conn, $sel_district_tab_q);
            $get_district = mysqli_fetch_array($sel_country_tab);
            $district_name = $get_district['district_name'];

            $insert_q = "INSERT INTO `complaint_list`
            (`id`, `country_code`, `country`, `state_code`, `state`, `distt_code`, `distt`, `city_code`, `city`, `department_code`, `department`, `department_add`, `officer`, `mobile`, `email`, `website`, `social_1`, `social_2`, `social_3`) VALUES ('','$country','$country_name','$state','$state_name','$district','$district_name','$city','','','$department','$address','$officer','$mobile','$email','','$link1','$link2','$link3')";
            $insert = mysqli_query($db_conn, $insert_q);

            $success = "<div class='success'>Congrats!, Data inserted successfuly.";
        }
    }
?>
