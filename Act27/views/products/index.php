<?php 

  include "../../app/config.php";
  include "../../app/ProductsController.php";
	$productsController = new ProductsController();
	$productos = array_reverse($productsController->get());

?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <?php include "../layouts/head.php" ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    
    <!-- [ Pre-loader ] End --> 
    <?php include "../layouts/sidebar.php" ?> 
    <?php include "../layouts/navbar.php" ?>
    
    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                  <li class="breadcrumb-item" aria-current="page">Products</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Products</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row overflow-x-hidden">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="ecom-wrapper">
              <div class="ecom-content">
                <div class="d-sm-flex align-items-center mb-4">
                  <ul class="list-inline me-auto my-1">
                    <li class="list-inline-item">
                      <form class="form-search">
                        <i class="ph-duotone ph-magnifying-glass icon-search"></i>
                        <input type="search" class="form-control mr-2" placeholder="Search Products" />
                        <button type="button" class="btn btn-success float-end mr-3" onclick="window.location.href='products/create';" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Agregar
                      </button>

                      </form>
                    </li>
                  </ul>
                </div>

                <div class="col-10">
                  <div class="main p-2">
                    <div class="row">
                      <?php if (isset($productos) && count($productos)): ?>
                        <?php foreach ($productos as $product): ?>

                          <div class="col-sm-6 col-xl-4">
                            <div class="card product-card">
                              <div class="card-img-top">
                                  <a href="details/<?= $product -> slug ?>">
                                  <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
                                    <img 
                                      src="<?= $product->cover ?>" 
                                      alt="<?= htmlspecialchars($product->name) ?>" 
                                      class="img-fluid" 
                                      style="max-height: 100%; max-width: 100%; object-fit: contain;" 
                                      onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?= urlencode($product->name); ?>';" />
                                  </div>
                                </a>
                                <div class="card-body position-absolute end-0 top-0">
                                  <div class="form-check prod-likes">
                                    <input type="checkbox" class="form-check-input" />
                                    <i data-feather="heart" class="prod-likes-icon"></i>
                                  </div>
                                </div>
                              </div>
                              <div class="card-body">
                                <a href="ecom_product-details.html">
                                  <p class="prod-content mb-0 text-muted"><?= $product->name ?></p>
                                </a>
                                <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                                  <p class="card-text">
                                    <?= $product->description ?>
                                  </p>
                                  <h4 class="mb-0 text-truncate"><b>$299.00</b> <span class="text-sm text-muted f-w-400 text-decoration-line-through">$399.00</span></h4>
                                  <div class="d-inline-flex align-items-center">
                                    <i class="ph-duotone ph-star text-warning me-1"></i>
                                    4.5 <small class="text-muted">/ 5</small>
                                  </div>
                                </div>
                                <div class="d-flex">
                                  <div class="flex-shrink-0">
                                    <a
                                      href="#"
                                      class="avtar avtar-s btn-link-secondary btn-prod-card"
                                      data-bs-toggle="offcanvas"
                                      data-bs-target="#productOffcanvas">
                                      <i class="ph-duotone ph-eye f-18"></i>
                                    </a>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                    <div class="d-grid">
                                      <button class="btn btn-link-secondary btn-prod-card">Editar</button>
                                      <form action="/app/ProductsController.php" method="POST" id="delete-form-<?= $product->id ?>">
                                        <button onclick="eliminar(<?= $product->id ?>)" class="btn btn-link-secondary btn-prod-card">Eliminar</button>
                                        <input type="hidden" name="action" value="delete_producto">
                                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach ?>
                      <?php endif ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="productOffcanvas" aria-labelledby="productOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="productOffcanvasLabel">Product Details</h5>
        <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="offcanvas">
          <i class="ti ti-x f-20"></i>
        </a>
      </div>
      <div class="offcanvas-body">
        <div class="card product-card shadow-none border-0">
          <div class="card-img-top p-0">
            <a href="ecom_product-details.html">
              <img src="<?= BASE_PATH ?>assets/images/application/img-prod-4.jpg" alt="image" class="img-prod img-fluid" />
            </a>
            <div class="card-body position-absolute end-0 top-0">
              <div class="form-check prod-likes">
                <input type="checkbox" class="form-check-input" />
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-heart prod-likes-icon"
                >
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                  ></path>
                </svg>
              </div>
            </div>
            <div class="card-body position-absolute start-0 top-0">
              <span class="badge bg-danger badge-prod-card">30%</span>
            </div>
          </div>
        </div>
        <h5>Glitter gold Mesh Walking Shoes</h5>
        <p class="text-muted"
          >Image Enlargement: After shooting, you can enlarge photographs of the objects for clear zoomed view. Change In Aspect Ratio:
          Boldly crop the subject and save it with a composition that has impact.</p
        >
        <ul class="list-group list-group-flush">
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Price</p>
              <h4 class="mb-0"><b>$299.00</b><span class="mx-2 f-14 text-muted f-w-400 text-decoration-line-through">$399.00</span></h4>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Categories</p>
              <h6 class="mb-0">Shoes</h6>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Status</p>
              <h6 class="mb-0"><span class="badge bg-warning rounded-pill">Process</span></h6>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Brands</p>
              <h6 class="mb-0"><img src="<?= BASE_PATH ?>assets/images/application/img-prod-brand-1.png" alt="user-image" class="wid-40" /></h6>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    
    <?php include "../layouts/footer.php" ?> 

    <?php include "../layouts/scripts.php" ?> 

    <?php include "../layouts/modals.php" ?>
    <script type="text/javascript">
      function editar(target){
        let product = JSON.parse(target.dataset.product)

        console.log(product.name)

        document.getElementById("update_name").value = product.name
        document.getElementById("update_slug").value = product.slug
        document.getElementById("update_description").value = product.description
        document.getElementById("update_features").value = product.features
        document.getElementById("update_id_product").value = product.id
      }

      function eliminar(id) {
        swal({
          title: "¿Deseas eliminar?",
          text: "Confirmar para eliminar este producto",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Producto eliminado con éxito!", {
              icon: "success",
            });
            
            // Encuentra el formulario de eliminación usando el ID dinámico
            const form = document.getElementById("delete-form-" + id);
            form.submit(); // Envía el formulario
          } else {
            swal("Tu producto no ha sido eliminado!");
          }
        });
        console.log(id);
      }

    </script>
  </body>
  <!-- [Body] end -->undefined
</html>



