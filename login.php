
<?php

session_start();

include("database/connection.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['email'] = $email;

        header("Location: students/dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SkillFolio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google Login Script -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="register-box">

                <h2 class="text-center text-primary">Login</h2>

                <p class="text-center text-muted">
                    Login to your SkillFolio account
                </p>

                <!-- Normal Login Form -->

                <form method="POST" action="">

                    <div class="mb-3">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Password</label>

                        <div class="input-group">

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required>

                            <span
                                class="input-group-text"
                                id="togglePassword"
                                style="cursor:pointer;">

                                <i class="bi bi-eye"></i>

                            </span>

                        </div>

                    </div>

                    <button
                        type="submit"
                        name="login"
                        class="btn btn-primary w-100">

                        Login

                    </button>

                </form>

                <!-- Google Login -->

                <div class="text-center mt-3">

                    <p class="text-muted">OR</p>

                    <div id="g_id_onload"
                         data-client_id="595703860451-3ilstjt5fusa4l8mcjukt71fuh1ugksv.apps.googleusercontent.com"
                         data-callback="handleGoogleLogin">
                    </div>

                    <div class="d-flex justify-content-center">

                        <div class="g_id_signin"
                             data-type="standard"
                             data-size="large"
                             data-theme="outline"
                             data-text="continue_with"
                             data-shape="rectangular"
                             data-logo_alignment="left">
                        </div>

                    </div>

                </div>

                <!-- Register Link -->

                <div class="text-center mt-3">

                    Don't have an account?

                    <a href="register.php">
                        Register
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Password Show Hide Script -->

<script>

document.addEventListener("DOMContentLoaded", function(){

    const password = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    togglePassword.addEventListener("click", function(){

        const icon = this.querySelector("i");

        if(password.type === "password")
        {
            password.type = "text";

            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
        else
        {
            password.type = "password";

            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }

    });

});

</script>

<!-- Google Login Function -->

<script>

function handleGoogleLogin(response)
{
    var form = document.createElement("form");

    form.method = "POST";
    form.action = "google-login.php";

    var input = document.createElement("input");

    input.type = "hidden";
    input.name = "credential";
    input.value = response.credential;

    form.appendChild(input);

    document.body.appendChild(form);

    form.submit();
}

</script>

</body>

</html>
