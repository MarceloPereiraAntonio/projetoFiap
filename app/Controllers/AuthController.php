<?php

namespace App\Controllers;

use App\Helpers\View;
use Config\Database;

class AuthController
{
    public function form()
    {
        if (auth()) {
            header('Location: /');
            exit;
        }

        View::render('auth.login', [], false);
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($senha, $user['senha'])) {
            $_SESSION['error'] = 'E-mail ou senha inválidos.';
            header('Location: /login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nome' => $user['nome'],
            'email' => $user['email']
        ];

        header('Location: /students');
        exit;
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
