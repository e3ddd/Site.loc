<form action="index.php?page=Auth/editUserList" method="GET">
    <input type="hidden" name="page" value="Auth/editUserList">
<div class="row">
    <div class="col p-2">E-mail: <b>##EMAIL##</b></div>
    <div class="col p-2">Password:  <b>##PASSWORD##</b></div>
    <div class="col p-2">
        <input class="btn btn-primary" type="submit" name="action" value="Edit">
        <input class="btn btn-primary" type="submit" name="action" value="Delete">
        <input class="btn btn-primary" type="submit" name="action" value="Products">
    </div>
    <div class="col">
        <input type="hidden" name="email" value="##EMAIL##">
        <input type="hidden" name="password" value="##PASSWORD##">
        <input type="hidden" name="product" value="##PRODUCT##">
    </div>
</div>
</form>
