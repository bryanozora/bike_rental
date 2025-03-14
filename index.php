
<!DOCTYPE html>

<?php

include './includes/connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $msg = $ebikeui->login($akun, $role, $email, $password);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Inline styling -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #111;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f1c40f;
            font-size: 1.2rem;
        }

        .login-form {
            max-width: 500px;
            width: 100%;
            border: 1px solid #333;
            border-radius: 10px;
            background-color: #222;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease-in-out;
            padding: 0;
        }

        .login-form:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.7);
        }

        .login-form .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0 10px 0; /* Adjusted margin-bottom to 10px */
        }

        .login-form .logo img {
            max-width: 150px; /* Set a maximum width for the logo */
            height: auto;
        }

        .login-form .title {
            background: #f1c40f;
            color: #111;
            padding: 25px;
            text-align: center;
            font-size: 2rem;
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-weight: bold; /* Make the LOGIN text bold */
        }

        .login-form .content {
            padding: 40px;
        }

        .form-label {
            font-weight: 500;
            color: #f1c40f;
            font-size: 1.2rem;
        }

        .form-control {
            border-radius: 5px;
            background-color: #333;
            color: #f1c40f;
            border: 1px solid #555;
            font-size: 1.2rem;
            padding: 10px;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .btn-dark {
            background-color: #f1c40f;
            border: none;
            color: #111;
            font-size: 1.2rem;
            padding: 10px;
        }

        .btn-dark:hover {
            background-color: #d4ac0d;
        }

        .alert {
            margin-top: 20px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <div class="title">
            <strong>LOGIN</strong> <!-- Make the LOGIN text bold -->
        </div>
        <div class="logo">
            <img src="resources/electric.png" alt="Logo">
        </div>
        <div class="content">

            <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>

            <form method="post">
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Email</label>
                    <input type="text" class="form-control" id="inputUsername" name="email" placeholder="Masukkan Email">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-dark mt-1" type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
