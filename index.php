<?php
    require("includes/header.php");
?>
    <div class="container">
        <div class="find_center">            
            <p class="intro">
                get complaint/gravience contact detail of any government/private/public department.
            </p>
            <br>
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
                            <input type="text" placeholder="search for State / District / City" name="search" autofocus>
                        </div>
                        <div style="width:25%; float:left;">
                            <input type="submit" class="button" id="search_result" name="search_result" value="Search"/>
                        </div>
                    </div>
                <br>
                <br>
                <p class="or">
                    - - - OR - - -
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
                        <?php #get state list from database:
                            $sel_state_tab_q = "SELECT * FROM state";
                            $sel_state_tab = mysqli_query($db_conn, $sel_state_tab_q);
                            $get_state_row = mysqli_num_rows($sel_state_tab);
                        ?>
                        <select name="states" id="states" >
                            <option value="0">---Select State---</option>
                            <?php
                                if($get_state_row > 1){
                                    while($get_state = mysqli_fetch_array($sel_state_tab)){
                                        echo "<option value='".$get_state['StCode']."'";
                                        if(isset($state) && $state == $get_state['StCode']) echo "selected";
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

                        <?php #get district list from database:
                            if(isset($state)){
                                $sel_dist_tab_q = "SELECT * FROM district WHERE StCode = '$state'";
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
                                        if(isset($district) && $district == $get_dist['DistCode']) echo "selected";
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
                return false;
            }
        }
    ?>



    <script>
        $(document).ready(function()){
            $('#search_result').onclick(function(){
                document.location.href = "index/#result_page";
            });
        }
    </script>
