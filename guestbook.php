<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);



$name = mysqli_real_escape_string($conn, $_POST["namn"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$comment = mysqli_real_escape_string($conn, $_POST["comment"]);
$sql = "INSERT INTO guestbook (name, email, comment) VALUES (?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "error: ";
} else {
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $comment);
    mysqli_stmt_execute($stmt);
}

header("Location: homepage.html");

$sql = "SELECT * FROM guestbook";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<br> Namn: " . $row["name"] . " - email: " . $row["email"] . "Tid " . $row["time"] . "comment " . $row["comment"] . "<br>";
    }
} else {
    echo "0 results";
}
