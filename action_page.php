<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "car_rental";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if(!$conn){
        die("Connection failed");
    }

    $name = $_POST["fname"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $address = $_POST["addr"];
    $phone = $_POST["phno"];
    $pass = $_POST["psw"];
    $l_ID = $_POST["dl_id"];

    $sql = "INSERT INTO customer (l_id, Full_name, DOB, Addr, Email, Ph_No, Passkey)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $l_ID,
        $name,
        $dob,
        $address,
        $email,
        $phone,
        $pass
    );

    mysqli_stmt_execute($stmt);

    echo "<h2>User successfully registered, Please go back and sign-in</h2>";

?>
