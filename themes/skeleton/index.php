<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= env('base_url') ?>/themes/skeleton/css/normalize.css">
    <link rel="stylesheet" href="<?= env('base_url') ?>/themes/skeleton/css/skeleton.css">

    <link rel="shortcut icon" href="<?=env('base_url')?>/we.png" type="image/x-icon">
</head>

<style>
    h1 {
        text-align: center;
        margin-top: 2em;
    }

    .container {
        margin-top: .5em;
    }

    strong a{
        font-size: 2em;
        text-decoration: none;
        color: #333;
    }
</style>

<body>
    <div class="container">
        <!-- columns should be the immediate child of a .row -->
        <div class="row">
            <div class="ten columns">
                <strong>
                    <a href="<?= env('base_url') ?>"><?= env('title') ?></a>
                </strong>
            </div>
            <div class="two columns">
                <a href="<?= env('base_url') ?>/admin" class="button button-primary">Admin</a>
            </div>
        </div>

    </div>

    <h1><?= $message ?></h1>
</body>

</html>