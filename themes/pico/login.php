<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= env('base_url') ?>/themes/pico/css/pico.min.css">
</head>
<style>
    body {
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
    }

    /**Medium */
    @media screen and (min-width: 768px) {
        #login {
            width: 50%
        }
    }

    /**Large */
    @media screen and (min-width: 992px) {
        #login {
            width: 35%
        }
    }
</style>

<body>
    <main id="login" class="container">
        <article>
            <form method="post" autocomplete="off">
                <input type="text" name="user" id="user" placeholder="Usuario">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
                <button type="submit">Enviar</button>
            </form>
            <center>
                <a href="<?= env('base_url') ?>">Volver al sitio</a>
            </center>
        </article>
    </main>
</body>

</html>