<?php require('components/header.php'); ?>

<div class="container" style="text-align: center">
<?php 

    function send_confirmation_mail($transaction_id){
        $servername = '194.59.164.23';
        $dbname = 'u793208810_4ywBY';
        $username = 'u793208810_b5inZ';
        $password = 'puneroti-96';
        $conn = new mysqli($servername, $username, $password, $dbname);

        $fetch_transaction_query = "SELECT * FROM transactions WHERE transaction_id='".$transaction_id."';";
        $result = $conn->query($fetch_transaction_query);
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $order_id = $row['order_id'];
        $product_id = $row['product_id'];
        $mail_sent = $row['mail_sent'];
        if($mail_sent == 'FALSE') {
            $fetch_user_query = "SELECT user_name, user_email FROM users WHERE user_id='".$user_id."';";
            $result = $conn->query($fetch_user_query);
            $row = $result->fetch_assoc();
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];

            $fetch_book_query = "SELECT book_name FROM orders WHERE order_id='".$order_id."';";
            $result = $conn->query($fetch_book_query);
            $row = $result->fetch_assoc();
            $book_name = $row['book_name'];

            $fetch_product_details_query = "SELECT product_name, product_discounted_cost FROM products WHERE product_id ='".$product_id."';";
            $result = $conn->query($fetch_product_details_query);
            $row = $result->fetch_assoc();
            $product_name = $row['product_name'];
            $product_discounted_cost = ['product_discounted_cost'];

            $msg = "Hi ".$user_name.",\n\n"."Thanks for using Wrapyourbook.com. Your order is placed. Our designers are working very hard to create the best cover page for your book. Meanwhile, here are the order details - \n"."Book name - ".$book_name."\n"."Plan - ".$product_name."\n"."Discounted Price - ".$product_discounted_cost."\n"."Transaction ID - ".$transaction_id."\nKindly drop a mail to our support team at support@wrapyourbook.com with the above mentioned transaction ID. We will be glad to help you.\n\n"."Thanks and regards, \n"."Vijay. \n"."Founder,\n"."www.wrapyourbook.com";
            $subject = "Your order has been confirmed. Please check this E-mail for further details.";
                
            send_mail("no-reply@wrapyourbook.com",$user_email,$subject,$msg);

            $update_query = "UPDATE transactions SET mail_sent = 'TRUE' WHERE transaction_id = '" . $transaction_id . "';";
            if($conn->query($update_query) !== TRUE) {
                echo "<h1 style='color:red'>Could not send the confirmation mail. Our customer care will resolve this issue</h1>";
                $ticket_id = 'in' . time();
                $ticket_page = "payment_successful, send_mail";
                if(insert_ticket($ticket_id, $transaction_id, $user_id, $ticket_page) !== TRUE) {
                    die("<h1 style='color:red'>Severe error. Please reload this page or come back later. Thank you.</h1>");
                }
                die();
            }
        }
    }

    $transaction_id = $_GET['trans_id'];
    if (sizeof($transaction_id) === 0) {
        echo "<script>window.location.href='" . $website . "/index.php';</script>";
    }

    $update_query = "UPDATE transactions SET payment = 'TRUE' WHERE transaction_id = '" . $transaction_id . "';";
    $servername = '194.59.164.23';
    $dbname = 'u793208810_4ywBY';
    $username = 'u793208810_b5inZ';
    $password = 'puneroti-96';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if($conn->query($update_query)!==TRUE) {
        echo "<h1 style='color:red'>Something went wrong. Our customer care will resolve this issue</h1>";
        $ticket_id = 'in' . time();
        $ticket_page = "payment_successful, set_payment";
        if(insert_ticket($ticket_id, $transaction_id, $user_id, $ticket_page) !== TRUE) {
            die("<h1 style='color:red'>Severe error. Please reload this page or come back later. Thank you.</h1>");
        }
        die();
    }

    echo '<h1>Payment Successful.</h1>';
    echo "<h2>The identification number for this transaction is <span id='transaction_id'>" . $transaction_id . "</span>. Kindly use this for raising any tickets henceforth. <br><br> A mail is also sent to you with all the details related to your order.<br> <span style='color:red'>Kindly check the promotions tab of your inbox folder or the spam folder.</span><br>";
    send_confirmation_mail($transaction_id);
?>
<br>
</div>


<?php require('components/footer.php') ?>