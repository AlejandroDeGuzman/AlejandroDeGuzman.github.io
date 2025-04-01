<?php
    require __DIR__ . '/includes/head.php'; 
    session_unset();
    session_destroy();
    header('Location: index.php');
?>
