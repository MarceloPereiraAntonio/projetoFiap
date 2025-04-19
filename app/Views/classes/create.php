<?php
    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['old']);
?>
<h3>Nova Turma</h3>
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
    <form action="/class" method="post">
        <div class="row g-1 align-items-center">
            <div class="col-6">
                <label for="name">Nome</label>
                <input class="form-control" name="nome" type="text" placeholder="nome" value="<?= $old['nome'] ?? '' ?>">
            </div>
            <div class="col-6">
                <label for="descricao">Descrição</label>
                <input class="form-control" name="descricao" type="text" placeholder="Turma A" value="<?= $old['descricao'] ?? '' ?>">
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-end">
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </div>
    </form>
</div>