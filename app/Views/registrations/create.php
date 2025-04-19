<div class="container-md shadow p-3 mb-3 rounded">
    <h3>Nova Matrícula</h3>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <form action="/register" method="POST">
        <div class="mb-3">
            <label>Aluno</label>
            <select name="aluno_id" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Turma</label>
            <select name="turma_id" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id'] ?>"><?= $turma['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Matricular</button>
    </form>
</div>