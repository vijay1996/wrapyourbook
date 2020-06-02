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

    <div class="row" id="header-row">
        <div class='col-1' style="padding: 0">
            <a href="index.php"><img src="images/logo.png" alt="WYB" id="logo"></a>
        </div>
        <div class='col-11'>
            <a href="index.php"><h1 id="website-name">wrapyourbook</h1></a>
        </div>
    </div>

<?php
    $website = "http://localhost:8080";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $plan = $_POST['plan'];
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $color = $_POST['color'];
    $kewords = $_POST['keywords'];
    $remarks = $_POST['remarks'];

    if ($plan == 'sapling') {
        $amount = 10;
        $productid = 'P20200525000001';
    } elseif ($plan == 'plant') {
        $amount = 20;
        $productid = 'P20200525000002';
    } else {
        $amount = 40;
        $productid = 'P20200525000003';
    }

    $servername = '194.59.164.23';
    $dbname = 'u793208810_4ywBY';
    $username = 'u793208810_b5inZ';
    $password = 'puneroti-96';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    $select_user = "SELECT user_id FROM users WHERE user_email = '" . $email . "';";
    $result = $conn->query($select_user) or die('kindly refresh!');
    $rows = $result->fetch_assoc();
    if (sizeof($rows) == 0) {
        $user_id = 'us' . time();
        $insert_query = "INSERT INTO users VALUES ('" . $user_id . "','" . $name . "','" . $email . "'," . "CURRENT_TIMESTAMP);";
        if($conn->query($insert_query) !== TRUE) {
            die('Could not add user');
        }
    } else {
        $user_id = $rows['user_id'];
    }

    $order_id = 'or' . time();
    $insert_query = "INSERT INTO orders VALUES ('" . $order_id . "','" . $bookname . "','" . $author . "','" . $genre . "','" . $color . "','" . $kewords . "','" . $remarks . "'," . "CURRENT_TIMESTAMP);";
    if($conn->query($insert_query) !== TRUE) {
        die("Could not create the order");
    }
    $transaction_id = 'tr' . time();
    $insert_query = "INSERT INTO transactions VALUES ('" . $transaction_id . "','" . $user_id . "','" . $productid . "','" . $order_id . "','FALSE', CURRENT_TIMESTAMP);";
    if($conn->query($insert_query)!==TRUE) {
        die('Could not initiate transaction');
    }
?>
<script src="https://www.paypal.com/sdk/js?client-id=Ad87o1Sp5eUGJbW9rglWb6aDTUkzHWIPbxKgKunczehJfj5tgUh4DQ815DNKDGHpifT3IPHkKeex8r3W"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: <?php echo $amount ?>
                }
                }]
            });
        },
        onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            alert('Payment successful. Please wait till we redirect to the success page.');
            window.location.href= "<?php echo $website . '/payment_successful.php?trans_id=' . $transaction_id; ?>";
        });
    }}).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.
</script>

<div class="container" style="text-align: center">
    <h1> Your order details have been stored in our database, kindly procced with the payment to confirm the order.</h1>
    <br>
    <h2>Please wait for a couple of seconds after payment. We will redirect you to payment success page where you will get transaction ID of this order.</h2>
    <div id="paypal-button-container"></div>
</div>

<?php require('components/footer.php') ?>;