<?php 
    include_once "include/header.php";
?>
<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=products_crud;','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $pdo->prepare("SELECT * FROM products");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Products Crud</h1>
<a href="create.php" type="button" class="btn btn-outline-success">Add Product</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($products as $i => $product) { ?>
      <tr>
      <th scope="row"><?php echo $i +1 ?></th>
      <td><img class="product-img" src="<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>"></td>
      <td><?php echo $product['title'] ?></td>
      <td><?php echo $product['price'] ?></td>
      <td><?php echo $product['create_date'] ?></td>
      <td>
        <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>


<?php 
    include_once "include/footer.php";
?>