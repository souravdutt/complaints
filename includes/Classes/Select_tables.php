<?php
    class Select_tables{
        private $connection;
        private $table_name;
        private $que_sel_table;
        public function __construct($db_conn){
            $this->connection = $db_conn;
        }
        
        #method to select complaint_list table:
        public function sel_comp_table($search, $state, $district){
            $table_name = "complaint_list";
            if($search != '')
                $que_sel_table = "SELECT * FROM $table_name WHERE state LIKE '%$search%' OR distt LIKE '%$search%' OR city LIKE '%$search%' OR department LIKE '%$search%'";
            else
                $que_sel_table = "SELECT * FROM $table_name WHERE state_code = $state AND distt_code = $district";
            
            $sel_table = mysqli_query($this->connection, $que_sel_table);
            
            $row = mysqli_num_rows($sel_table);
            if($row < 1){
                    echo '<div class="page2" id="result_page">
                            <div class="result_not_found">
                                <b>Sorry!</b> No result found.
                            </div>
                         </div>';
            }
            else{
                $sr = 1;
                    echo '<div class="page2" id="result_page">
                            <div class="result_found">
                                <b>Congrats!</b> Following results are founded:
                            </div>';
                while($get_data = mysqli_fetch_array($sel_table)){
                    echo '<div class="result_list" id="result_list">
                                <ul>
                                    <li><div class="label">Sr</div></li>
                                    <li><input type="text" value="'.$sr.'" readonly></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Department Name</div></li>
                                    <li><input type="text" value="'.$get_data['department'].'" readonly></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Department Address</div></li>
                                    <li><textarea style="text-transform:capitalize;" readonly>'.$get_data['department_add'].', '.$get_data['city'].', District: '.$get_data['distt'].', State: '.$get_data['state'].'</textarea></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Office Name / Designation</div></li>
                                    <li><textarea style="text-transform:capitalize;" readonly>'.$get_data['officer'].'</textarea></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Contact Number</div></li>
                                    <li><input type="text" value="'.$get_data['mobile'].'" readonly></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Email Address</div></li>
                                    <li><input type="email" style="text-transform:lowercase;" value="'.$get_data['email'].'" readonly></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Official Websites</div></li>
                                    <li><a target="_blank" href="https://'.$get_data['website'].'"><input class="pointer" type="text" value="'.$get_data['website'].'" readonly></a></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Social Links</div></li>
                                    <li>
                                        <a target="_blank" href="'.$get_data['social_1'].'"><img src="assets/images/icon/fb_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_2'].'"><img src="assets/images/icon/twitter_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_3'].'"><img src="assets/images/icon/linkedin_logo.png"></a>
                                    </li>
                                </ul>
                                <div class="report_toggler" style="text-align:right; padding:10px;">
                                    <div style="color:blue;cursor:pointer;text-decoration:underline;">Report</div>
                                </div>
                                <form class="report_form" id="report_form" action="submit_issue.php" method="post">
                                    <input type="text" class="issue_msg" name="issue_msg" placeholder="Enter issue..." style=""/>
                                    <input type="text" class="dep_id" value="'.$get_data['id'].'" name="dep_id" hidden>
                                    <input type="email" class="founder_email" placeholder="Your Email ID (Optional)" name="founder_email" style=""/>
                                    <button type="button" class="issue_btn" name="issue_btn">Submit Issue</button>
                                </form>
                            </div>
                            <hr style="width:80%; margin:auto;">';
                    $sr++;
                }
                echo '</div>';
            }
            
        }
    }
//    if(isset($_POST['issue_btn'])){
//        if(isset($_POST['issue_msg'])){
//            $issue = $_POST['issue_msg'];
//            $dep_id = $_POST['dep_id'];
//            if(!isset($_POST['founder_email']))
//                $_POST['founder_email'] = '';
//            $founder_email = $_POST['founder_email'];
//            $insert_issue_q = "INSERT INTO issues (dep_id, issue, founder_email) VALUES ('$dep_id', '$issue', '$founder_email')";
//            $isert_issue = mysqli_query($db_conn, $insert_issue_q);
//            
//            #submit search result
//            $_POST['search_result'] = "search";
//            
//        }

//    }

?>
