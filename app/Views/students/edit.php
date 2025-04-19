<?php
    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['old']);
?>
<h3>Novo Aluno</h3>
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
    <form action="/student/<?= $student['id'] ?>" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <div class="row g-1 align-items-center">
            <div class="col-4">
                <label for="name">Nome</label>
                <input class="form-control" name="nome" type="text" placeholder="nome" aria-label="Busca" value="<?= $student['nome'] ?? '' ?>">
            </div>
            <div class="col-4">
                <label for="cpf">CPF</label>
                <input class="form-control" name="cpf" type="text" placeholder="Busca" aria-label="Busca" value="<?= $student['cpf'] ?? '' ?>">
            </div>
            <div class="col-4">
                <label for="data_nascimento">Data de nascimento</label>
                <input class="form-control" name="data_nascimento" type="date" value="<?= $student['data_nascimento'] ?? '' ?>">
            </div>
        </div>
        <div class="row g-1 align-items-center mt-2">
            <div class="col-6">
                <label for="email">E-email</label>
                <div class="input-group">
                    <input class="form-control" name="email" type="email" value="<?= $student['email'] ?? '' ?>">
                </div>
            </div>
            <div class="col-6">
                <label for="senha">Senha</label>
                <div class="input-group">
                    <input id="password" class="form-control" name="senha" type="password">
                    <button class="btn btn-outline-secondary" type="button" id="togglePass">
                        <i class="bi bi-eye" id="iconPass"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
<script>
    const togglePass = document.querySelector('#togglePass');
    const password = document.querySelector('#password');
    togglePass.addEventListener('click', (e) => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        const icon = document.querySelector('#iconPass');
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    })
</script>