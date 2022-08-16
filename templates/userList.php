<form action="admin.php" method="POST">
    <table>
        <tr>
            <td><input type="radio" name="num" checked value="<?= $num;?>"</td>
            <td><input type="text" name="email" value="<?= $email;?>"</td>
            <td><input type="text" name="password" value="<?= $pass;?>"></td>
            <td><input type="submit" name="edit" value="Edit"></td>
            <td><input type="submit" name="delete" value="Delete"></td>
        </tr>
    </table>
</form>