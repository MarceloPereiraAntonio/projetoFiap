<?php

function auth(): bool
{
    return isset($_SESSION['user']);
}

function requireAuth()
{
    if (!auth()) {
        $_SESSION['error'] = 'Você precisa estar logado.';
        header('Location: /login');
        exit;
    }
}
