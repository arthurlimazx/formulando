<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    $projectPath = str_replace('\\', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(__DIR__ . '/..')));
    $loginUrl = rtrim($projectPath, '/') . '/auth/login.php';
    header('Location: ' . $loginUrl);
    exit();
}

?>