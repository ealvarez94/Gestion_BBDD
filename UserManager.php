<?php

class UserManager
{
    private $pdo;

    public function __construct()
    {
        // Configurar la conexión PDO a la base de datos
        $this->pdo = new PDO('mysql:host=localhost;dbname=gestion_usuario', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activar el manejo de excepciones
    }

    public function addUser($username, $password, $host, $privileges)
    {
        try {
            // Crear el usuario
            $query = "CREATE USER '$username'@'$host' IDENTIFIED BY :password";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['password' => $password]);

            // Asignar privilegios
            $query = "GRANT $privileges ON *.* TO '$username'@'$host'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            echo "Usuario '$username' agregado con éxito.\n";
        } catch (PDOException $e) {
            echo "Error al agregar usuario: " . $e->getMessage() . "\n";
        }
    }

    public function deleteUser($username, $host)
    {
        try {
            // Eliminar el usuario
            $query = "DROP USER '$username'@'$host'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar usuario: " . $e->getMessage() . "\n";
        }
    }

    public function listUsers()
    {
        try {
            $query = "SELECT User, Host FROM mysql.user";
            $stmt = $this->pdo->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                echo "Usuario: " . $user['User'] . ", Host: " . $user['Host'] . "\n";
            }
        } catch (PDOException $e) {
            echo "Error al listar usuarios: " . $e->getMessage() . "\n";
        }
    }

    // Método para verificar si un usuario existe
    public function userExists($username, $host)
    {
        try {
            $query = "SELECT COUNT(*) FROM mysql.user WHERE User = :username AND Host = :host";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['username' => $username, 'host' => $host]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Error al verificar existencia de usuario: " . $e->getMessage() . "\n";
            return false; // Devuelve false en caso de error
        }
    }
}