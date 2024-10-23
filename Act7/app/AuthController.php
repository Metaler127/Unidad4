<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturamos los datos del formulario
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    // Verificamos si los datos necesarios están presentes y la acción es "login"
    if ($username && $password && $action === 'login') {

        // Inicializamos la solicitud CURL para realizar el login contra la API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login', // URL de la API
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $username,  // Usamos el 'username' como 'email'
                'password' => $password
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Decodificamos la respuesta JSON (como objeto)
        $responseArray = json_decode($response);

        if (isset($responseArray->message) && $responseArray->message === "Registro obtenido correctamente" && isset($responseArray->data)) {
            // Login exitoso, guardamos los datos del usuario en la sesión
            $_SESSION['user'] = $responseArray->data;

            // Redirigimos a la página principal
            header("Location: ../main.html");
            exit(); // Terminamos el script después de redirigir
        } else {
            // En caso de fallo, mostramos el mensaje de error
            echo 'Login failed: ' . $responseArray->message;
        }
    } else {
        echo 'Username, password, and action are required.';
    }
}
