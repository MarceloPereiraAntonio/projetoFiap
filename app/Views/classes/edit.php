<?php
    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['old']);
?>
<h3>Editar <?= $class['nome'] ?></h3>
<div class="container-md shadow p-3 mb-3 rounded">
    <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $message): ?>
                        <li><?= htmlspecialchars($message) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
    <?php endif; ?>
    <form action="/class/<?= $class['id'] ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <div class="row g-1 align-items-center">
            <div class="col-6">
                <label for="name">Nome</label>
                <input class="form-control" name="nome" type="text" placeholder="nome" value="<?= $class['nome'] ?? '' ?>">
            </div>
            <div class="col-6">
                <label for="descricao">Descrição</label>
                <input class="form-control" name="descricao" type="text" placeholder="Turma A" value="<?= $class['descricao'] ?? '' ?>">
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-end">
            <button class="btn btn-success" type="submit">Salvar</button>
        </div>
    </form>
</div>