<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "complaints";
    
    $db_conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if(!$db_conn){
        echo"<span style='color:red; font-weight:600;'>
                Jnaab Database se apki website connect nahin ho rahi hai! (zyada jankari ke liye configration check kren.) Ya phir databse connection check karo. Dhannwad!
            </span>";
        die();
    }
    $que_sel_tab_count = "SELECT * FROM 'country_list'";
    $sel_tab_count = mysqli_query($db_conn, $que_sel_tab_count);


?>