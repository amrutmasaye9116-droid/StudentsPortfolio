
<?php

if (getenv("DB_HOST")) {

    // Online database - Render + Aiven
    $host = getenv("DB_HOST");
    $user = getenv("DB_USER");
    $password = getenv("DB_PASSWORD");
    $database = getenv("DB_NAME");
    $port = (int)getenv("DB_PORT");

    $conn = mysqli_init();
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

    if (!mysqli_real_connect(
        $conn,
        $host,
        $user,
        $password,
        $database,
        $port,
        NULL,
        MYSQLI_CLIENT_SSL
    )) {
        die("Online Database Connection Failed");
    }

} else {

    // Local database - XAMPP
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "skillfolio_db";

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Local Database Connection Failed: " . $conn->connect_error);
    }
}

?>
