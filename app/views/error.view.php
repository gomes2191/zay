<?php require ('partials/header.php'); ?>
<h1 class="<?= theme('text-white-75','text-dark') ?>">Um erro ocorreu</h1>
<p class="<?= theme('text-white-75','text-dark') ?>">Você encontrou um erro. Por favor, clique <a href="/">aqui</a> para ir para Página inicial.</p>
<?php if (isset($error)): ?>
    <?php echo $error; ?>
<?php endif; ?>
<?php require ('partials/footer.php'); ?>