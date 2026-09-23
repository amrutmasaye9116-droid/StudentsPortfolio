<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];


// Add Project
if(isset($_POST['add_project']))
{
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $project_link = $_POST['project_link'];

    if($project_name != "")
    {
        $query = "INSERT INTO projects(email, project_name, description, project_link)
                  VALUES('$email', '$project_name', '$description', '$project_link')";

        mysqli_query($conn, $query);
    }
}


// Delete Project
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $query = "DELETE FROM projects
              WHERE id='$id' AND email='$email'";

    mysqli_query($conn, $query);
}


// Get Projects
$query = "SELECT * FROM projects WHERE email='$email'";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Projects | SkillFolio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    <style>

        body{
            background:#f5f7fb;
            font-family:'Poppins',sans-serif;
        }

        .project-box{
            max-width:800px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }

        .project-icon{
            font-size:60px;
            color:#0d6efd;
        }

        .project-card{
            border:1px solid #ddd;
            border-radius:10px;
            padding:20px;
            margin-bottom:15px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="project-box">

        <!-- Heading -->

        <div class="text-center">

            <i class="bi bi-folder project-icon"></i>

            <h2 class="mt-3">My Projects</h2>

            <p class="text-muted">
                Add and manage your projects
            </p>

        </div>

        <hr>


        <!-- Add Project Form -->

        <form method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Project Name
                </label>

                <input
                    type="text"
                    name="project_name"
                    class="form-control"
                    placeholder="Enter project name"
                    required>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Project Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Enter project description"
                    required></textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Project Link
                </label>

                <input
                    type="url"
                    name="project_link"
                    class="form-control"
                    placeholder="https://github.com/username/project">

            </div>


            <button
                type="submit"
                name="add_project"
                class="btn btn-primary w-100">

                <i class="bi bi-plus-lg"></i>

                Add Project

            </button>

        </form>


        <hr class="my-4">


        <!-- Project List -->

        <h5 class="mb-3">
            My Projects
        </h5>


        <?php

        if(mysqli_num_rows($result) > 0)
        {

            while($project = mysqli_fetch_assoc($result))
            {

        ?>

        <div class="project-card">

            <h5>

                <i class="bi bi-folder-fill text-primary"></i>

                <?php echo $project['project_name']; ?>

            </h5>


            <p class="text-muted">

                <?php echo $project['description']; ?>

            </p>


            <?php

            if(!empty($project['project_link']))
            {

            ?>

            <a
                href="<?php echo $project['project_link']; ?>"
                target="_blank"
                class="btn btn-sm btn-primary">

                <i class="bi bi-link-45deg"></i>

                View Project

            </a>

            <?php

            }

            ?>


            <a
                href="projects.php?delete=<?php echo $project['id']; ?>"
                class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure you want to delete this project?');">

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

            No projects added yet.

        </p>

        <?php

        }

        ?>


        <!-- Back Button -->

        <div class="text-center mt-4">

            <a
                href="dashboard.php"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Back to Dashboard

            </a>

        </div>

    </div>

</div>

</body>

</html>