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
        </div>
        <div class="find_center">            
            <p class="intro">
                Here are 121 <b>Visitors Requests</b>, to add data for the perticular department.
            </p>
            <br>
            <br>
            <form action="" method="POST" id="add_form" autocomplete="off">
                <div class="search_box">
                    <div class="select_opts">
                        <div class="row">
                            <div class="cell">
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
                            $sel_visitor_tab_q = "SELECT * FROM visitor_requests ORDER BY id ASC";
                            $sel_visitor_tab = mysqli_query($db_conn, $sel_visitor_tab_q);
                            $visitor_tab_row = mysqli_num_rows($sel_visitor_tab);
                            if($visitor_tab_row > 0){
                                while($get_data = mysqli_fetch_array($sel_visitor_tab)){
                                    $sr = 1;
                                    echo '
                                    <div class="row">
                                        <div class="cell">
                                            <input type="text" placeholder="sr" name="serial" value="'.$sr.'" disabled/>
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
                                        <div class="cell">
                                            <button type="button" name="action">Action</button>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</body>
