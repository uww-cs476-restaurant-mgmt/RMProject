<?php
$user = 'root';
$pass = ''; // XAMPP's default password is a blank string
$db_info = 'mysql:host=localhost;dbname=841onlinemenu';

try {
    $db = new PDO($db_info, $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Function to get all baskets from the database
function getBasketsFromDatabase($db) {
    $baskets = [];
    $stmt = $db->query("SELECT * FROM restaurantMenuv2 WHERE Type = 'Basket'");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $baskets[] = [
            'ID' => $row['ID'],
            'Type' => $row['Type'],
            'Name' => $row['Name'],
            'Price' => $row['Price'],
        ];
    }

    return $baskets;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .menu-button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <button class="navbar-button" onclick="navigateTo('841index.php')">Return Home</button>
        <button class="navbar-button" onclick="navigateTo('starters.php')">Starters</button>
        <button class="navbar-button" onclick="navigateTo('salad.php')">Salads</button>
        <button class="navbar-button" onclick="navigateTo('entrees.php')">Entrees</button>
        <button class="navbar-button" onclick="navigateTo('wraps.php')">Wraps</button>
        <button class="navbar-button" onclick="navigateTo('sandwich.php')">Sandwiches</button>
    </div>

    <h2>Basket Menu</h2>

    <?php
    $baskets = getBasketsFromDatabase($db);

    foreach ($baskets as $basket) {
        echo '<button class="menu-button" onclick="showModifications(\'' . $basket['Name'] . '\')">' . $basket['Name'] . '</button>';
    }
    ?>
    <script>
        function showModifications(menuName) {
            window.location.href = 'modification_options.php?menuName=' + menuName;
        }

        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
