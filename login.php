<?php

$adminUsername = 'admin';
$adminPassword = 'admin123';

// Función para manejar el login con reintento en caso de error
function login()
{
    global $adminUsername, $adminPassword;

    do {
        echo "Ingrese el nombre de administrador: ";
        $username = trim(fgets(STDIN));

        echo "Ingrese la contraseña: ";
        $password = trim(fgets(STDIN));

        if ($username !== $adminUsername || $password !== $adminPassword) {
            echo "Credenciales incorrectas. Inténtalo de nuevo.\n";
        } else {
            echo "Acceso concedido. Bienvenido, $username.\n";
            break; // Salir del bucle si las credenciales son correctas
        }
    } while (true);  // Repetir hasta que las credenciales sean correctas
}
