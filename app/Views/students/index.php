<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<div class="container-md shadow p-3 mb-3 rounded">
    <div class="d-flex justify-content-between">
        <h3>Lista de Alunos</h3>
        <a href="student/create" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Aluno</a></a>
    </div>
</div>
<div class="container-md shadow p-3 mb-5 rounded">
    <table id="studentsTable" class="table text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Documento</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <th scope="row"><?= $aluno['id'] ?></th>
                    <td><?= $aluno['nome'] ?></td>
                    <td><?= $aluno['email'] ?></td>
                    <td><?= $aluno['cpf'] ?></td>
                    <td>
                        <a href="student/<?= $aluno['id'] ?>/edit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <form action="student/<?= $aluno['id'] ?>" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir esse aluno ?')" style="display:inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#studentsTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            },
            pageLength: 6
        });
    });
</script>