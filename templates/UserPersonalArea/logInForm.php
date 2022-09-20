<form action="index.php?page=Auth/logIn" method="POST">
    <div class="col">
        <h4>Login Form</h4>
    </div>
    <div class="row-justify-content-center">
        <label for="inputEmail" class="p-1">Your Email</label>
        <input type="email" name="email" class="form-control input-sm" id="inputEmail"  placeholder="Enter email">
    </div>
    <div class="row-justify-content-center">
        <label for="inputPassword" class="p-1">Your Password</label>
        <input type="password" name="password" class="form-control input-sm" id="inputPassword"  placeholder="Enter password">
    </div>
    <div class="row-justify-content-center p-3">
        <input class="btn btn-primary" type="submit" name="action" value="Login">
    </div>
    </form>