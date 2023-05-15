<?php

session_start(); //Iniciar la sesion 

//Limpiar el buffer de redireccionamiento
ob_start();

// Incluir un archivo con la conexion con la base de datos   
include_once 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesion con Token y Cookie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
   
        <title>Iniciar Sesion con Token y Cookie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  
        
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/login.css">  
        <style type="text/css">     
        </style> 
        <script type="text/javascript">
        
        </script>
  
</head>
<body>

    <?php
    //Ejemplo cifrar contraseña
    //echo password_hash('Somoskudasai17', PASSWORD_DEFAULT);
    ?>
    <?php
        //Recibir los datos del formulario
        $datos= filter_input_array(INPUT_POST, FILTER_DEFAULT);
        

        //accede al IF cuando el usuario hace clic en el botón "acceder" en el formulario
        if(!empty($datos['SendLogin'])){
            //var_dump($datos);

            //QUERY para recuperar el usuario de la base de datos
            $query_usuario = "SELECT idUsuario, nombre_completo, correo, usuario, contrasena 
                    FROM tbusuarios
                    WHERE correo =:usuario
                    LIMIT 1";

            //Prepara un QUERY
            $result_usuario = $conn->prepare($query_usuario);

            //
            $result_usuario->bindParam(':usuario',$datos['usuario']);

            //Executar QUERY
            $result_usuario->execute();

            //
            if(($result_usuario) and ($result_usuario->rowCount() != 0)){

                //Leer el resultado 
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                //var_dump($row_usuario);

                //Verificar si la contraseña 
                if(password_verify($datos['contrasena'], $row_usuario['contrasena'])){

                    $header = [
                        'alg' => 'HS256',
                        'typ' => 'JWT'
                    ];
                    //var_dump($header);

                    //Convertir el array en objeto
                    $header = json_encode($header);  
                    //var_dump($header);
                    //Codificar dato en base64
                    $header = base64_encode($header);
                    //Imprimir Header
                    //var_dump($header);

                    $duracion = time() + (7 * 24 * 60 * 60);  

                    //Ejemplo de duracion del token
                    //$duracion = time() + (5);

                    $payload = [
                        /*'iss' => 'localhost',
                        'aud' => 'localhost',*/
                        'exp' => $duracion,
                        'id' => $row_usuario['idUsuario'],
                        'nombre' => $row_usuario['nombre_completo'],
                        'email' => $row_usuario['correo'],
                    ];

                    //Convertir el array en objeto
                    $payload = json_encode($payload);  
                    //var_dump($payload);
                    //Codificar dato en base64
                    $payload = base64_encode($payload);
                    //Imprimir Payload
                    //var_dump($payload);


                    //clave secreta y unica 
                    $llave = "DGBU85S46H9M5W4X6OD7";
                    //tomar el header y el payload y codificar con el alg sha256 junto con la llave
                    $signature = hash_hmac('sha256', "$header.$payload", $llave, true);
                    //Codificar dato en base64
                    $signature = base64_encode($signature);
                    //Imprimir Signature
                    //var_dump($signature);

                    //Imprimir el token
                    //echo "Token: $header.$payload.$signature <br>";

                    //Salvar el token en cookies 
                    //Crea el token con duracion de 7 dias 
                    setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60)));

                    //Redireccionar el usuario para pagina dashboard
                    header("Location: Info_fina.php");

                }else{
                    $_SESSION['msg'] = "<p style='color: #f00;'>Error: Usuario o contraseña invalida!</p>";
                }

            }else{
                $_SESSION['msg'] = "<p style='color: #f00;'>Error: Usuario o contraseña invalida!</p>";
            }
        }

        //Verificar si existe una variable global "msg" y acceda al IF
        if(isset($_SESSION['msg'])){
            //Imprimir el valor de la variable global
            echo $_SESSION['msg'];

            //Destruir la variable global "msg"
            unset($_SESSION['msg']);
        }
    ?>

    <!--<div class="card">
        <div class="container">
            <h1>Login</h1>  
            <form method="POST" action="">
                <?php
                $usuario = "";
                if(isset($datos['usuario'])){
                    $usuario = $datos['usuario'];
                }   
                ?>
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="usuario" placeholder="Digite un usuario"
                       value="<?php echo $usuario; ?>"><br><br>
                <?php
                $contrasena = "";
                if(isset($datos['contrasena'])){
                    $contrasena = $datos['contrasena'];
                }   
                ?>
                <label for="contrasena">Contraseña</label>
                <input id="contrasena" type="password" name="contrasena" placeholder="Digite una contraseña"
                       value="<?php echo $contrasena; ?>"><br><br>
                <input type="submit" name="SendLogin" value="Ingresar"><br><br>
            </form>
        </div>
    </div>-->

    <div id="contenedor">
        <div id="contenedorcentrado">
            <div id="login">
            <form method="POST" action="">
                <?php
                $usuario = "";
                if(isset($datos['usuario'])){
                    $usuario = $datos['usuario'];
                }   
                ?>
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="usuario" placeholder="Digite un usuario"
                       value="<?php echo $usuario; ?>"><br><br>
                <?php
                $contrasena = "";
                if(isset($datos['contrasena'])){
                    $contrasena = $datos['contrasena'];
                }   
                ?>
                <label for="contrasena">Contraseña</label>
                <input id="contrasena" type="password" name="contrasena" placeholder="Digite una contraseña"
                       value="<?php echo $contrasena; ?>"><br><br>
                <input type="submit" name="SendLogin" value="Ingresar"><br><br>
            </form>
            </div>
            <div id="derecho">
                <div class="titulo">
                    Bienvenido
                </div>
                <hr>
                <div class="pie-form">
                    <a href="#">¿Perdiste tu contraseña?</a>
                    <a href="#">¿No tienes Cuenta? Registrate</a>
                    <hr>
                    <a href="#">« Volver</a>
                </div>
            </div>
        </div>
    </div>



    
</body>
</html>