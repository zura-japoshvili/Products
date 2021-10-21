<?php 
include_once "include/header.php";
?>
<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=products_crud;','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $errors = [];

    $title = '';
    $description = '';
    $price = '';


  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
    VALUES (:title, :image, :description, :price, :date)");

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image'] ?? null;
    $imagePath = '';
    
    if(!is_dir('images')){
      mkdir('images');
    }


    if($image){
      $imagePath = 'images/' . randomString(8) . "/" . $image['name'];
      echo $imagePath;
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);  
    }

    if(!$title){
      $errors[] = 'Product title is required';
    }
    if(!$price){
      $errors[] = 'Product price is required';
    }
    if(empty($errors)){
      $statement->bindValue(':title', $title);
      $statement->bindValue(':image', $imagePath);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':date', date('Y-m-d H:i:s'));
  
      $statement->execute();
      header('Location: index.php');
    }
  }
  function randomString($n){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0;$i < $n;$i++){
      $index = rand(0,strlen($characters) -1);
      $str .= $characters[$index];
    }
    return $str;
  }
?>

<h1>Create Product</h1>
<?php if(!empty($errors)): ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach($errors as $error):?>
      <div><?php echo $error ?></div>
    <?php endforeach ?>
  </div>
<?php endif ?>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Product Image</label><br>
    <input type="file" name="image">
  </div>
  <div class="mb-3">
    <label>Product Title</label>
    <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
  </div>
  <div class="mb-3">
    <label>Product Description</label>
    <textarea  name="description" class="form-control"><?php echo $description ?></textarea>
  </div>
  <div class="mb-3">
    <label>Product Price</label>
    <input step="0.01" type="number" name="price" class="form-control" value="<?php echo $price ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php 
include_once "include/footer.php";
?>