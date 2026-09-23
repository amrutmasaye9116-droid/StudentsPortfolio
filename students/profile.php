<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];


// Update Profile

if(isset($_POST['update_profile']))
{
    $full_name = $_POST['full_name'];
    $course = $_POST['course'];
    $year = $_POST['year'];

    $query = "UPDATE users
              SET full_name='$full_name',
                  course='$course',
                  year='$year'
              WHERE email='$email'";

    mysqli_query($conn, $query);

    echo "<script>alert('Profile Updated Successfully');</script>";
}


// Get User Data

$query = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

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

        input,
        select
        {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
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
        }

        .back
        {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #0d6efd;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="box">

    <h2>My Profile</h2>

    <hr>

    <form method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="full_name"
            value="<?php echo $user['full_name']; ?>"
            required>


        <label>Email</label>

        <input
            type="email"
            value="<?php echo $user['email']; ?>"
            readonly>


        <label>Course</label>

        <input
            type="text"
            name="course"
            value="<?php echo $user['course']; ?>"
            required>


        <label>Year</label>

        <select name="year">

            <option
                <?php if($user['year']=="First Year") echo "selected"; ?>>
                First Year
            </option>

            <option
                <?php if($user['year']=="Second Year") echo "selected"; ?>>
                Second Year
            </option>

            <option
                <?php if($user['year']=="Third Year") echo "selected"; ?>>
                Third Year
            </option>

        </select>


        <button
            type="submit"
            name="update_profile">

            Update Profile

        </button>

    </form>


    <a class="back" href="dashboard.php">

        Back to Dashboard

    </a>

</div>

</body>

</html>