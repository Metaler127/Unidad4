<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
    echo "<script>console.log('algo' );</script>";
    
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $slug = isset($_POST['slug']) ? $_POST['slug'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $features = isset($_POST['features']) ? $_POST['features'] : null;
    updateProduct($id, $name, $slug, $description, $features);
    //header("Location: ../main.php");
    exit();
}

function updateProduct($id, $name, $slug, $description, $features) {
    echo "<script>console.log($id);</script>";
    echo $slug;
    echo "<script>console.log(".$slug.");</script>";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => http_build_query([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'id' => $id
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer 14|vWhuhUq3DzXaXvIM3spoGo0587hSmOBeZpdZMhsf'
        )
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    echo "<script>console.log(" . json_encode($response) . ");</script>";

    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }
}