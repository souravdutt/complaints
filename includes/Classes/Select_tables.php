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
                    echo '<div class="result_list">
                                <ul>
                                    <li>Sr</li>
                                    <li><input type="text" value="'.$sr.'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Department Name</li>
                                    <li><input type="text" value="'.$get_data['department'].'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Department Address</li>
                                    <li><input type="text" style="text-transform:capitalize;" value="'.$get_data['department_add'].', '.$get_data['city'].'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Office Name / Designation</li>
                                    <li><input type="text" style="text-transform:capitalize;" value="'.$get_data['officer'].'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Contact Number</li>
                                    <li><input type="text" value="'.$get_data['mobile'].'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Email Address</li>
                                    <li><input type="email" style="text-transform:lowercase;" value="'.$get_data['email'].'" disabled></li>
                                </ul>
                                <ul>
                                    <li>Official Websites</li>
                                    <li><a target="_blank" href="https://'.$get_data['website'].'"><input class="pointer" type="text" value="'.$get_data['website'].'" disabled></a></li>
                                </ul>
                                <ul>
                                    <li>Social Links</li>
                                    <li>
                                        <a target="_blank" href="'.$get_data['social_1'].'"><img src="assets/images/icon/fb_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_2'].'"><img src="assets/images/icon/twitter_logo.png"></a>
                                        <a target="_blank" href="'.$get_data['social_3'].'"><img src="assets/images/icon/linkedin_logo.png"></a>
                                    </li>
                                </ul>
                            </div>';
                    $sr++;
                }
                echo '</div>';
            }
            
        }
    }

?>