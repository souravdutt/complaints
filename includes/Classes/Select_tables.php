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
                                <div class="list_title">
                                    '.$sr.'. '.$get_data['department'].', '.$get_data['state'].'
                                </div>';
//                    echo'
//                                <ul>
//                                    <li><div class="label">Sr</div></li>
//                                    <li><input type="text" value="'.$sr.'" readonly></li>
//                                </ul>
//                                <ul>
//                                    <li><div class="label">Department Name</div></li>
//                                    <li><input type="text" value="'.$get_data['department'].'" readonly></li>
//                                </ul>
                    echo '
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
                                    <li><a target="_blank" href="https://'.$get_data['website'].'"><input class="website" class="pointer" type="text" value="'.$get_data['website'].'" readonly></a></li>
                                </ul>
                                <ul>
                                    <li><div class="label">Social Links</div></li>
                                    <li>
                                        <a target="_blank" href="'.$get_data['social_1'].'"><img src="assets/images/icon/fb_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_2'].'"><img src="assets/images/icon/twitter_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_3'].'"><img src="assets/images/icon/linkedin_logo.png"></a>
                                    </li>
                                </ul>
                                <div class="togglers report_toggler">Report</div>
                                <div class="togglers comments_toggler">Comments</div>
                                <div class="togglers review_toggler">Reviews</div>
                                <form class="report_form" id="report_form" action="submit_issue.php" method="post">
                                    <input type="text" class="issue_msg" name="issue_msg" placeholder="Enter issue..." style=""/>
                                    <input type="text" class="dep_id" value="'.$get_data['id'].'" name="dep_id" hidden>
                                    <input type="email" class="founder_email" name="founder_email" placeholder="Your Email ID (Optional)"/>
                                    <button type="button" class="issue_btn" name="issue_btn">Submit Issue</button>
                                </form>
                                <hr>
                        ';
                    $sel_com_table_q = "SELECT * FROM comments WHERE dep_id = '".$get_data['id']."'";
                    $sel_com_table = mysqli_query($this->connection, $sel_com_table_q);
                    $sel_com_table_rows = mysqli_num_rows($sel_com_table);
                    if($sel_com_table_rows > 0){
                        echo '<div class="comment_section">
                                <div class="title">Comments:</div>';
                        while($get_comments = mysqli_fetch_array($sel_com_table)){
                            echo '
                                    <div class="prev_comments">
                                        <span class="prev_com_name">'.$get_comments['name'].'</span><span class="prev_com_time"> on '.date('d/m/Y',strtotime($get_comments['date'])).' at '.date('h:i A',strtotime($get_comments['time'])).'</span>
                                        <br>
                                        <div class="prev_comment_text">- '.$get_comments['comment'].'</div>
                                    </div>
                            ';
                        }
                                    
                        echo'       <form class="comment_form" id="comment_form" action="submit_comment.php" method="POST">
                                        <div class="add_com_toggler togglers">Click to Add Comment</div>
                                        <hr>
                                        <div class="new_comment_sec">
                                            <div class="title">Add Comment:</div>
                                            <ul>
                                                <li>Enter Your Name : </li>
                                                <li><input type="text" class="commentator_name" name="commentator_name" placeholder="Enter Your Name"></li>
                                                <li>Your Email (Optional) : </li>
                                                <li><input type="email" class="commentator_email" name="commentator_email" placeholder="Enter Your Email ID"></li>
                                            </ul>
                                            <input type="number" name="dep_id" value="'.$get_data['id'].'" readonly hidden>
                                            <textarea class="add_comment comment_text" id="comment_text" name="comment_text" placeholder="Add Comment... (Maximum 250 letters)" maxlength="250"></textarea>
                                            <button type="submit" class="submit_comment" name="submit_comment"> Add Comment </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr style="width:80%; margin:auto;">';
                    }else{
                        echo '<div class="comment_section">
                                  <div class="result_not_found" style="width:100%; margin:5px 0;">No comments found, click below to add new comment.</div>
                                  <form class="comment_form" id="comment_form" action="submit_comment.php" method="POST">
                                        <div class="add_com_toggler togglers">Click to Add Comment</div>
                                        <hr>
                                        <div class="new_comment_sec">
                                            <div class="title">Add Comment:</div>
                                            <ul>
                                                <li>Enter Your Name : </li>
                                                <li><input type="text" class="commentator_name" name="commentator_name" placeholder="Enter Your Name"></li>
                                                <li>Your Email (Optional) : </li>
                                                <li><input type="email" class="commentator_email" name="commentator_email" placeholder="Enter Your Email ID"></li>
                                            </ul>
                                            <input type="number" name="dep_id" value="'.$get_data['id'].'" readonly hidden>
                                            <textarea class="add_comment comment_text" id="comment_text" name="comment_text" placeholder="Add Comment... (Maximum 250 letters)" maxlength="250"></textarea>
                                            <button type="submit" class="submit_comment" name="submit_comment"> Add Comment </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr style="width:80%; margin:auto;">
                            </div>';
                    }
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
