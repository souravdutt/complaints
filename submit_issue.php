<?php
    require_once('includes/config/config.php');
?>
<?php
    if(isset($_POST['issue_msg'])){
        $issue_msg = $_POST['issue_msg'];
        $dep_id = $_POST['dep_id'];
        if(!isset($_POST['founder_email']))
            $_POST['founder_email'] = '';
        $founder_email = $_POST['founder_email'];
        $insert_issue_q = "INSERT INTO issues VALUES ('', '$dep_id', '$issue_msg', '$founder_email', '0')";
        mysqli_query($db_conn, $insert_issue_q);
//        echo '<script>alert("Issue submitted successfully!");</script>';
    }else{
        echo '<script>alert("form not submitted")</script>';
        echo 'form not submitted!';
    }
?>