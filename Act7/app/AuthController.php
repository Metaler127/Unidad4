<?php
session_start();

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

            header("Location: ../main.html");
            exit();
        } else {
            echo "<script>alert('Login failed: Incorrect username or password.');</script>";
        }
    } else {
        echo "<script>alert('Username, password, and action are required.');</script>";
    }
}
