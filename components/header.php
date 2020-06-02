<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Wrapyourbook</title>
</head>
<body>

<div class="container-fluid" id="header">
    <div class="row" id="header-row">
        <div class='col-1' style="padding: 0">
            <img src="images/logo.png" alt="WYB" id="logo">
        </div>
        <div class='col-11'>
            <h1 id="website-name">wrapyourbook</h1>
        </div>
    </div>

    <div id="banner">
        <h2>You focus on writing great content, <br>we focus on dressing it up.</h2>
    </div>
</div>
<?php  
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

    send_mail('vijay@wrapyourbook.com', 'vijaybhojraj.cm@gmail.com', 'test', 'this is a test message');
?>