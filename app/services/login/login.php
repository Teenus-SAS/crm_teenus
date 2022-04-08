<?php

if (!empty($_SESSION['active'])) {
    header('location: html/batch.php');
} else {

    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) or empty($_POST['pass'])) {
            $alert = "Ingrese su usuario y password";
        } else {
            require_once('./conexion.php');
            $tries = file_get_contents('tries.txt');
            settype($tries, 'integer');
            $max_intentos = 5;

            if ($tries <= $max_intentos) {
                $usuario = $_POST['usuario'];
                $pass = md5($_POST['pass']);

                $sql = "SELECT * FROM usuario, modulo WHERE user = :usuario AND clave=:pass AND modulo.id=usuario.id_modulo";
                $query = $conn->prepare($sql);
                $query->execute(['usuario' => $usuario, 'pass' => $pass]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    $data = $query->fetch(PDO::FETCH_ASSOC);

                    if ($data['estado'] == 0) {
                        $alert = "Usuario Inactivo, contacte al administrador";
                    } else {

                        $new_trie = 0;
                        file_put_contents('tries.txt', $new_trie);

                        $_SESSION['active'] = true;
                        $_SESSION['idUser'] = $data['id'];
                        $_SESSION['name'] = $data['nombre'];
                        $_SESSION['lastname'] = $data['apellido'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['idModulo'] = $data['id_modulo'];
                        $_SESSION['position'] = $data['id_cargo'];
                        $_SESSION['moudle'] = $data['modulo'];
                        $_SESSION['rol'] = $data['rol'];
                        $_SESSION['active'] = $data['activo'];
                        $_SESSION["timeout"] = time();
                        $modulo = $data['active'];
                        $rol = $data['rol'];
                    }
                } else {
                    $new_trie = ++$tries;
                    file_put_contents('tries.txt', $new_trie);
                    $alert = "Su usuario y/o password no son correctos";
                }
            } else
                $alert = "Número máximo de intentos superados. Vuelva a intentar en unos minutos";
        }
    }
}
