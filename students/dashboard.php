<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];

/* Count Skills */
$skill_query = "SELECT COUNT(*) AS total FROM skills WHERE email='$email'";
$skill_result = mysqli_query($conn, $skill_query);
$skill_data = mysqli_fetch_assoc($skill_result);
$total_skills = $skill_data['total'];

/* Count Projects */
$project_query = "SELECT COUNT(*) AS total FROM projects WHERE email='$email'";
$project_result = mysqli_query($conn, $project_query);
$project_data = mysqli_fetch_assoc($project_result);
$total_projects = $project_data['total'];

/* Count Certificates */
$certificate_query = "SELECT COUNT(*) AS total FROM certificates WHERE email='$email'";
$certificate_result = mysqli_query($conn, $certificate_query);
$certificate_data = mysqli_fetch_assoc($certificate_result);
$total_certificates = $certificate_data['total'];

/* Count Achievements */
$achievement_query = "SELECT COUNT(*) AS total FROM achievements WHERE email='$email'";
$achievement_result = mysqli_query($conn, $achievement_query);
$achievement_data = mysqli_fetch_assoc($achievement_result);
$total_achievements = $achievement_data['total'];
/* Count Education */

$education_query = "SELECT COUNT(*) AS total FROM education WHERE email='$email'";

$education_result = mysqli_query($conn, $education_query);

$education_data = mysqli_fetch_assoc($education_result);

$total_education = $education_data['total'];?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard | SkillFolio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background:#f5f7fb;
        }

        .navbar{
            background:#0d6efd;
        }

        .navbar-brand,
        .nav-link{
            color:white !important;
        }

        .welcome-box{
            background:white;
            padding:30px;
            border-radius:10px;
            margin-top:30px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        .card{
            border:none;
            border-radius:10px;
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .icon{
            font-size:40px;
            color:#0d6efd;
        }
        .stats-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .stat-card h3 {
        font-size: 30px;
        margin: 0;
    }

    .stat-card p {
        margin-top: 5px;
        margin-bottom: 0;
        font-size: 16px;
    }

    </style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="#">SkillFolio</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link" href="../logout.php">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</li>

</ul>

</div>

</nav>

<!-- Main -->

<div class="container">

<div class="welcome-box">

<h2>

Welcome 👋

</h2>

<p>

Logged in as

<b>

<?php echo $_SESSION['email']; ?>

</b>

</p>

</div>
<div class="stats-container">

    <div class="stat-card">
        <h3><?php echo $total_skills; ?></h3>
        <p>Skills</p>
    </div>
    <div class="stat-card">

    <h3><?php echo $total_education; ?></h3>

    <p>Education</p>

</div>

    <div class="stat-card">
        <h3><?php echo $total_projects; ?></h3>
        <p>Projects</p>
    </div>

    <div class="stat-card">
        <h3><?php echo $total_certificates; ?></h3>
        <p>Certificates</p>
    </div>

    <div class="stat-card">
        <h3><?php echo $total_achievements; ?></h3>
        <p>Achievements</p>
    </div>

</div>

<div class="row mt-4">

<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-person-circle icon"></i>

<h5 class="mt-3">My Profile</h5>

<p>View and update your profile.</p>

<a href="profile.php" class="btn btn-primary">
    Open
</a>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-lightbulb icon"></i>

<h5 class="mt-3">Skills</h5>

<p>Add your technical skills.</p>

<a href="skills.php" class="btn btn-primary">
    Open
</a>

</div>

</div>
<div class="col-md-4 mb-4">

    <div class="card p-4 text-center shadow-sm">

        <i class="bi bi-mortarboard icon"></i>

        <h5 class="mt-3">Education</h5>

        <p>Manage your education details.</p>

        <a href="education.php" class="btn btn-primary">

            Open

        </a>

    </div>

</div>

<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-folder icon"></i>

<h5 class="mt-3">Projects</h5>

<p>Manage your projects.</p>

<a href="projects.php" class="btn btn-primary">
    Open
</a>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-award icon"></i>

<h5 class="mt-3">Certificates</h5>

<p>Upload certificates.</p>

<a href="certificates.php" class="btn btn-primary">
    Open
</a>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-trophy icon"></i>

<h5 class="mt-3">Achievements</h5>

<p>Add your achievements.</p>

<a href="achievements.php" class="btn btn-primary">
    Open
</a>

</div>

</div>
<div class="col-md-4 mb-4">
    <div class="card p-4 text-center shadow-sm">
        <i class="bi bi-person-badge icon"></i>

        <h5 class="mt-3">My Portfolio</h5>

        <p>View your complete portfolio.</p>

        <a href="portfolio.php" class="btn btn-primary">View Portfolio</a>
    </div>
</div>
<div class="col-md-4 mb-4">

<div class="card p-4 text-center shadow-sm">

<i class="bi bi-box-arrow-right icon"></i>

<h5 class="mt-3">Logout</h5>

<p>Logout from your account.</p>

<a href="../logout.php" class="btn btn-danger">

Logout

</a>

</div>

</div>

</div>

</div>

</body>

</html>