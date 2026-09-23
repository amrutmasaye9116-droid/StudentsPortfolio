<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];


// Add Achievement

if(isset($_POST['add_achievement']))
{
    $achievement = $_POST['achievement'];
    $description = $_POST['description'];

    $query = "INSERT INTO achievements
              (email, achievement, description)
              VALUES
              ('$email', '$achievement', '$description')";

    mysqli_query($conn, $query);
}


// Delete Achievement

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $query = "DELETE FROM achievements
              WHERE id='$id' AND email='$email'";

    mysqli_query($conn, $query);
}


// Show Achievements

$query = "SELECT * FROM achievements WHERE email='$email'";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Achievements | SkillFolio</title>

    <style>

        body
        {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .box
        {
            width: 700px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        input,
        textarea
        {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button
        {
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .achievement
        {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 15px;
            border-radius: 8px;
        }

        .delete
        {
            background-color: red;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back
        {
            background-color: gray;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<div class="box">

    <h2>My Achievements</h2>

    <p>Add your achievements</p>

    <hr>


    <form method="POST">

        <label>Achievement</label>

        <input type="text"
               name="achievement"
               placeholder="Enter your achievement"
               required>


        <label>Description</label>

        <textarea
            name="description"
            rows="4"
            placeholder="Enter achievement details"
            required></textarea>


        <button type="submit"
                name="add_achievement">

            Add Achievement

        </button>

    </form>


    <hr>

    <h3>My Achievements</h3>


    <?php

    if(mysqli_num_rows($result) > 0)
    {

        while($data = mysqli_fetch_assoc($result))
        {

    ?>

        <div class="achievement">

            <h3>
                <?php echo $data['achievement']; ?>
            </h3>

            <p>
                <?php echo $data['description']; ?>
            </p>

            <a class="delete"
               href="achievements.php?delete=<?php echo $data['id']; ?>">

                Delete

            </a>

        </div>

    <?php

        }

    }
    else
    {

        echo "<p>No achievements added yet.</p>";

    }

    ?>


    <br><br>

    <a class="back" href="dashboard.php">

        Back to Dashboard

    </a>

</div>

</body>

</html>