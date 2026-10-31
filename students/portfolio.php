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


// Get Profile

$profile_query = "SELECT * FROM users WHERE email='$email'";

$profile_result = mysqli_query($conn, $profile_query);

$user = mysqli_fetch_assoc($profile_result);


// Get Skills

$skill_query = "SELECT * FROM skills WHERE email='$email' ORDER BY id DESC";

$skill_result = mysqli_query($conn, $skill_query);


// Get Education

$education_query = "SELECT * FROM education WHERE email='$email' ORDER BY id DESC";

$education_result = mysqli_query($conn, $education_query);


// Get Projects

$project_query = "SELECT * FROM projects WHERE email='$email' ORDER BY id DESC";

$project_result = mysqli_query($conn, $project_query);


// Get Certificates

$certificate_query = "SELECT * FROM certificates WHERE email='$email' ORDER BY id DESC";

$certificate_result = mysqli_query($conn, $certificate_query);


// Get Achievements

$achievement_query = "SELECT * FROM achievements WHERE email='$email' ORDER BY id DESC";

$achievement_result = mysqli_query($conn, $achievement_query);

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Portfolio | SkillFolio</title>


    <style>

        body
        {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f7fb;
            color: #333;
        }


        /* Navbar */

        .navbar
        {
            background-color: #0d6efd;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .navbar h2
        {
            color: white;
            margin: 0;
        }


        .navbar a
        {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }


        /* Main Container */

        .container
        {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
        }


        /* Profile */

        .profile
        {
            background-color: white;
            padding: 35px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }


        .profile h1
        {
            margin-bottom: 10px;
            color: #0d6efd;
        }


        .profile p
        {
            margin: 7px;
        }


        /* Sections */

        .section
        {
            background-color: white;
            padding: 25px;
            margin-top: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }


        .section h2
        {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }


        /* Skills */

        .skill
        {
            display: inline-block;
            background-color: #e9f2ff;
            color: #0d6efd;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 20px;
        }


        /* Education */

        .education
        {
            background-color: #f5f7fb;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }


        .education h3
        {
            margin-top: 0;
        }


        /* Projects */

        .project
        {
            background-color: #f5f7fb;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }


        .project h3
        {
            margin-top: 0;
        }


        /* Certificates */

        .certificate
        {
            background-color: #f5f7fb;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }


        /* Achievements */

        .achievement
        {
            background-color: #f5f7fb;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }


        /* Buttons */

        .button
        {
            display: inline-block;
            padding: 8px 15px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 8px;
        }


        .button:hover
        {
            background-color: #0b5ed7;
        }


        .back
        {
            display: block;
            text-align: center;
            margin: 30px;
            color: #0d6efd;
            text-decoration: none;
        }


        /* Empty Message */

        .empty
        {
            color: gray;
        }


    </style>

</head>


<body>


<!-- Navbar -->

<div class="navbar">

    <h2>SkillFolio</h2>

    <div>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="../logout.php">
            Logout
        </a>

    </div>

</div>


<div class="container">


    <!-- Profile Section -->

    <div class="profile">

        <h1>
            <?php echo htmlspecialchars($user['full_name']); ?>
        </h1>


        <p>
            <b>Email:</b>

            <?php echo htmlspecialchars($user['email']); ?>
        </p>


        <p>
            <b>Course:</b>

            <?php echo htmlspecialchars($user['course']); ?>
        </p>


        <p>
            <b>Year:</b>

            <?php echo htmlspecialchars($user['year']); ?>
        </p>

    </div>



    <!-- Skills Section -->

    <div class="section">

        <h2>My Skills</h2>


        <?php

        if(mysqli_num_rows($skill_result) > 0)
        {

            while($skill = mysqli_fetch_assoc($skill_result))
            {

        ?>

                <span class="skill">

                    <?php echo htmlspecialchars($skill['skill_name']); ?>

                </span>


        <?php

            }

        }
        else
        {

            echo "<p class='empty'>No skills added yet.</p>";

        }

        ?>

    </div>



    <!-- Education Section -->

    <div class="section">

        <h2>Education</h2>


        <?php

        if(mysqli_num_rows($education_result) > 0)
        {

            while($education = mysqli_fetch_assoc($education_result))
            {

        ?>

                <div class="education">

                    <h3>

                        <?php echo htmlspecialchars($education['course']); ?>

                    </h3>


                    <p>

                        <b>College:</b>

                        <?php echo htmlspecialchars($education['college']); ?>

                    </p>


                    <p>

                        <b>Year:</b>

                        <?php echo htmlspecialchars($education['year']); ?>

                    </p>

                </div>


        <?php

            }

        }
        else
        {

            echo "<p class='empty'>No education details added yet.</p>";

        }

        ?>

    </div>



    <!-- Projects Section -->

    <div class="section">

        <h2>Projects</h2>


        <?php

        if(mysqli_num_rows($project_result) > 0)
        {

            while($project = mysqli_fetch_assoc($project_result))
            {

        ?>

                <div class="project">

                    <h3>

                        <?php echo htmlspecialchars($project['project_name']); ?>

                    </h3>


                    <p>

                        <?php echo htmlspecialchars($project['description']); ?>

                    </p>


                    <?php

                    if(!empty($project['project_link']))
                    {

                    ?>

                        <a
                            class="button"
                            href="<?php echo htmlspecialchars($project['project_link']); ?>"
                            target="_blank">

                            View Project

                        </a>

                    <?php

                    }

                    ?>

                </div>


        <?php

            }

        }
        else
        {

            echo "<p class='empty'>No projects added yet.</p>";

        }

        ?>

    </div>



    <!-- Certificates Section -->

    <div class="section">

        <h2>Certificates</h2>


        <?php

        if(mysqli_num_rows($certificate_result) > 0)
        {

            while($certificate = mysqli_fetch_assoc($certificate_result))
            {

        ?>

                <div class="certificate">

                    <h3>

                        <?php echo htmlspecialchars($certificate['certificate_name']); ?>

                    </h3>


                    <?php

                    if(!empty($certificate['certificate_link']))
                    {

                    ?>

                        <a
                            class="button"
                            href="<?php echo htmlspecialchars($certificate['certificate_link']); ?>"
                            target="_blank">

                            View Certificate

                        </a>

                    <?php

                    }

                    ?>

                </div>


        <?php

            }

        }
        else
        {

            echo "<p class='empty'>No certificates added yet.</p>";

        }

        ?>

    </div>



    <!-- Achievements Section -->

    <div class="section">

        <h2>Achievements</h2>


        <?php

        if(mysqli_num_rows($achievement_result) > 0)
        {

            while($achievement = mysqli_fetch_assoc($achievement_result))
            {

        ?>

                <div class="achievement">

                    <h3>

                        <?php echo htmlspecialchars($achievement['achievement']); ?>

                    </h3>


                    <p>

                        <?php echo htmlspecialchars($achievement['description']); ?>

                    </p>

                </div>


        <?php

            }

        }
        else
        {

            echo "<p class='empty'>No achievements added yet.</p>";

        }

        ?>

    </div>



    <a
        class="back"
        href="dashboard.php">

        ← Back to Dashboard

    </a>


</div>


</body>

</html>
