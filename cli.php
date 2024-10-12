<?php

require_once 'UserManager.php';
require_once 'login.php';  // Incluir el archivo de login

// Realizar el login antes de mostrar el menú
login();  // Llamada a la función login desde el archivo login.php

function showMenu()
{
    echo "Gestión de Usuarios MySQL:\n";
    echo "1. Agregar nuevo usuario\n";
    echo "2. Eliminar usuario\n";
    echo "3. Listar usuarios\n";
    echo "4. Salir\n";
    echo "Elija una opción: ";
}

$userManager = new UserManager();

do {
    showMenu();
    $option = trim(fgets(STDIN));

    switch ($option) {
        case 1:
            // Agregar un nuevo usuario
            echo "Ingrese el nombre de usuario: ";
            $username = trim(fgets(STDIN));

            // Validar el nombre de usuario
            if (!isValidUsername($username)) {
                echo "Error: El nombre de usuario no es válido. Solo se permiten letras, números y guiones bajos, hasta 16 caracteres.\n";
                break;
            }

            echo "Ingrese la contraseña: ";
            $password = trim(fgets(STDIN));

            echo "Ingrese el host (ej. localhost): ";
            $host = trim(fgets(STDIN));

            echo "Ingrese los privilegios (ej. ALL PRIVILEGES): ";
            $privileges = trim(fgets(STDIN));

            $userManager->addUser($username, $password, $host, $privileges);
            break;

        case 2:
            // Eliminar usuario con verificación
            do {
                echo "Listando usuarios...\n";
                $userManager->listUsers();

                echo "Ingrese el nombre del usuario a eliminar: ";
                $username = trim(fgets(STDIN));

                // Validar el nombre de usuario
                if (!isValidUsername($username)) {
                    echo "Error: El nombre de usuario no es válido. Solo se permiten letras, números y guiones bajos, hasta 16 caracteres.\n";
                    continue; // Regresar al inicio del bucle
                }

                echo "Ingrese el host del usuario: ";
                $host = trim(fgets(STDIN));

                // Verificar si el usuario existe
                if (!$userManager->userExists($username, $host)) {
                    echo "Error: El usuario '$username' con host '$host' no existe. Inténtalo de nuevo.\n";
                } else {
                    // Si existe, proceder con la eliminación
                    $userManager->deleteUser($username, $host);
                    echo "Usuario '$username' eliminado con éxito.\n";
                    break; // Salir del bucle una vez eliminado el usuario
                }
            } while (true); // Repetir hasta que el usuario válido sea eliminado
            break;

        case 3:
            // Listar usuarios
            $userManager->listUsers();
            break;

        case 4:
            echo "Saliendo del programa...\n";
            exit;

        default:
            echo "Opción no válida. Inténtalo de nuevo.\n";
            break;
    }

} while (true);

function isValidUsername($username) {
    // Permitir solo letras, números y guiones bajos, hasta 16 caracteres
    return preg_match('/^[a-zA-Z0-9_]{1,16}$/', $username);
}