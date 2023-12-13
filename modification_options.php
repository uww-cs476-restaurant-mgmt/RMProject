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

$menuName = $_GET['menuName'];

$stmt = $db->prepare("SELECT m.ModificationOption FROM modificationsv2 m JOIN restaurantMenuv2 r ON m.menuID = r.ID WHERE r.Name = :menuName");
$stmt->bindParam(':menuName', $menuName);
$stmt->execute();
$modificationOptions = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Options</title>
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

        .modification-button {
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
        <button onclick="navigateTo('841index.php')">Return Home</button>
    </div>

    <h2>Modification Options for <?php echo $menuName; ?></h2>

    <?php
        foreach ($modificationOptions as $option) {
            echo '<button class="modification-button" onclick="selectModification(\'' . $option . '\')">' . $option . '</button>';
        }
    ?>

    <script>
        function selectModification(modificationOption) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "store_modification.php?modificationOption=" + modificationOption, true);
            xhr.send();

            window.location.href = "myOrder.php"; 
        }

        function navigateTo(page) {
            window.location.href = page;
        }

        function cancelModification() {
            alert('Modification canceled');
        }
    </script>
</body>
</html>
