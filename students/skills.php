<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];


// Add Skill
if(isset($_POST['add_skill']))
{
    $skill_name = $_POST['skill_name'];

    if($skill_name != "")
    {
        $query = "INSERT INTO skills(email, skill_name)
                  VALUES('$email', '$skill_name')";

        mysqli_query($conn, $query);
    }
}


// Delete Skill
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $query = "DELETE FROM skills
              WHERE id='$id' AND email='$email'";

    mysqli_query($conn, $query);
}


// Get Skills
$query = "SELECT * FROM skills WHERE email='$email'";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Skills | SkillFolio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <style>

        body{
            background:#f5f7fb;
            font-family:'Poppins',sans-serif;
        }

        .skills-box{
            max-width:700px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }

        .skill-icon{
            font-size:60px;
            color:#0d6efd;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="skills-box">

        <div class="text-center">

            <i class="bi bi-lightbulb skill-icon"></i>

            <h2 class="mt-3">My Skills</h2>

            <p class="text-muted">
                Add and manage your technical skills
            </p>

        </div>

        <hr>


        <!-- Add Skill Form -->

        <form method="POST">

            <div class="input-group mb-4">

                <input
                    type="text"
                    name="skill_name"
                    class="form-control"
                    placeholder="Enter your skill"
                    required>

                <button
                    type="submit"
                    name="add_skill"
                    class="btn btn-primary">

                    <i class="bi bi-plus-lg"></i>
                    Add Skill

                </button>

            </div>

        </form>


        <!-- Skills List -->

        <h5 class="mb-3">My Skills</h5>

        <?php

        if(mysqli_num_rows($result) > 0)
        {

            while($skill = mysqli_fetch_assoc($result))
            {

        ?>

        <div class="d-flex justify-content-between align-items-center
                    border rounded p-3 mb-2">

            <span>

                <i class="bi bi-check-circle text-primary"></i>

                <?php echo $skill['skill_name']; ?>

            </span>

            <a
                href="skills.php?delete=<?php echo $skill['id']; ?>"
                class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure you want to delete this skill?');">

                <i class="bi bi-trash"></i>

                Delete

            </a>

        </div>

        <?php

            }

        }
        else
        {

        ?>

        <p class="text-muted text-center">

            No skills added yet.

        </p>

        <?php

        }

        ?>


        <div class="text-center mt-4">

            <a href="dashboard.php"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Back to Dashboard

            </a>

        </div>

    </div>

</div>

</body>

</html>