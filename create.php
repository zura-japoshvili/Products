<?php 
include_once "include/header.php";
?>
<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=products_crud;','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    $statement = $pdo->prepare("INSERT INTO product (title, image, description, price, create_date)
          VALUES (:title, :image, :description, :price, :date)");
    $statement->bindValue(':title', $title);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':date', date('Y-m-d H:i:s'));

    $statement->execute();
?>

<h1>Create Product</h1>
<form method="post">
  <div class="mb-3">
    <label>Product Image</label><br>
    <input type="file" name="image">
  </div>
  <div class="mb-3">
    <label>Product Title</label>
    <input type="text" name="title" class="form-control">
  </div>
  <div class="mb-3">
    <label>Product Description</label>
    <textarea  name="description" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label>Product Price</label>
    <input type="number" name="price" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php 
include_once "include/footer.php";
?>