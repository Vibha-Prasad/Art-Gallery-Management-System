<?php
require_once 'php_files/login_helper.php';
init_session();
if (!isLoggedIn())
{
    header('Location: login.php');
    exit();
}
require_once 'php_files/db.php';
require_once 'php_files/process_buy_art.php';
?>
<?php if (isset($_GET['art'])) : ?>
<html>
<head>
    <title>Buy</title>
    <?php
    require_once 'links.php';
    ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Art Gallery</a>
</nav>
<br>
<div class="card" style="width: 30%; border-radius: 25px; margin-left: auto; margin-right: auto">
    <div class="card-body" >
        <form action="buy.php" method="post">
            <h5>Buy art</h5> <br>
            <input type="number" class="form-control" name="ord_copies" placeholder="number of copies"  onkeyup="calculatePrice(this.value)" required>
            <br>
            <input type="text" class="form-control" name="ord_address" placeholder="delivery address" required>
            <br>
            <input type="tel" class="form-control" name="ord_phn" placeholder="phone number" required>
            <br>
            <p>Price: <span id="price-span">Enter no of copies to get price</span></p>
            <input type="hidden" class="form-control" name="art_id" value="<?php echo $_GET['art']; ?>" required>
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['user']; ?>" required>
            <input type="hidden" name="ord_price" id="ord_price" value="0"/>
            <div class = "form-row">
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input type="radio" id="pod" name="payment" class="form-check-input">
                        <label class="form-check-label" for="pod">Pay On Delivery</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="debit-credit" name="payment" class="form-check-input">
                        <label class="form-check-label" for="debit-credit">Debit/Credit Card</label>
                    </div>
                </div>
            </div>

            <br>
            <br> <button class="btn btn-outline-dark">buy now</button>
        </form>
    </div>
</div>

<script>
    <?php
            $query = 'SELECT * FROM arts WHERE art_id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $_GET['art']);
            $stmt->execute();
            $result = ($stmt->get_result())->fetch_assoc();
            $cost = $result['art_price'];
            echo "const costOfOne = $cost;\n";

    ?>
    const calculatePrice = (n) => {
        const price = n * costOfOne;
        document.getElementById('price-span').innerHTML = price.toString();
        document.getElementById('ord_price').value = price;
    }

</script>
</body>
</html>
<?php else: ?>
<?php header("Location: /Art Gallery"); ?>
<?php endif ?>
