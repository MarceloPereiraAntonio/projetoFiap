<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classes;
use App\Requests\StoreClassesRequest;

class ClassesController
{
    public function index()
    {
        $classes = new Classes();
        View::render('classes.index', [
            'classes' => $classes->all()
        ]);
    }

    public function create()
    {
        View::render('classes.create');
    }

    public function store() 
    {
        $request = $_POST;
        var_dump($request);
        $errors = StoreClassesRequest::validate($request);

        if ($errors) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: /class/create');
            exit;
        }

        $newClass = new Classes();

        if ($newClass->create($request)) {
            $_SESSION['success'] = 'Turma cadastrada com sucesso!';
            header('Location: /classes');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao cadastrar!';
            header('Location: /class/create');
            exit;
        }

        exit;
        
    }

    public function edit(int $id) 
    {
        $data = new Classes();
        View::render('classes.edit', [
            'class' => $data->find($id)
        ]);
    }

    public function show(int $id) 
    {
        $data = new Classes();
        $classData = $data->findClassByStudents($id);
        View::render('classes.show', [
            'class' => $classData,
            'students' => $classData['alunos'] ?? []
        ]);
    }

    public function update(int $id) 
    {
        $request = $_POST;
        $errors = StoreClassesRequest::validate($request, $id);

        if ($errors) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $request;
            header('Location: /class/' . $id . '/edit');
            exit;
        }

        $class = new Classes();
        if ($class->update($id, $request)) {
            $_SESSION['success'] = 'Turma atualizada com sucesso!';
            header('Location: /classes');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao atualizar!';
            header('Location: /class/' . $id . '/edit');
            exit;
        }
    }

    public function delete(int $id) 
    {
        $class = new Classes();
        if ($class->delete($id)) {
            $_SESSION['success'] = 'Turma excluida com sucesso!';
            header('Location: /classes');
            exit;
        } else {
            $_SESSION['error'] = 'Erro ao excluir!';
            header('Location: /classes');
            exit;
        }
    }
}