<?php
session_start();

if (isset($_GET['modificationOption'])) {
    $_SESSION['selectedModification'] = $_GET['modificationOption'];
}
?>
