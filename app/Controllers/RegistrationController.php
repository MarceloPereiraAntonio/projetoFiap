<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Registration;

class RegistrationController
{
    public function create()
    {
        $alunos = (new Student())->all();
        $turmas = (new Classes())->all();

        View::render('registrations.create', [
            'alunos' => $alunos,
            'turmas' => $turmas
        ]);
    }

    public function store()
    {
        $alunoId = $_POST['aluno_id'];
        $turmaId = $_POST['turma_id'];

        $matricula = new Registration();

        if ($matricula->exists($alunoId, $turmaId)) {
            $_SESSION['error'] = 'Este aluno já está matriculado nesta turma.';
        } elseif ($matricula->create($alunoId, $turmaId)) {
            $_SESSION['success'] = 'Matrícula realizada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao realizar matrícula.';
        }

        header('Location: /register');
        exit;
    }
}
