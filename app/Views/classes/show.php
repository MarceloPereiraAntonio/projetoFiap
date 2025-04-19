<div class="container-md shadow p-3 mb-3 rounded">
    <h3>Detalhes da turma</h3>
    <div>
        <h5><span class="badge rounded-pill text-bg-primary">Nome:</span> <?= $class['nome'] ?></h5>
        <h5><span class="badge rounded-pill text-bg-primary">Descrição:</span> <?= $class['descricao'] ?></h5>
    </div>
    <div class="container-md shadow p-3 my-3 rounded">
        <h4>Alunos</h4>
        <table id="studentsClassesTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <th scope="row"><?= $student['nome'] ?></th>
                        <td><?= $student['email'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="/classes" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#studentsClassesTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            },
            pageLength: 5
        });
    });
</script>