<?php
$loader = false;

function addProduct($name, $slug, $description, $features) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 14|vWhuhUq3DzXaXvIM3spoGo0587hSmOBeZpdZMhsf'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function getProducts() {
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
            'Authorization: Bearer 14|vWhuhUq3DzXaXvIM3spoGo0587hSmOBeZpdZMhsf'
        ),
    ));

    $response = curl_exec($curl);
    
    if(curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
        return null;
    }

    curl_close($curl);

    $data = json_decode($response, true);

    if (isset($data['error'])) {
        echo "Error en la API: " . $data['error'];
        return null;
    }

    return $data;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $slug = isset($_POST['slug']) ? $_POST['slug'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $features = isset($_POST['features']) ? $_POST['features'] : null;
    addProduct($name, $slug, $description, $features);
    //header("Location: ../main.php");
    exit();
}

class Product
{
    public function Products (){
        $products = getProducts();
        foreach (array_reverse($products['data']) as $product) {
            $price = isset($product['presentations'][0]['price'][0]['amount']) ? '$' . $product['presentations'][0]['price'][0]['amount'] : 'No disponible';
            $brand = htmlspecialchars(isset($product['brand']['name']) ?: $product['brand']['name'] = 'Sin marca');
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
                        <p class="card-text"><strong>Precio:</strong> {$price}</p>
                        <a href="product.php?slug={$product['slug']}" class="btn btn-primary">Visitar</a>
                        <a 
                        href="#"
                        data-id="{$product['id']}"
                        data-name="{$product['name']}"
                        data-slug="{$product['slug']}"
                        data-description="{$product['description']}"
                        data-features="{$product['features']}"
                        class="btn btn-warning ms-auto editBtnModal"
                        data-bs-toggle="modal"
                        data-bs-target="#Modal">
                            Editar
                        </a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
    
                <form method="POST" action="app/UpdateProduct.php">
                    <div
                    class="modal fade"
                    id="Modal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                    >
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Editar Producto
                            </h5>
                            <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <p>Nombre:</p>
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">🛒</span>
                            <input
                                type="text"
                                name="name"
                                id="nameEdit"
                                class="form-control"
                                placeholder="Nombre"
                                aria-label="Producto"
                                aria-describedby="basic-addon1"
                                required
                            />
                            </div>
                            <p>Slug:</p>
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">🥸</span>
                            <input
                                type="text"
                                name="slug"
                                id="slugEdit"
                                class="form-control"
                                placeholder="Slug"
                                aria-label="Producto"
                                aria-describedby="basic-addon1"
                                required
                            />
                            </div>
                            <p>Descripción:</p>
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">📄</span>
                            <textarea
                                type="text"
                                name="description"
                                id="descriptionEdit"
                                class="form-control"
                                placeholder="Descripción"
                                aria-label="Producto"
                                aria-describedby="basic-addon1"
                                required
                            ></textarea>
                            </div>
                            <p>Características:</p>
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">🔎</span>
                            <input
                                type="text"
                                name="features"
                                id="featuresEdit"
                                class="form-control"
                                placeholder="Características"
                                aria-label="Producto"
                                aria-describedby="basic-addon1"
                                required
                            />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            >
                            Cerrar
                            </button>
                            <button type="submit" class="btn btn-success">
                            Guardar producto
                            </button>
                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="id" id="idEdit"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {      
                    const buttons = document.querySelectorAll('.editBtnModal');
                    buttons.forEach(button => {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');
                            const name = button.getAttribute('data-name');
                            const slug = button.getAttribute('data-slug');
                            const description = button.getAttribute('data-description');
                            const features = button.getAttribute('data-features');
                            document.getElementById('nameEdit').value = name;
                            document.getElementById('slugEdit').value = slug;
                            document.getElementById('descriptionEdit').value = description;
                            document.getElementById('featuresEdit').value = features;
                            document.getElementById('idEdit').value = id;
                        });
                    });
                });
            </script>
            HTML;
        }
    }
}
?>