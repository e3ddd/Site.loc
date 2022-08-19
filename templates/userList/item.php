<div class="container">
        <div class="row-justify-content-center p-1">
            <input type="checkbox" name="num" value="<?= $user['id'];?>" checked>
            <input type="text" name="email" value="<?= $user['email'];?>">
            <input type="text" name="password" value="<?= $user['password'];?>">
            <input class="btn btn-primary" type="submit" name="edit" value="Edit">
            <input class="btn btn-primary" type="submit" name="delete" value="Delete">
        </div>
</div>

