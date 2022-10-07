<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MVC Framework</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="/css/style.css">
</head>
<?php (isset($_COOKIE['darkmode']) && $_COOKIE['darkmode'] === "true") ? $_SESSION['darkmode'] = true : $_SESSION['darkmode'] = false; ?>
<body class="<?= theme('bg-dark text-white-75','bg-white') ?>" <?= !isset($_COOKIE['darkmode']) ? 'onload="loadDarkMode()"' : ''?>>
    <?php require('sidebar.php'); ?>
    <!-- CONTENT -->
    <section id="content">
        <?php require('nav.php'); ?>
        <!-- MAIN -->
        <main>