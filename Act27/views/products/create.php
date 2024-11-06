<?php 

  include "../../app/config.php";
  include "../../app/BrandsController.php";
  include "../../app/ProductsController.php";


  $brandController = new BrandsController();
  $brands = $brandController->get();

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
                  <li class="breadcrumb-item" aria-current="page">Add New Product</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Añadir producto</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-xl-6">
          <form method="POST" enctype="multipart/form-data" action="../app/ProductsController.php">
            <div class="card">
              <div class="card-header">
                <h5>Product description</h5>
              </div>
              <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label">Nombre del producto</label>
                    <input type="text" name="name" placeholder="Nombre" class="form-control" id="update_name" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Marca</label>
                    <select class="form-select">
                      <option selected>Marcas</option>
                      <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo $brand->id; ?>"><?php echo htmlspecialchars($brand->name); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-0">
                    <label class="form-label">Descripcion del producto</label>
                    <textarea class="form-control" placeholder="Descripcion"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Features</label>
                    <input type="text" name="features" required class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Slug</label>
                    <input type="text" name="slug" required class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <h5>Imagen del producto</h5>
                </div>
                <div class="card-body">
                  <div class="mb-0">
                    <input type="file" class="form-control" name="cover" aria-label="Upload">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body text-end btn-page">
                  <button type="submit" class="btn btn-primary mb-0">Guardar producto</button>
                  <input type="hidden" name="action" value="crear_producto" >
                  <button class="btn btn-outline-secondary mb-0">Cancelar</button>
                </div>
              </div>
            </div>
          </form>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div> 
    
    <?php include "../layouts/footer.php" ?> 

    <?php include "../layouts/scripts.php" ?> 

    <?php include "../layouts/modals.php" ?>
  </body>
  <!-- [Body] end -->undefined
</html>