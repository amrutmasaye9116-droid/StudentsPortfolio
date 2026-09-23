<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

?>

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