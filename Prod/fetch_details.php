<?php 
include("components/header.php");
?>

<div id="sapling" class="container">
    <h1>Thank you for choosing our <i>'<?php echo $_GET['p'] ?>'</i> plan.</h1>
    <p>Please fill in the following form to proceed furtner.</p>
    <br>
    <form action="payment.php" method="post"  id="fetch_details_form">
        <div class="row">
            <div class="col-3 label">Name:</div>
            <div class="col-9 value"><input type="text" name="name" id="name" required></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Email:</div>
            <div class="col-9 value"><input type="email" name="email" id="email" required></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Plan:</div>
            <div class="col-9 value"><input type="text" value="<?php echo $_GET['p'] ?>" name="plan" id="plan" readonly></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Name of the book:</div>
            <div class="col-9 value"><input type="text" name="bookname" id="bookname" required></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Author:</div>
            <div class="col-9 value"><input type="text" name="author" id="author" required></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Genre:</div>
            <div class="col-9 value"><input type="text" name="genre" id="genre" required></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Color scheme:</div>
            <div class="col-9 value"><input type="text" name="color" id="color"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Keywords for stock photo:</div>
            <div class="col-9 value"><input type="text" name="keywords" id="keywords"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 label">Remarks:</div>
            <div class="col-9 value"><textarea name="remarks" id="remarks" rows="5"></textarea></div>
        </div>
        <br>
        <input type="submit" id="submit-button">
    </form>
</div>

<?php include("components/footer.php"); ?>