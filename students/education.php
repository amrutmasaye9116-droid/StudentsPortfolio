
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


// Add Education

if(isset($_POST['add_education']))
{
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);


    $query = "INSERT INTO education (email, course, college, year)
              VALUES ('$email', '$course', '$college', '$year')";


    if(mysqli_query($conn, $query))
    {
        echo "<script>alert('Education Added Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Education Add Failed');</script>";
    }
}


// Delete Education

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];


    $query = "DELETE FROM education
              WHERE id='$id'
              AND email='$email'";


    if(mysqli_query($conn, $query))
    {
        echo "<script>alert('Education Deleted Successfully');</script>";
    }
}


// Get Education

$query = "SELECT * FROM education
          WHERE email='$email'
          ORDER BY id DESC";


$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>

<html>

<head>

    <title>My Education | SkillFolio</title>


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


        .education
        {
            background-color: #f1f3f5;
            padding: 15px;
            margin-top: 15px;
            border-radius: 5px;
        }


        .education h4
        {
            margin-top: 0;
            margin-bottom: 8px;
        }


        .education p
        {
            margin: 5px 0;
        }


        .delete
        {
            display: inline-block;
            margin-top: 10px;
            color: red;
            text-decoration: none;
        }


        .delete:hover
        {
            text-decoration: underline;
        }


        .back
        {
            display: block;
            margin-top: 20px;
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


    <h2>My Education</h2>

    <hr>


    <!-- Add Education Form -->

    <form method="POST">


        <label>Course</label>

        <input
            type="text"
            name="course"
            placeholder="Example: B.Sc Computer Science"
            required>


        <label>College</label>

        <input
            type="text"
            name="college"
            placeholder="Enter your college name"
            required>


        <label>Year</label>

        <select name="year" required>

            <option value="">Select Year</option>

            <option value="First Year">
                First Year
            </option>

            <option value="Second Year">
                Second Year
            </option>

            <option value="Third Year">
                Third Year
            </option>

            <option value="Final Year">
                Final Year
            </option>

        </select>


        <button
            type="submit"
            name="add_education">

            Add Education

        </button>


    </form>


    <hr>


    <h3>Education Details</h3>


    <?php

    if(mysqli_num_rows($result) > 0)
    {

        while($education = mysqli_fetch_assoc($result))
        {

    ?>


            <div class="education">


                <h4>
                    <?php echo htmlspecialchars($education['course']); ?>
                </h4>


                <p>
                    <b>College:</b>

                    <?php echo htmlspecialchars($education['college']); ?>
                </p>


                <p>
                    <b>Year:</b>

                    <?php echo htmlspecialchars($education['year']); ?>
                </p>


                <a
                    class="delete"
                    href="education.php?delete=<?php echo $education['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this education?');">

                    Delete

                </a>


            </div>


    <?php

        }

    }
    else
    {

        echo "<p>No education details added yet.</p>";

    }

    ?>


    <a
        class="back"
        href="dashboard.php">

        Back to Dashboard

    </a>


</div>


</body>

</html>
