<?php

require_once 'init.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Giriş</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="h-100 d-flex align-items-center justify-content-center mt-5">
        <div class="card w-45">

            <div class="card-header text-center mt-2">
                Şen Market
            </div>

            <div class="card-body">
                <form method="POST" action="api/login.php">

                    <?php displayFlashMessage('login') ?>

                    <div>
                        <label class="form-label">Email</label>
                        <input
                            class="form-control"
                            type="text"
                            name="email"
                            required="true"
                        />
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Şifre</label>
                        <input
                            class="form-control"
                            type="password"
                            name="password"
                            required="true"
                        />
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <button class="btn btn-danger" type="submit">Giriş</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>