<?php

//Funcion para validar el token 
function validartoken(){
    //Recupeara el token de la cookie 
    $token = $_COOKIE['token'];
    //var_dump($token );

    //Convertir el token en un array
    $token_array = explode('.', $token);
    //var_dump($token_array);
    $header = $token_array[0];
    $payload = $token_array[1];
    $signature = $token_array[2];

    //clave secreta y unica 
    $llave = "DGBU85S46H9M5W4X6OD7";

    //Usar el header y el payload y codificar con el algoritmo sha256
    $validar_assignature = hash_hmac('sha256', "$header.$payload", $llave, true);

    //Codificar datos en base64
    $validar_assignature = base64_encode($validar_assignature);

    //Compara la asignatura del token recibido con la asignatura generad
    //Accede al IF cuando el token es valido 
    if($signature == $validar_assignature){

        //decodificar datos de base64
        $datos_token = base64_decode($payload);

        //Convertir objeto en array
        $datos_token = json_decode($datos_token);
        //var_dump($datos_token);

        //Compara el dato de vencimiento del token con el dato actual 
        //accede al IF cuando el dato del token es mayor que el actual
        if($datos_token->exp > time()){
            //Retorna TRUE indicando que le token es valido
            return true; 
        }else{
            //Accede al ELSE cuando el dato del token es menor o igual al dato actual 
            //Retorna FALSE indicando que el token es invalido
            return false;
        }

        
    }else{
        return false;
    }
}

//Recuperacion del nombre del token 
function recuperacionNomeToken(){
    //Recupeara el token de la cookie 
    $token = $_COOKIE['token'];

    //Convertir el token en un array
    $token_array = explode('.', $token);
    //var_dump($token_array);
    $payload = $token_array[1];

    //decodificar datos de base64
    $datos_token = base64_decode($payload);

    //Convertir objeto en array
    $datos_token = json_decode($datos_token);
    //var_dump($datos_token);

    //Retorna el nombre del usuario pero no el token
    return $datos_token->nombre;


}