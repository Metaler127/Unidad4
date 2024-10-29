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
            <div class="col-12 d-flex justify-content-end">
              <a
                href="#"
                class="btn btn-success ms-auto"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
                >Añadir</a
              >
            </div>
            <form method="POST" action="app/ProductController.php">
              <div
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        Añadir Producto
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
                      <input type="hidden" name="action" value="add_product" />
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <?php include 'app/ProductController.php'; ?>
        </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
