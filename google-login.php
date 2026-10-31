<?php

session_start();

include("database/connection.php");

if(isset($_POST['credential']))
{
    $credential = $_POST['credential'];

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($credential);

    $response = file_get_contents($url);

    if($response != false)
    {
        $google_data = json_decode($response, true);

        // Enter your Google Client ID here
        $client_id = "595703860451-3ilstjt5fusa4l8mcjukt71fuh1ugksv.apps.googleusercontent.com";

        if(
            isset($google_data['email']) &&
            isset($google_data['aud']) &&
            $google_data['aud'] == $client_id &&
            $google_data['email_verified'] == "true"
        )
        {
            $email = $google_data['email'];

            $query = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0)
            {
                $_SESSION['email'] = $email;

                header("Location: students/dashboard.php");
                exit();
            }
            else
            {
                echo "<script>
                    alert('Please register first using this Gmail account.');
                    window.location='register.php';
                </script>";
            }
        }
        else
        {
            echo "Google verification failed.";
        }
    }
    else
    {
        echo "Unable to verify Google account.";
    }
}

?>