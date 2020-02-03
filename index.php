<?php
    require("includes/header.php");
?>
<?php
    ini_set('display_errors', true);
    error_reporting(E_ALL);
//  var_dump($_POST);
?>
    <div class="container">
        <div class="find_center">            
            <p class="intro">
                get complaint/gravience contact detail of any government/private/public department.
            </p>
            <br>
            <form action="#result_page" method="POST" id="get_form">
                <?php
                    if(isset($_POST['search_result'])){
                        if(!isset($_POST['search']) || empty($_POST['search'] || ($_POST['states'] != '0' && $_POST['districts'] != '0' )))
                            echo '<div class="result_not_found" style="width:100%;margin-bottom:5px;height:40px;opacity:1;">
                                    <b>Ohh!</b> Search Box must not be empty.
                                 </div>';
                    }
                ?>
                <div class="search_box">
                    <div class="white_bg">
                        <div style="width:75%; float:left;">
                            <input type="text" placeholder="search for State / District / City" name="search">
                        </div>
                        <div style="width:25%; float:left;">
                            <input type="submit" class="button" id="search_result" name="search_result" value="Search"/>
                        </div>
                    </div>
                <br>
                <br>
                <br>
                <p class="or">
                    ----- OR -----
                </p>
                <br>
                    <div class="select_opts">
                        <?php
                            //till data available for india only.
                            $_POST['countries'] = '1';
                        
                            if(isset($_POST['search_result'])){
                                if((!isset($_POST['countries']) || $_POST['countries'] == '0') && empty($_POST['search']))
                                    echo '<div class="result_not_found" style="width:100%;margin-bottom:5px;">
                                            Please select <b>Country</b>.
                                         </div>';
                            }
                        ?>
                        <select name="countries" id="countries"  disabled>
                            <option value="0">---Select Country---</option>
                            <option value="1" selected>India</option>
                            <option value="2">USA</option>
                            <option value="3">Russia</option>
                            <option value="4">England</option>
                        </select>
                        <?php
                            if(isset($_POST['search_result'])){
                                if(((!isset($_POST['states']) || $_POST['states'] == '0') && $_POST['countries'] != '0') && empty($_POST['search']))
                                    echo '<div class="result_not_found" style="width:100%;margin:5px 0;">
                                            Please select <b>State</b>.
                                         </div>';
                            }
                        ?>
                        <?php
                            if(isset($_POST['states']) && $_POST['states'] != '0')
                                $state = $_POST['states'];
                        ?>
                        <?php #get state list from database:
                            $sel_state_tab_q = "SELECT * FROM state ORDER BY StateName ASC";
                            $sel_state_tab = mysqli_query($db_conn, $sel_state_tab_q);
                            $get_state_row = mysqli_num_rows($sel_state_tab);
                        ?>
                        <select name="states" id="states" >
                            <option value="0">---Select State---</option>
                            <?php
                                if($get_state_row > 1){
                                    while($get_state = mysqli_fetch_array($sel_state_tab)){
                                        echo "<option value='".$get_state['StCode']."'";
                                        if(isset($state) && $state == $get_state['StCode'])
                                            echo "selected ";
                                        echo "> ".$get_state['StateName']."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <script>
                            $(document).ready(function(){
                                $('#states').change(function(){
                                    $('#get_form').submit();    
                                });

                            })
                        </script>
                        <?php
                            if(isset($_POST['search_result'])){
                                if((!isset($_POST['districts']) || $_POST['districts'] == '0') && ($_POST['countries'] != '0' && $_POST['states'] != '0' ))
                                    echo '<div class="result_not_found" style="width:100%;margin:5px 0;">
                                            Please select <b>Districts</b>.
                                         </div>';
                            }
                        ?>
                        <?php
                            if(isset($_POST['districts']) && $_POST['districts'] != '0')
                                $district = $_POST['districts'];
                        ?>

                        <?php #get district list from database:
                            if(isset($state)){
                                $sel_dist_tab_q = "SELECT * FROM district WHERE StCode = '$state' ORDER BY DistrictName ASC";
                                $sel_dist_tab = mysqli_query($db_conn, $sel_dist_tab_q);
                                $get_dist_row = mysqli_num_rows($sel_dist_tab);
                            }
                        ?>
                        <select name="districts" id="districts">
                            <option value="0">---Select District---</option>
                            <?php
                                if($get_dist_row > 1 && isset($state)){
                                    while($get_dist = mysqli_fetch_array($sel_dist_tab)){
                                        echo "<option value='".$get_dist['DistCode']."'";
                                        if(isset($district) && $district == $get_dist['DistCode'])
                                            echo "selected ";
                                        echo "> ".$get_dist['DistrictName']."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <input type="submit" class="button" id="search_result" value="Search" name="search_result"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['search_result'])){
            if(($_POST['search'] != '') || ($_POST['countries'] != '0' && $_POST['states'] != '0' && $_POST['districts'] != '0')){
                $search = $_POST['search'];
                $state = $_POST['states'];
                $district = $_POST['districts'];
                                
                $sel_tab_obj = new Select_tables($db_conn);
                $sel_tab_obj->sel_comp_table($search, $state, $district);
            }
            else{
            }
        }
    ?>
    <div class="page3" id="page3">
        <div class="container_page3">
            <h1>didn't found, what you're looking for! inform us so we can improve our productivity and needfuls can take banefit.</h1>
            <br>
            <span>Tell us what are you looking for?</span>
            <form id="visitor_req_form" method="post">
                <?php
                    if(isset($_POST['submit_visitor_req'])){
                        if($_POST['dep_name'] == '' || strlen($_POST['dep_name']) < 3){
                            echo"<div class='result_not_found' style='width:100%;'> Please Enter Valid <b>Department Name</b> <small>(it must containes atleast 3 letters)</small></div>";
                            
                        }elseif($_POST['dep_add'] == '' || strlen($_POST['dep_add']) < 7){
                            echo"<div class='result_not_found' style='width:100%;'> Please Enter Valid <b>Department Address</b> <small>(it must containes atleast 7 letters)</small></div>";
                        }elseif($_POST['visitor_mobile'] !='' && strlen($_POST['visitor_mobile']) != 10){
                            echo"<div class='result_not_found' style='width:100%;'> Please Enter Valid <b>Mobile Number</b> <small>(it must containes only 10 letters)</small></div>";
                        }else{
                            $dep_name = $_POST['dep_name'];
                            $dep_add = $_POST['dep_add'];
                            
                            if(!isset($_POST['visitor_email']))
                                $_POST['visitor_email'] = '';
                            $visitor_email = str_replace(" ", "", $_POST['visitor_email']);
                            $visitor_email = strtolower($visitor_email);
                            if(!isset($_POST['visitor_mobile']))
                                $_POST['visitor_mobile'] = '';
                            $visitor_mobile = $_POST['visitor_mobile'];
                            
                            $sel_visitor_req_tab_q ="SELECT * FROM visitor_requests WHERE dep_name = '$dep_name' AND dep_add = '$dep_add'";
                            $sel_visitor_req_tab = mysqli_query($db_conn, $sel_visitor_req_tab_q);
                            $visitor_req_row = mysqli_num_rows($sel_visitor_req_tab);
                            
                            if($visitor_req_row == 0){
                                $add_visitor_req_q = "INSERT INTO `visitor_requests`(`dep_name`, `dep_add`, `visitor_email`, `visitor_mobile`, `request_status`) VALUES ('$dep_name','$dep_add','$visitor_email','$visitor_mobile','0')";
                                $add_visitor_req = mysqli_query($db_conn,$add_visitor_req_q);                                
                            }
                            
                            echo"<div class='result_found' style='width:100%;'><b>Thanks!</b> Your request will be resolved shortly.</div>";
                            $_POST['dep_name'] = null;
                            $_POST['dep_add'] = null;
                            $_POST['visitor_email'] = null;
                            $_POST['visitor_mobile'] = null;
                        }
                    }
                ?>
                <ul>
                    <li>
                        <label for="dep_name">Department Name*</label>
                        <input type="text" id="dep_name" name="dep_name" placeholder="Department Name"
                            <?php
                                if(isset($_POST['submit_visitor_req'])){
                                    if($_POST['dep_name'] != ''){
                                        echo "value=".$_POST['dep_name'];
                                    }
                                }   
                            ?>
                        />
                    </li>
                </ul>
                <ul>
                    <li>
                        <label for="dep_add">Department Address*</label>
                        <input type="text" id="dep_add" name="dep_add" placeholder="Department Address"
                            <?php
                                if(isset($_POST['submit_visitor_req'])){
                                    if($_POST['dep_add'] != ''){
                                        echo "value=".$_POST['dep_add'];
                                    }
                                }   
                            ?>
                        />
                    </li>
                </ul>
                <ul>
                    <li>
                        <label for="email">Your Email</label>
                        <input type="text" id="email" name="visitor_email" placeholder="Your Email"
                            <?php
                                if(isset($_POST['submit_visitor_req'])){
                                    if($_POST['visitor_email'] != ''){
                                        echo "value=".$_POST['visitor_email'];
                                    }
                                }   
                            ?>
                        />
                    </li>
                </ul>
                <ul>
                    <li>
                        <label for="mobile">Your Mobile Number</label>
                        <input type="text" id="mobile" name="visitor_mobile" placeholder="Your Mobile Number"
                            <?php
                                if(isset($_POST['submit_visitor_req'])){
                                    if($_POST['visitor_mobile'] != ''){
                                        echo "value=".$_POST['visitor_mobile'];
                                    }
                                }   
                            ?>
                        />
                    </li>
                </ul>
                <button type="" id="submit_visitor_req" style="background:#4caf50;" name="submit_visitor_req">Submit</button>
                <button type="reset" id="submit_visitor_req" name="submit_visitor_req">Reset</button>
            </form>
       </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".report_toggler").click(function() {
                $(this).siblings(".report_form").slideToggle();
            });
            $('.report_form').submit(function(){
                return false;
            });
            $('.issue_btn').click(function() {
                var issue_msg = '';
                issue_msg = $(this).siblings('.issue_msg').val();
                if (issue_msg == '') {
                    alert("Please enter the Issue!");
                    $('.issue_msg').focus();
                } else {
                    if (confirm("Are you sure want to submit the issue!")) {
                        var data = $(this).parents('#report_form').serializeArray();
                        $.post($(".report_form").attr("action"), data, function(info){
                            $('.report_form').append(info);
                        });
                        $(this).siblings('.issue_msg').val('');
                        $(this).siblings('.founder_email').val('');
                        alert("Issue submitted successfully!");
                        $(this).parent('.report_form').slideUp().delay(5000);
                    } else {
//                        alert("Please try again, issue has not been submitted.");
                        return false;
                    }
                }
            });
            $('.report_form').submit(function(){
                return false;
            });
        });
    </script>
