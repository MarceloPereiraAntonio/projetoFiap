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
        <h3>Turmas</h3>
        <a href="class/create" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nova Turma</a></a>
    </div>
</div>
<div class="container-md shadow p-3 mb-5 rounded">
    <table id="classesTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Alunos</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $class): ?>
                <tr>
                    <th scope="row"><?= $class['id'] ?></th>
                    <td><?= $class['nome'] ?></td>
                    <td><?= mb_strimwidth($class['descricao'], 0, 15, "...")  ?></td>
                    <td>
                        <span class="badge text-bg-primary"><?= $class['total_alunos'] ?></span></td>
                    <td>
                        <a href="class/<?= $class['id'] ?>/edit" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <a href="class/<?= $class['id'] ?>/show" class="btn btn-info"><i class="bi bi-eye"></i></a>
                        <form action="class/<?= $class['id'] ?>" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir essa turma ?')" style="display:inline;">
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
        $('#classesTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            },
            pageLength: 10
        });
    });
</script>