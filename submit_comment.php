<?php
    require_once('includes/config/config.php');
?>
<?php
    if($_POST['commentator_name'] != '' && $_POST['comment_text'] != ''){
        $dep_id = $_POST['dep_id'];
        $name = $_POST['commentator_name'];
        $email = $_POST['commentator_email'];
        $comment = $_POST['comment_text'];
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $insert_com_q = "INSERT INTO comments VALUES('', '$dep_id', '$name', '$email', '$comment', '$date', '$time')";
        $insert_com = mysqli_query($db_conn, $insert_com_q);
//        echo '<script>alert("Congrats! Comment has been submitted Successfully.")</script>';
    }elseif($_POST['commentator_name'] == ''){
        echo '<script>alert("Oh! No, Please enter your Name to submit the Comment.")</script>';
    }elseif($_POST['comment_text'] == ''){
        echo '<script>alert("Oh! No, Please enter something in comment area.")</script>';
    }
?>