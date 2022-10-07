<?php require('partials/header.php'); ?>
<h1 class="<?= theme('text-white-75', 'text-dark') ?>">Atualizar <?= $user[0]->name ?>'s nome:</h1>
<div class="form-group">
	<form method="POST" action="/user/update/<?= $user[0]->user_id ?>">
        <input class="form-control <?= theme('bg-dark text-white-75', 'bg-white') ?>" name="name"/>
	    <button class="form-control <?= theme('bg-dark text-white-75', 'bg-white') ?>" type="submit">Enviar</button>
	</form>
</div>
<h2 class="<?= theme('text-white-75', 'text-dark') ?>">Visualizando usuário <?= $user[0]->name ?></h2>
<ul>
    <li><?= $user[0]->user_id; ?> - <?= $user[0]->name; ?></li>
</ul>
<?php require ('partials/footer.php'); ?>
