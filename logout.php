<?php
    require __DIR__ . '/includes/head.php'; 
    session_unset();
    session_destroy();
    header('Location: index.php');
?>
<section id="login-section">
    <h3>(logout.)</h3>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
