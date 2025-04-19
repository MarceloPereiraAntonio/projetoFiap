<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Student;
use App\Requests\StoreAlunoRequest;

class StudentController 
{
    public function index() 
    {    
        $students = new Student();
        View::render('students.index', [
            'alunos' => $students->all()
        ]);
    }

    public function create() 
    {
        View::render('students.create', ['title' => 'Criar novo Aluno']);
    }

    public function store() 
    {
        $request = $_POST;
        $errors = StoreAlunoRequest::validate($request);

        if ($errors) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: /student/create');
            exit;
        }

        $student = new Student();

        if ($student->create($request)) {
            $_SESSION['success'] = 'Aluno cadastrado com sucesso!';
            header('Location: /students');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao cadastrar aluno!';
            header('Location: /student/create');
            exit;
        }

        exit;
        
    }

    public function edit(int $id) 
    {
        $student = new Student();
        $data = $student->find($id);
        View::render('students.edit', [
            'student' => $data
        ]);
    }

    public function update(int $id) 
    {
        $request = $_POST;
        $errors = StoreAlunoRequest::validate($request, $id);

        if ($errors) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: /student/'.$id.'/edit');
            exit;
        }
        $student = new Student();
        if ($student->update($id, $request)) {
            $_SESSION['success'] = 'Aluno atualizado com sucesso!';
            header('Location: /students');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao atualizar aluno!';
            header('Location: /student/'.$id.'/edit');
            exit;
        }
    }

    public function delete(int $id) 
    {
        $student = new Student();
        if ($student->delete($id)) {
            $_SESSION['success'] = 'Aluno excluido com sucesso!';
            header('Location: /students');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao excluir aluno!';
            header('Location: /students');
            exit;
        }
    }
}