<?php 
	session_start();

	if (isset($_POST['action'])) {
		
		switch ($_POST['action']) {
			
			case 'crear_producto':
				
				$name_var =  $_POST['name'];
				$slug_var = $_POST['slug'];
				$description_var = $_POST['description'];
				$features_var = $_POST['features'];
				$brand = $_POST['brand'];
				$image_var = $_FILES['cover']["tmp_name"];

				$productsController = new ProductsController();

				$productsController->create($name_var,$slug_var,$description_var,$features_var, $brand ,$image_var);

			break; 

			case 'update_producto':
				
				$name_var =  $_POST['name'];
				$slug_var = $_POST['slug'];
				$description_var = $_POST['description'];
				$features_var = $_POST['features'];
				$product_id = $_POST['product_id'];
				$brand = $_POST['brand'];
				$image_var = $_FILES['cover']["tmp_name"];

				$productsController = new ProductsController();

				$productsController->update($name_var,$slug_var,$description_var,$features_var,$product_id, $brand ,$image_var);

			break;
			
			case 'delete_producto':
				$product_id = $_POST['product_id'];

				$productsController = new ProductsController();

				$productsController->delete($product_id);

			break; 
		}
	}

class ProductsController 
{
	
	public function get()
	{
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
		    'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);  
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {
			
			return $response->data;

		}else{
			return [];
		}

	}

	public function getBySlug($slug)
	{
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
		    'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);  
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {
			
			return $response->data;

		}else{
			return [];
		}

	}

	public function create($name_var, $slug_var, $description_var, $features_var, $brand ,$image_var) {
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
				'name' => $name_var,
				'slug' => $slug_var,
				'description' => $description_var,
				'features' => $features_var,
				'brand_id' => $brand,
				'cover' => $image_var == '' ? null : new CURLFile($image_var)
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld'
			),
		));
	
		$response = curl_exec($curl); 
		curl_close($curl);  
		$response = json_decode($response);
	
		if (isset($response->code) && $response->code > 0) {
			header("Location: ../main.php?status=ok");
		} else {
			header("Location: ../main.php?status=error");
		}
	}
	

	public function update($name_var,$slug_var,$description_var,$features_var,$product_id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'PUT',
			CURLOPT_POSTFIELDS => 'name='.$name_var.'&slug='.$slug_var.'&description='.$description_var.'&features='.$features_var.'&id='.$product_id,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld'
			),
		));

		$response = curl_exec($curl); 
		curl_close($curl);  
		$response = json_decode($response);

		if (isset($response->code) && $response->code > 0) {
			
			header("Location: ../main.php?status=ok");

		}else{
			
			header("Location: ../main.php?status=error");
		}

	}

	public function delete($product_id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'. $product_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		header("Location: ../main.php?status=ok");
	}
}

?>