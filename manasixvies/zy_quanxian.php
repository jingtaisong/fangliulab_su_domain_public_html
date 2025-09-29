<?php
define('IN_PHPWeb', true);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['user_name']) || empty($_SESSION['user_id'])) {
    header('Location: /manasixvies/zy_logo.php', true, 302);
    exit;
}
?>
