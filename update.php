<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=products_crud;','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'] ?? null;
    if(!$id){
        header('Location: index.php');
        exit;
    }

    $statement = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('Location: index.php');
?>


<?php 
include_once "include/header.php";
?>


<h1>Update Product</h1>
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