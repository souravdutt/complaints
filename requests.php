<?php
    require_once("includes/config/config.php");
?>
<script>
    window.setTimeout(document.requests.submit.bind(document.requests), 2000);
</script>

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
        </div>
        <?php
            $sel_visitor_tab_q = "SELECT * FROM visitor_requests WHERE request_status=0 ORDER BY id ASC";
            $sel_visitor_tab = mysqli_query($db_conn, $sel_visitor_tab_q);
            $visitor_tab_row = mysqli_num_rows($sel_visitor_tab);    
        ?>
        <div class="find_center">            
            <p class="intro">
                <?php
                    if($visitor_tab_row > 0)
                        echo 'Here are '.$visitor_tab_row.' <b>Visitors Requests</b>, to add data for the perticular department.';
                    else
                        echo 'Here is 0 (zero) <b>Visitors Requests</b>, to add data for the perticular department.';
                ?>
                
                
            </p>
            <br>
            <br>
            <form action="" method="POST" id="add_form" autocomplete="off">
                <div class="search_box">
                    <div class="select_opts">
                        <div class="row title_row" style="text-align:center;margin-bottom:10px; font-size:120%">
                            <div class="cell" style="width:50%;">
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
                                    <form name="requests" id="requests" action="requests.php" method="POST">
                                    <div class="row">
                                        <div class="cell" style="width:50%;">
                                            <input type="text" placeholder="sr" name="serial" value="'.$sr.'" style="text-align:center" disabled/>
                                        </div>
                                        <div class="cell" style="display:none">
                                            <input type="number" name="req_id" value="'.$get_data["id"].'"/>
                                        </div>
                                        <div class="cell">
                                            <input type="email" name="visitor_email" value="'.$get_data["visitor_email"].'" disabled/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" name="visitor_mobile" value="'.$get_data["visitor_mobile"].'" disabled/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" name="dep_name" value="'.$get_data["dep_name"].'" disabled/>
                                        </div>
                                        <div class="cell">
                                            <input type="text" name="dep_add" value="'.$get_data["dep_add"].'" disabled/>
                                        </div>
                                        <div class="cell" style="padding:5px 0;">
                                            <button type="submit" class="done_btn" name="done_btn" style="width:48.5%;background:#4caf50;">Done</button>
                                            <button type="button" class="add_btn" name="add_btn" style="width:48.5%;">Add</button>
                                        </div>
                                    </div>
                                    </form>';
                                    $sr++;
                                }
                            }
                            else{
                                echo "<div class='error' style='width:80%;'><strong>Oh!</strong> no pending request found</div>";
                            }
                            if(isset($_REQUEST['done_btn'])){
                                $update_req_table_q = "UPDATE visitor_requests SET request_status='1' WHERE id='".$_REQUEST['req_id']."'";
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
        });
    </script>
</body>
