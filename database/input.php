<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="h2">Items Registration</h2>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 form-floating">
                <input id="code" type="text" class="form-control" name="code" value="<?= @$item['code'] ?>">
                <label for="code">Code</label>
                <p class="text-danger pt-2"><?= @$errors['code'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="name" type="text" class="form-control" name="name" value="<?= @$item['name'] ?>">
                <label for="name">Name</label>
                <p class="text-danger pt-2"><?= @$errors['name'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="price" type="text" class="form-control" name="price" value="<?= @$item['price'] ?>">
                <label for="price">Price</label>
                <p class="text-danger pt-2"><?= @$errors['price'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="stock" type="text" class="form-control" name="stock" value="<?= @$item['stock'] ?>">
                <label for="stock">Quantity</label>
                <p class="text-danger pt-2"><?= @$errors['stock'] ?></p>
            </div>
            <div class="mb-3 form-floating">
                <input id="image" type="file" class="form-control" name="image">
                <label for="image">Image</label>
                <p class="text-danger pt-2"><?= @$errors['image'] ?></p>
            </div>
            <button class="btn btn-primary">Registration</button>
            <a class="btn btn-outline-primary" href="./">Return</a>
        </form>
    </div>
</body>

</html>