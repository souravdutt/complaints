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
            <a href="issues.php" style="margin: 0 10px; color:white;">Issues</a>
        </div>
        <div class="find_center">
            <?php
                $sel_visitor_tab_q = "SELECT * FROM visitor_requests WHERE request_status=0 ORDER BY id ASC";
                $sel_visitor_tab = mysqli_query($db_conn, $sel_visitor_tab_q);
                $visitor_tab_row = mysqli_num_rows($sel_visitor_tab);
            ?>
            <p class="intro">
                <?php 
                    if($visitor_tab_row > 1){
                ?>
                        Here are <?php echo $visitor_tab_row; ?> <b>Visitors Requests</b> Pending, to add data for the perticular department.
                <?php
                    }else{
                ?>
                        Here is <?php echo $visitor_tab_row; ?> <b>Visitors Request</b> Pending, to add data for the perticular department.
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
                                <span>Visiotr's Email</span>
                            </div>
                            <div class="cell">
                                <span>Visitor's Mobile</span>
                            </div>
                            <div class="cell">
                                <span>Department Name</span>
                            </div>
                            <div class="cell">
                                <span>Department Address</span>
                            </div>
                            <div class="cell">
                                <span>Action</span>
                            </div>
                        </div>
                        <?php
                            if($visitor_tab_row > 0){
                                $sr = 1;
                                while($get_data = mysqli_fetch_array($sel_visitor_tab)){
                                    echo '
                                    <form action="requests.php" method="POST">
                                    <div class="row">
                                        <div class="cell_half">
                                            <input type="text" placeholder="sr" name="serial" value="'.$sr.'" style="text-align:center" readonly/>
                                            <input type="number" name="req_id" value="'.$get_data["id"].'" hidden readonly/>
                                        </div>
                                        <div class="cell">
                                            <input type="email" name="visitor_email" value="'.$get_data["visitor_email"].'" readonly/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" name="visitor_mobile" value="'.$get_data["visitor_mobile"].'" readonly/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" class="dep_name" name="dep_name" value="'.$get_data["dep_name"].'" readonly/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" class="dep_add" name="dep_add" value="'.$get_data["dep_add"].'" readonly/>
                                        </div>
                                        <div class="cell_btn" style="padding:5px 0;">
                                            <button type="submit" class="done_btn btn_half" name="done_btn" style="background:#4caf50;">Done</button>
                                            <button type="button" class="add_btn btn_half" name="add_btn">Add</button>
                                        </div>
                                    </div>
                                    </form>';
                                    $sr++;
                                }
                            }
                            else{
                                echo "<div class='error' style='width:80%;'><strong>Oh!</strong> no pending request found</div>";
                            }
                            if(isset($_POST['done_btn'])){
                                $update_req_table_q = "UPDATE visitor_requests SET request_status='1' WHERE id='".$_POST['req_id']."'";
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
                var dep_name = $('.dep_name').val()
                var dep_add = $('.dep_add').val()
                window.open('admin.php?department='+dep_name+'&address='+dep_add, '_blank');
            });
        });
    </script>
</body>