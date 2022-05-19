<?php
defined('PLUME') || die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= env('base_url') ?>/src/framework/View/debug.css">
</head>

<body>
    <div class="header container">
        <h1><?= $title ?></h1>
        <p><?= $message ?></p>
    </div>
    <div class="source container">
        <div class="titlebar">
            <p>
                <?= str_replace(ABS_PATH, '..'.DS, $file), '[', $line, ']' ?>
            </p>
            <div style="float: right;">
                <span class="dot" style="background:#ED594A;"></span>
                <span class="dot" style="background:#FDD800;"></span>
                <span class="dot" style="background:#5AC05A;"></span>
            </div>
        </div>
        <?= source($file, $line) ?>
    </div>
    <div class="container">
        <h1>Detalles</h1>
        <h2>Response</h2>
        <?= 'HTTP/' . $response->getProtocolVersion() . ' ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase() ?>
        <br>
        <h2>Request</h2>
        <?= $request->getMethod() . ' ' . $request->getRequestTarget() . ' HTTP/' . $request->getProtocolVersion() ?>
        <br>
        <?php
        foreach ($request->getHeaders() as $name => $value) { ?>
            <b><?= str_replace('HTTP-', '', $name) ?>:</b> <?= $value ?><br>
        <?php } ?><br>
    </div>
</body>

<?php
//var_dump($a_trace);
//echo "$file[$line]";
?>

</html>