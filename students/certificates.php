<?php

session_start();

if(!isset($_SESSION['email']))
{
    header("Location: ../login.php");
    exit();
}

include("../database/connection.php");

$email = $_SESSION['email'];


// Add Certificate

if(isset($_POST['add_certificate']))
{
    $certificate_name = $_POST['certificate_name'];
    $organization = $_POST['organization'];

    $file_name = $_FILES['certificate_file']['name'];
    $file_tmp = $_FILES['certificate_file']['tmp_name'];

    $folder = "../uploads/certificates/";

    $new_file_name = time() . "_" . $file_name;

    move_uploaded_file($file_tmp, $folder . $new_file_name);


    $query = "INSERT INTO certificates
              (email, certificate_name, organization, certificate_file)
              VALUES
              ('$email', '$certificate_name', '$organization', '$new_file_name')";

    mysqli_query($conn, $query);
}


// Delete Certificate

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $query = "SELECT certificate_file FROM certificates
              WHERE id='$id' AND email='$email'";

    $result = mysqli_query($conn, $query);

    $certificate = mysqli_fetch_assoc($result);

    if($certificate)
    {
        $file = "../uploads/certificates/" . $certificate['certificate_file'];

        if(file_exists($file))
        {
            unlink($file);
        }
    }

    $query = "DELETE FROM certificates
              WHERE id='$id' AND email='$email'";

    mysqli_query($conn, $query);
}


// Show Certificates

$query = "SELECT * FROM certificates WHERE email='$email'";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Certificates | SkillFolio</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

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

        .certificate
        {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 15px;
            border-radius: 8px;
        }

    </style>

</head>

<body>

<div class="box">

    <h2 class="text-center">My Certificates</h2>

    <p class="text-center">
        Upload your certificates
    </p>

    <hr>


    <!-- Certificate Form -->

    <form method="POST" enctype="multipart/form-data">

        <label>Certificate Name</label>

        <input type="text"
               name="certificate_name"
               class="form-control mb-3"
               placeholder="Enter certificate name"
               required>


        <label>Organization</label>

        <input type="text"
               name="organization"
               class="form-control mb-3"
               placeholder="Enter organization name"
               required>


        <label>Certificate File</label>

        <input type="file"
               name="certificate_file"
               class="form-control mb-3"
               accept=".pdf,.jpg,.jpeg,.png"
               required>


        <button type="submit"
                name="add_certificate"
                class="btn btn-primary">

            Upload Certificate

        </button>

    </form>


    <hr>

    <h4>My Certificates</h4>


    <?php

    if(mysqli_num_rows($result) > 0)
    {

        while($certificate = mysqli_fetch_assoc($result))
        {

    ?>

        <div class="certificate">

            <h5>
                <?php echo $certificate['certificate_name']; ?>
            </h5>

            <p>
                Organization:
                <?php echo $certificate['organization']; ?>
            </p>


            <a href="../uploads/certificates/<?php echo $certificate['certificate_file']; ?>"
               target="_blank"
               class="btn btn-primary btn-sm">

                View Certificate

            </a>


            <a href="certificates.php?delete=<?php echo $certificate['id']; ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure you want to delete this certificate?');">

                Delete

            </a>

        </div>

    <?php

        }

    }
    else
    {

        echo "<p>No certificates added yet.</p>";

    }

    ?>


    <br>

    <a href="dashboard.php"
       class="btn btn-secondary">

        Back to Dashboard

    </a>

</div>

</body>

</html>