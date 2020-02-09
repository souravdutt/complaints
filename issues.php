<?php
    require_once("includes/config/config.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitors Requests</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="shortcut" href="assets/images/icon/title.png">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
        <div class="container" style="width:100%; overflow-x: hidden;">
        <div style="color:white; position:absolute; top:10px; right:20px; font-size:110%; display:felx; float:right">
            <a href="index.php" target="_blank" style="margin: 0 10px; color:white;">Home</a>
            <a href="admin.php" style="margin: 0 10px; color:white;">Add Data</a>
            <a href="requests.php" style="margin: 0 10px; color:white;">Requests</a>
        </div>
        <div class="find_center">
            <?php
                $sel_issues_tab_q = "SELECT * FROM issues WHERE issue_status=0 ORDER BY id ASC";
                $sel_issues_tab = mysqli_query($db_conn, $sel_issues_tab_q);
                $issues_tab_row = mysqli_num_rows($sel_issues_tab);
            ?>
            <p class="intro">
                <?php 
                    if($issues_tab_row > 1){
                ?>
                        Here are <?php echo $issues_tab_row; ?> Pending <b>Issues</b> Reported, by the visitors.
                <?php
                    }else{
                ?>
                        Here is <?php echo $issues_tab_row; ?> Pending <b>Issue</b> Reported, by the visitors.
                <?php
                    }
                ?>
            </p>
            <br>
            <br>
            <form action="" method="POST" id="requests_form" autocomplete="off">
                <div class="search_box">
                    <div class="select_opts">
                        <div class="row title_row" style="text-align:center;margin-bottom:10px; font-size:120%">
                            <div class="cell_half">
                                <span>Serial</span>
                            </div>
                            <div class="cell">
                                <span>Department</span>
                            </div>
                            <div class="cell_half">
                                <span>City</span>
                            </div>
                            <div class="cell_half">
                                <span>District</span>
                            </div>
                            <div class="cell_half">
                                <span>State</span>
                            </div>
                            <div class="cell">
                                <span>Reported Issue</span>
                            </div>
                            <div class="cell">
                                <span>Founder's email</span>
                            </div>
                            <div class="cell">
                                <span>Action</span>
                            </div>
                        </div>
                        <?php
                            if($issues_tab_row > 0){
                                $sr = 1;
                                while($get_issue_data = mysqli_fetch_array($sel_issues_tab)){
                                        
                                    $sel_comp_list_tab_q = "SELECT * FROM `complaint_list` WHERE id = ".$get_issue_data['dep_id'];
                                    $sel_comp_list_tab = mysqli_query($db_conn, $sel_comp_list_tab_q);
//                                    $comp_list_tab_row = mysqli_num_rows($sel_comp_list_tab);

                                    while($get_comp_list_data = mysqli_fetch_array($sel_comp_list_tab)){
                                        echo '
                                        <form action="issues.php" method="POST">
                                        <div class="row">
                                            <div class="cell_half">
                                                <input type="text" placeholder="sr" name="serial" value="'.$sr.'" style="text-align:center" readonly/>
                                                <input type="text" name="req_id" value="'.$get_issue_data["id"].'" hidden readonly/>
                                            </div>
                                                <input type="text" class="dep_id" name="dep_id" value="'.$get_comp_list_data["id"].'" hidden readonly/>
                                            <div class="cell">
                                                <input type="text" class="department" name="department" value="'.$get_comp_list_data["department"].'" readonly/>
                                            </div>
                                                <input type="text" class="department_add" name="department_add" value="'.$get_comp_list_data["department_add"].'" hidden readonly/>
                                            <div class="cell_half">
                                                <input type="text" class="city" name="city" value="'.$get_comp_list_data["city"].'" readonly/>
                                            </div>
                                                <input type="text" class="pincode" name="pincode" value="'.$get_comp_list_data["city_code"].'" hidden readonly/>
                                            <div class="cell_half">
                                                <input type="text" class="distt" name="distt" value="'.$get_comp_list_data["distt"].'" readonly/>
                                            </div>
                                            <div class="cell_half">
                                                <input type="text" class="state" name="state" value="'.$get_comp_list_data["state"].'" readonly/>
                                            </div>
                                                <input type="text" class="distt_code" name="distt_code" value="'.$get_comp_list_data["distt_code"].'" hidden readonly/>
                                                <input type="text" class="state_code" name="state_code" value="'.$get_comp_list_data["state_code"].'" hidden readonly/>
                                                <input type="text" class="officer" name="officer" value="'.$get_comp_list_data["officer"].'" hidden readonly/>
                                                <input type="text" class="mobile" name="mobile" value="'.$get_comp_list_data["mobile"].'" hidden readonly/>
                                                <input type="text" class="email" name="email" value="'.$get_comp_list_data["email"].'" hidden readonly/>
                                                <input type="text" class="website" name="website" value="'.$get_comp_list_data["website"].'" hidden readonly/>
                                                <input type="text" class="fb_link" name="fb_link" value="'.$get_comp_list_data["social_1"].'" hidden readonly/>
                                                <input type="text" class="twit_link" name="twit_link" value="'.$get_comp_list_data["social_2"].'" hidden readonly/>
                                                <input type="text" class="linked_link" name="linked_link" value="'.$get_comp_list_data["social_3"].'" hidden readonly/>
                                            <div class="cell">
                                                <input type="text" name="issue" value="'.$get_issue_data["issue"].'" readonly/>
                                            </div>
                                            <div class="cell">
                                                <input type="text" class="dep_name" name="dep_name" value="'.$get_issue_data["founder_email"].'" readonly/>
                                            </div>
                                            <div class="cell_btn" style="padding:5px 0;">
                                                <button type="submit" class="done_btn btn_half" name="done_btn" style="background:#4caf50;">Done</button>
                                                <button type="button" class="add_btn btn_half" name="add_btn">Solve</button>
                                            </div>
                                        </div>
                                        </form>';
                                        $sr++;
                                    }
                                }
                            }
                            else{
                                echo "<div class='error' style='width:80%;'><strong>Oh!</strong> no pending request found</div>";
                            }
                            if(isset($_POST['done_btn'])){
                                $update_req_table_q = "UPDATE issues SET issue_status='1' WHERE id='".$_POST['req_id']."'";
                                $update_req_table = mysqli_query($db_conn, $update_req_table_q);
                            }
                        ?>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.done_btn').click(function(){
                $(this).parents('.row').slideUp();
            });
            $('.add_btn').click(function(){
                var dep_id = $('.dep_id').val()
                var dep_name = $('.department').val()
                var dep_add = $('.department_add').val()
                var city = $('.city').val()
                var state = $('.state_code').val()
                var distt = $('.distt_code').val()
                var pincode = $('.pincode').val()
                var officer = $('.officer').val()
                var mobile = $('.mobile').val()
                var email = $('.email').val()
                var website = $('.website').val()
                var fb_link = $('.fb_link').val()
                var twit_link = $('.twit_link').val()
                var linked_link = $('.linked_link').val()
                window.open('admin.php?id='+dep_id+'&state='+state+'&distt='+distt+'&city='+city+'&pincode='+pincode+'&department='+dep_name+'&address='+dep_add+'&officer='+officer+'&mobile='+mobile+'&email='+email+'&website='+website+'&link1='+fb_link+'&link2='+twit_link+'&link3='+linked_link, '_blank');
            });
        });
    </script>
</body>