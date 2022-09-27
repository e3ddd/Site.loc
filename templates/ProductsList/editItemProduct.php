<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<form class="p-3" action="##ACTION##" method="##METHOD##">
    <div class="col">
        <input type="text" name="product" value="##PRODUCT##">
        <input type="text" name="price" value="##PRICE##">
    </div>
    <div class="col"><textarea  style="margin-top: 10px; width: 21%" rows="10" name="description">##DESCRIPTION##</textarea></div>
    <div class="col">
    <input type="hidden" name="productNum" value="##NUM##">
    <input class="btn btn-primary" type="submit" name="action" value="Ok">
    </div>
</form>
<div class="col p-3 mt-4"><b>##IMAGES##</b></div>
</body>
</html>