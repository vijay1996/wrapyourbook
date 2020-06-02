<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mediastyle.css">
    <link rel="shortcut icon" href="images/footer-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Wrapyourbook</title>
</head>
<body>
<p style="text-align: right;">Need help? Drop a mail at: <span style="color: #0000ff">support@wrapyourbook.com</span>.</p>
<div class="container-fluid" id="header">
    <div class="row" id="header-row">
        <div class='col-1' style="padding: 0">
        <a href="https://www.wrapyourbook.com"><img src="images/logo.png" alt="WYB" id="logo"></a>
        </div>
        <div class='col-11'>
            <a href="https://www.wrapyourbook.com" style="text-decoration: none"><h1 id="website-name">wrapyourbook</h1></a>
        </div>
    </div>

    <div id="banner">
        <h2>You focus on writing great content, <br>we focus on dressing it up.</h2>
    </div>
</div>
<?php  
    
    $website = 'https://www.wrapyourbook.com';
    function insert_ticket ($ticket_id, $transaction_id, $user_id, $ticket_page) {
        $servername = '194.59.164.23';
        $dbname = 'u793208810_4ywBY';
        $username = 'u793208810_b5inZ';
        $password = 'puneroti-96';
        $conn = new mysqli($servername, $username, $password, $dbname);
        $insert_ticket_query = "INSERT INTO tickets VALUES ('" . $ticket_id . "','" . $transaction_id . "','" . $user_id . "','" .$ticket_page . "', 'FALSE', CURRENT_TIMESTAMP);";
        if($conn->query($insert_ticket_query) !== TRUE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function send_mail($from, $to, $subject, $text) {
        $headers = "From:".$from;
        mail($to,$subject,$text,$headers);
    }
?>