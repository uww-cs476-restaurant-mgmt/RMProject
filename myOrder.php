<?php
session_start();

$user = 'root';
$pass = ''; // XAMPP's default password is a blank string
$db_info = 'mysql:host=localhost;dbname=841onlinemenu';

try {
    $db = new PDO($db_info, $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_POST['clearReceipt'])) {
    unset($_SESSION['selectedItems']);
    header('Location: 841index.php');
    exit();
}

if (isset($_POST['checkout'])) {
    header('Location: receipt.php');
    exit();
}

$selectedModification = $_SESSION['selectedModification'];

$stmt = $db->prepare("SELECT r.Name AS itemName, r.Price AS itemPrice, m.ModificationOption FROM restaurantMenuv2 r 
                     JOIN modificationsv2 m ON r.ID = m.menuID 
                     WHERE m.ModificationOption = :modificationOption");
$stmt->bindParam(':modificationOption', $selectedModification);
$stmt->execute();
$itemInfo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['selectedItems'])) {
    $_SESSION['selectedItems'] = [];
}

if ($itemInfo) {
    $_SESSION['selectedItems'][] = $itemInfo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        .navbar {
            background-color: #FFA500; /* Orange background color */
            padding: 15px;
            text-align: center;
        }

        .navbar button {
            background-color: #FFD700; /* Gold button color */
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .checkout-button {
            background-color: #FFD700; /* Gold button color */
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            color: #FFF; /* White text color */
        }
    </style>
</head>
<body>

    <div class="navbar">
		<h1>Keep Shopping</h1>
        <button onclick="navigateTo('starters.php')">Starters</button>
        <button onclick="navigateTo('salad.php')">Salads</button>
        <button onclick="navigateTo('entrees.php')">Entrees</button>
        <button onclick="navigateTo('wraps.php')">Wraps</button>
        <button onclick="navigateTo('sandwich.php')">Sandwiches</button>
        <button onclick="navigateTo('basket.php')">Baskets</button>
    </div>

    <h2>My Order</h2>

    <?php if (!empty($_SESSION['selectedItems'])) : ?>
        <?php
        $totalCost = 0;
        foreach ($_SESSION['selectedItems'] as $index => $item) {
            $totalCost += $item['itemPrice'];
        }

        $taxRate = 0.05;
        $taxAmount = $totalCost * $taxRate;
        $totalCostWithTax = $totalCost + $taxAmount;
        ?>

        <?php foreach ($_SESSION['selectedItems'] as $index => $item) : ?>
            <p>Item <?php echo $index + 1; ?>:</p>
            <p>Item Name: <?php echo $item['itemName']; ?></p>
            <p>Modification: <?php echo $item['ModificationOption']; ?></p>
            <p>Price: $<?php echo $item['itemPrice']; ?></p>
            <hr>
        <?php endforeach; ?>

        <p>Total Cost: $<?php echo $totalCost; ?></p>
        <p>Tax (5%): $<?php echo number_format($taxAmount, 2); ?></p>
        <p>Total Cost with Tax: $<?php echo number_format($totalCostWithTax, 2); ?></p>

        <form method="post">
            <button class="checkout-button" name="checkout">Checkout</button>
        </form>
    <?php else : ?>
        <p>No items selected.</p>
    <?php endif; ?>

    <p>Thank you for your order!</p>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
