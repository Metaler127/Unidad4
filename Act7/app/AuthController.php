<?php
session_start();

if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = tokenG(20);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($username && $password && $action === 'login') {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $username,
                'password' => $password
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseArray = json_decode($response);

        if (isset($responseArray->message) && $responseArray->message === "Registro obtenido correctamente" && isset($responseArray->data)) {
            $_SESSION['user'] = $responseArray->data;
            $_SESSION['token'] = $responseArray->data->token;

            header("Location: ../main");
            exit();
        } else {
            echo "<script>alert('Login failed: Incorrect username or password.');</script>";
        }
    } else {
        echo "<script>alert('Username, password, and action are required.');</script>";
    }
}

function tokenG($leng=10) {
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $token = "";
    for ($i = 0; $i < $leng; $i++) {
        $token .= $cadena[rand(0, strlen($cadena) - 1)];
    }
    return $token;
}
