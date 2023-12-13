<?php

$user = 'root';
$pass = ''; // XAMPP's default password is a blank string
$db_info='mysql:host=localhost;dbname=841onlinemenu';
try {
    $db = new PDO($db_info, $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
