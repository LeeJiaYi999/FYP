<?php
session_start();
session_destroy();
$lgo = 'index.php';
header('Location: ' . $lgo);

?>