<?php require('components/header.php'); 
    $website = "http://localhost:8080";
?>

<div class="container" style="text-align: center">
<?php 
    $transaction_id = $_GET['trans_id'];
    if (sizeof($transaction_id) === 0) {
        echo "<script>window.location.href='" . $website . "/index.php';</script>";
    }

    $update_query = "UPDATE transactio SET payment = 'TRUE' WHERE transaction_id = '" . $transaction_id . "';";
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
        $ticket_page = "payment_successful";
        if(insert_ticket($ticket_id, $transaction_id, $user_id, $ticket_page) !== TRUE) {
            die("<h1 style='color:red'>Severe error. Please reload this page or come back later. Thank you.</h1>");
        }
        die();
    }

    echo '<h1>Payment Successful.</h1>';
    echo "<h2>The identification number for this transaction is <span id='transaction_id'>" . $transaction_id . "</span>. Kindly use this for raising any tickets henceforth. A mail is also sent to you with all the details related to your order. Kindly check your spam and promotions tab of your inbox."  
?>
<br>
</div>


<?php require('components/footer.php') ?>