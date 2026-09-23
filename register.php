<?php

include("database/connection.php");

if(isset($_POST['register']))
{
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        echo "<script>alert('Password and Confirm Password do not match!');</script>";
    }
    else
    {
        $insert = "INSERT INTO users(full_name, email, course, year, password)
        VALUES('$full_name','$email','$course','$year','$password')";

        $result = mysqli_query($conn, $insert);

        if($result)
        {
            echo "<script>alert('Registration Successful');</script>";
        }
        else
        {
            echo "<script>alert('Something went wrong');</script>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SkillFolio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="register-box">

                <h2 class="text-center text-primary">Create Account</h2>

                <p class="text-center text-muted">
                    Create your student portfolio account.
                </p>

                <form method="POST" action="">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" class="form-control" name="course">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Year</label>

                        <select class="form-select" name="year">
                            <option>Select Year</option>
                            <option>First Year</option>
                            <option>Second Year</option>
                            <option>Third Year</option>
                        </select>
                    </div>

                    <!-- Password -->

                    <div class="mb-3">

                        <label class="form-label">Password</label>

                        <div class="input-group">

                            <input type="password"
                            class="form-control"
                            id="password"
                            name="password">

                            <span
                                class="input-group-text"
                                id="togglePassword"
                                style="cursor:pointer;">

                                <i class="bi bi-eye"></i>

                            </span>

                        </div>

                    </div>

                    <!-- Confirm Password -->

                    <div class="mb-3">

                        <label class="form-label">Confirm Password</label>

                        <div class="input-group">

                            <input type="password"
                            class="form-control"
                            id="confirmPassword"
                            name="confirm_password">
                            <span
                                class="input-group-text"
                                id="toggleConfirmPassword"
                                style="cursor:pointer;">

                                <i class="bi bi-eye"></i>

                            </span>

                        </div>

                    </div>

                    <button type="submit"name="register"class="btn btn-primary w-100">
                    Register
                    </button>

                </form>

                <div class="text-center mt-3">
                    Already have an account?
                    <a href="login.php">Login</a>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // Password

    const password = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    togglePassword.addEventListener("click", function () {

        const icon = this.querySelector("i");

        if (password.type === "password") {

            password.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");

        } else {

            password.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");

        }

    });

    // Confirm Password

    const confirmPassword = document.getElementById("confirmPassword");
    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");

    toggleConfirmPassword.addEventListener("click", function () {

        const icon = this.querySelector("i");

        if (confirmPassword.type === "password") {

            confirmPassword.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");

        } else {

            confirmPassword.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");

        }

    });

});

</script>

</body>
</html>