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

function getStartersFromDatabase($db) {
    $starters = [];
    $stmt = $db->query("SELECT * FROM restaurantMenuv2 WHERE Type = 'Starter'");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $starters[] = [
            'ID' => $row['ID'],
            'Type' => $row['Type'],
            'Name' => $row['Name'],
            'Price' => $row['Price'],
        ];
    }

    return $starters;
}

// Function to get modifications for a specific menu item
function getModificationsForMenuItem($db, $menuName) {
    $stmt = $db->prepare("SELECT m.ModificationOption FROM modificationsv2 m JOIN restaurantMenuv2 r ON m.menuID = r.ID WHERE r.Name = :menuName");
    $stmt->bindParam(':menuName', $menuName);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starter Menu</title>
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
        <button class="navbar-button" onclick="navigateTo('salad.php')">Salads</button>
        <button class="navbar-button" onclick="navigateTo('entrees.php')">Entrees</button>
        <button class="navbar-button" onclick="navigateTo('wraps.php')">Wraps</button>
        <button class="navbar-button" onclick="navigateTo('sandwich.php')">Sandwiches</button>
        <button class="navbar-button" onclick="navigateTo('basket.php')">Baskets</button>
        <!-- Add more buttons for other categories as needed -->
    </div>

    <h2>Starter Menu</h2>

    <?php
    // PHP code to fetch starters from the database and generate buttons
    $starters = getStartersFromDatabase($db);

    foreach ($starters as $starter) {
        echo '<button class="menu-button" onclick="showModifications(\'' . $starter['Name'] . '\')">' . $starter['Name'] . '</button>';
    }
    ?>

    <script>
        function showModifications(menuName) {
            // Redirect to the modifications page with the selected menu item
            window.location.href = 'modification_options.php?menuName=' + menuName;
        }

        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
