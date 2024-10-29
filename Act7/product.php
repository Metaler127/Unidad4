<?php $slug = $_GET['slug'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
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
curl_close($curl);
$response = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CarlOS</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>

  <body class="bg-dark text-white">
    <div class="container-fluid">
      <div class="row">
        <div class="sidebar d-none d-md-flex flex-column p-3 bg-dark col-md-3">
          <h2 class="text-white">CarlOS</h2>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="#" class="nav-link active">Home</a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">Dashboard</a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">Orders</a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">Products</a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">Customers</a>
            </li>
          </ul>
        </div>
        <div class="main-content col">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar scroll</a>
              <button
                class="navbar-toggler"
                type="button" 
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"
                      >Home</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Dropdown link
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li>
                        <a class="dropdown-item" href="#">Another action</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </li>
                    </ul>
                  </li>
                </ul>
                <form class="d-flex">
                  <input
                    class="form-control me-2 bg-dark text-white"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-outline-light" type="submit">
                    Search
                  </button>
                </form>
              </div>
            </div>
          </nav>

          <div class="row mt-4">
            <div class="col-md-6">
              <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src=<?php echo $response['data']['cover']; ?> class="d-block w-50" alt="..." />
                  </div>
                  <div class="carousel-item">
                    <img src=<?php echo $response['data']['cover']; ?> class="d-block w-50" alt="..." />
                  </div>
                  <div class="carousel-item">
                    <img src=<?php echo $response['data']['cover']; ?> class="d-block w-50" alt="..." />
                  </div>
                </div>
                <button
                  class="carousel-control-prev"
                  type="button"
                  data-bs-target="#carouselExample"
                  data-bs-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button
                  class="carousel-control-next"
                  type="button"
                  data-bs-target="#carouselExample"
                  data-bs-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <?php if (isset($response['data']['name'])): ?>
                  <h5 class="card-title"><?php echo $response['data']['name']; ?></h5>
                <?php else: ?>
                  <h5 class="card-title">Nombre no disponible</h5>
                <?php endif; ?>
                <p class="card-text">
                  <?php echo $response['data']['description']; ?>
                  <br>
                  <br>
                  <?php echo $response['data']['features']; ?>
                  <br>
                  <br>
                  <strong>Marca:</strong> <?php echo $response['data']['brand']['name']; ?>
                  <br>
                  <strong>Categoría:</strong> <?php echo $response['data']['categories'][0]['name']; ?>
                </p>
                <a href="product.html" class="btn btn-primary">Visitar</a>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
