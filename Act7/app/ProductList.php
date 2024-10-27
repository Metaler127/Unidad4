<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer 635|dpQ8rIYnu4zuYBZB71sBeAhBrEtTuTZe8M4SGYjQ'
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$products = json_decode($response, true);

if (isset($products['data']) && !empty($products['data'])) {
    foreach ($products['data'] as $product) {
        $price = isset($product['presentations'][0]['price'][0]['amount']) ? $product['presentations'][0]['price'][0]['amount'] : 'No disponible';
        $brand = htmlspecialchars (isset($product['brand']['name']) ?: $product['brand']['name'] = 'Sin marca');
        $category = isset($product['categories'][0]['name']) ? htmlspecialchars($product['categories'][0]['name']) : 'Sin categoría';
        $img = isset($product['cover']) ? $product['cover'] : "../img/default.png";
        echo <<<HTML
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
            <div class="card bg-dark text-white">
                <img src="{$img}" class="card-img-top" alt="Producto sin imagen disponible">
                <div class="card-body">
                    <h5 class="card-title">{$product['name']}</h5>
                    <p class="card-text">{$product['description']}</p>
                    <p class="card-text"><strong>Marca:</strong> $brand</p>
                    <p class="card-text"><strong>Categoría:</strong> $category</p>
                    <p class="card-text"><strong>Precio:</strong> \${$price}</p>
                    <a href="product.html" class="btn btn-primary">Visitar</a>
                    <a href="#" class="btn btn-warning">Editar</a>
                    <a href="#" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
        HTML;
    }
} else {
    echo '<p>No se encontraron productos.</p>';
}