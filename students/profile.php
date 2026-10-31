
<?php

session_start();


// Check Login

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}


// Database Connection

include("../database/connection.php");

$email = $_SESSION['email'];


// Update Profile

if(isset($_POST['update_profile']))
{
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);


    $query = "UPDATE users
              SET full_name='$full_name',
                  course='$course',
                  year='$year'
              WHERE email='$email'";


    if(mysqli_query($conn, $query))
    {
        echo "<script>alert('Profile Updated Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Profile Update Failed');</script>";
    }
}


// Get User Data

$query = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);


// Check User Data

if(!$user)
{
    echo "User data not found.";
    exit();
}

?>


<!DOCTYPE html>

<html>

<head>

    <title>My Profile | SkillFolio</title>


    <style>

        body
        {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
            margin: 0;
        }


        .box
        {
            width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }


        h2
        {
            text-align: center;
            color: #333;
        }


        hr
        {
            margin-bottom: 25px;
        }


        label
        {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }


        input,
        select
        {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


        input:focus,
        select:focus
        {
            border-color: #0d6efd;
            outline: none;
        }


        button
        {
            width: 100%;
            padding: 10px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }


        button:hover
        {
            background-color: #0b5ed7;
        }


        .back
        {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #0d6efd;
            text-decoration: none;
        }


        .back:hover
        {
            text-decoration: underline;
        }


    </style>

</head>


<body>


<div class="box">

    <h2>My Profile</h2>

    <hr>


    <form method="POST">


        <!-- Full Name -->

        <label>Full Name</label>

        <input
            type="text"
            name="full_name"
            value="<?php echo htmlspecialchars($user['full_name']); ?>"
            required>


        <!-- Email -->

        <label>Email</label>

        <input
            type="email"
            value="<?php echo htmlspecialchars($user['email']); ?>"
            readonly>


        <!-- Course -->

        <label>Course</label>

        <input
            type="text"
            name="course"
            value="<?php echo htmlspecialchars($user['course']); ?>"
            required>


        <!-- Year -->

        <label>Year</label>

        <select name="year" required>

            <option value="First Year"
                <?php
                if($user['year'] == "First Year")
                {
                    echo "selected";
                }
                ?>>
                First Year
            </option>


            <option value="Second Year"
                <?php
                if($user['year'] == "Second Year")
                {
                    echo "selected";
                }
                ?>>
                Second Year
            </option>


            <option value="Third Year"
                <?php
                if($user['year'] == "Third Year")
                {
                    echo "selected";
                }
                ?>>
                Third Year
            </option>

        </select>


        <!-- Update Button -->

        <button
            type="submit"
            name="update_profile">

            Update Profile

        </button>


    </form>


    <!-- Back to Dashboard -->

    <a class="back" href="dashboard.php">

        Back to Dashboard

    </a>


</div>


</body>

</html>
```
