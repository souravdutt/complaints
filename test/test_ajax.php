<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test Ajax</title>
</head>

<body>
    <form class="issue_form" id="issue_form" action="test_issue.php" method="post">
        Issue: <input type="text" class="issue_msg" id="issue_msg" name="issue_msg" placeholder="enter issue" />
        <br>
        email: <input type="email" class="founder_email" id="founder_email" name="founder_email" placeholder="Your Email" />
        <br>
        <button type="button" class="issue_btn" id="issue_btn" name="issue_btn">Submit Issue</button>
    </form>

    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.issue_btn').click(function() {
                var issue_msg = $('.issue_msg').val();
                if (issue_msg == '') {
                    alert("Please enter the issue you found!");
                }else{
                    if(confirm("Are you sure, want so submit the issue!")){
                        var data = $('#issue_form').serializeArray();
                        $.post($(".issue_form").attr("action"), data, function(info){
                            $('.issue_form').append(info);
                        });
                        alert("issue submitted");
                    }else{
                        alert("issue not submitted");
                    }
                }
            });
            $('.issue_form').submit(function(){
                return false;
            });
        });
    </script>

</body>

</html>