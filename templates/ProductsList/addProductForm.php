<form action="index.php?page=Auth/addProduct" method="POST">
    <div class="col">
        <h4>Add Product</h4>
    </div>
    <div class="row-justify-content-center">
        <label for="inputEmail" class="p-1">User</label>
        <input type="email" name="email" class="form-control input-sm" id="inputEmail"  placeholder="Enter user e-mail">
    </div>
    <div class="row-justify-content-center">
        <label for="inputProduct" class="p-1">Product</label>
        <input type="text" name="product" class="form-control input-sm" id="inputProduct"  placeholder="Enter needle product">
    </div>
    <div class="row-justify-content-center">
        <label for="inputProduct" class="p-1">Price</label>
        <input type="text" name="price" class="form-control input-sm" id="inputProduct"  placeholder="Enter price">
    </div>
    <div class="row-justify-content-center">
        <label for="inputProduct" class="p-1">Description</label>
        <input type="text" name="description" class="form-control input-sm" id="inputProduct"  placeholder="Enter description">
    </div>
    <div class="row-justify-content-center p-3 border-bottom">
        <input class="btn btn-primary" type="submit" name="action" value="Add">
    </div>
</form>
<form action="index.php?page=Auth/addProductImages" method="post" enctype="multipart/form-data">
    <div class="row-justify-content-center">
        <label for="inputEmail" class="p-1">User</label>
        <input type="email" name="email" class="form-control input-sm" id="inputEmail"  placeholder="Enter user e-mail">
    </div>
    <div class="row-justify-content-center">
        <label for="inputProduct" class="p-1">Product ID</label>
        <input type="text" name="productId" class="form-control input-sm" id="inputProduct"  placeholder="Enter needle product ID">
    </div>
    <div class="row-justify-content-center">
    <label for="fileToUpload" class="p-2">Select image to upload:</label>
    <input  class="form-control input-sm" type="file" name="fileToUpload" id="fileToUpload">
    <input class="btn btn-primary" type="submit" value="Upload Image" name="uploadImg">
    </div>
</form>

