<?php
include('pdo_connect_841.php');
// check for db connection
if(isset($db))
        echo "Connected";
else
        echo "Could not connect";
?>
