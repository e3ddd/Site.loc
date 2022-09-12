<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
    <div class="row text-center bg-white shadow-sm">
            <div class="col border rounded p-4">
                <form action="index.php?page=Auth/RegAndSearch" method="POST">
                    <input class="btn btn-primary" type="submit" name="action" value="Registration and Search">
                </form>
            </div>
            <div class="col border rounded p-4">
                <form action="index.php?page=Auth/AdminPanel" method="POST">
                    <input class="btn btn-primary" type="submit" name="action" value="Admin Panel">
                </form>
            </div>
            <div class="col border rounded p-4">
                <form action="index.php?page=Auth/ProductListForm" method="POST">
                    <input class="btn btn-primary" type="submit" name="action" value="Add Product">
                </form>
            </div>
        </div>
</div>
</body>
</html>
