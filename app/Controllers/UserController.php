<?php

namespace App\Controllers;

use DB\Database;

class UserController
{
    public function showLoginForm(): void
    {
          // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
          if (isset($_SESSION['user_id'])) {
            header("Location: /home");
            exit;
        }
        require dirname(__DIR__) ."/Views/login.php"; 

    }

    public function processLogin(): void
    {
        session_start();
        $emailOrUsername = trim($_POST['email_or_username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $db = Database::getInstance();
        $query = "SELECT * FROM users WHERE email = :email OR username = :username";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':email' => $emailOrUsername,
            ':username' => $emailOrUsername,
        ]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: /home");
            session_regenerate_id();
        } else {
            echo "Identifiants incorrects.";
            header("Location: /login");

        }
    }

    // Afficher le formulaire d'inscription
    public function showRegisterForm(): void
    {
        require dirname(__DIR__) ."/Views/register.php"; 

    }

    public function processRegister(): void
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username && $email && $password) {
            $db = Database::getInstance();
            $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $db->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $hashedPassword,
                ]);
                echo "Inscription réussie !";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Tous les champs sont requis.";
        }
    }

     // Vérifier si l'utilisateur est connecté
     public static function checkAuth(): void
     {
         if (!isset($_SESSION['user_id'])) {
             header("Location: /login");
             exit;
         }
     }
}
