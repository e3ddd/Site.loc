<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid d-flex p-3 justify-content-center">
    <div class="row bg-white text-center">
        <div class="container">
            <div class="row p-1 ">
                <div class="col">
                    <h4>User e-mail</h4>
                    <form action="adminPanel.php" method="POST">
                    <ul class="list-group">
                        <?php include "templates/userList/showList.php"?>
                        <input class="btn btn-primary" type="submit" name="transit" value="Edit">
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

