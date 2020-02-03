<?php
    include("../includes/config/config.php");
?>
<?php
    $issue_msg = $_POST['issue_msg'];
    $founder_email = $_POST['founder_email'];
    $insert_issue_q = "INSERT INTO issues VALUES ('', '', '$issue_msg', '$founder_email')";
    $insert_issue = mysqli_query($db_conn, $insert_issue_q);
    if($insert_issue)
        echo 'issue inserted successfully!';
?>