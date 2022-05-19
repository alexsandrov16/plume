<?php

defined('PLUME') || die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ups!</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #eee;
        color: #3c4955;
    }

    main {
        /*
        display: flex;
        flex-direction: column;
        justify-content: space-between;*/
        text-align: center;
    }

    h1 {
        font-size: 8em;
    } 
    h2 {
        font-size: 2em;
    }
</style>

<body>
    <main>
        <h1><?= $code ?></h1>
        <h2><?= $message ?></h2>
    </main>
</body>

</html>