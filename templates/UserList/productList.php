<form action="" method="GET">
    <input type="hidden" name="page" value="Auth/editUserList">
    <div class="row">
        <div class="col p-2">User: <b>##EMAIL##</b></div>
        <div class="col p-2">Products: <b>##PRODUCT##</b></div>
        <div class="col p-2">
            <input class="btn btn-primary" type="submit" name="action" value="Edit">
            <input class="btn btn-primary" type="submit" name="action" value="Delete">
        </div>
        <div class="col">
            <input type="hidden" name="email" value="##EMAIL##">
            <input type="hidden" name="product" value="##PRODUCT##">
        </div>
    </div>
</form>
