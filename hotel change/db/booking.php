<?php
include("connect.php");

if (isset($_POST['date']) && isset($_POST['status'])) {
    session_start();
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id'];
    $book_date = date('Y-m-d');
    $status = $_POST['status'];
    $checkin_date = $_POST['date'];

    $check_query = "SELECT u.fullName FROM bookings b JOIN users u ON b.user_id = u.user_id WHERE b.user_id = '$user_id' AND b.room_id = '$room_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $fullName = $row['fullName'];
        $msg = "Room already booked by user " . $fullName;
        header('Location:../home.php?msg=' . $msg);
        exit(); 
    }

    $query = "INSERT INTO bookings (user_id, book_date, status, checkin_date, room_id) VALUES ('$user_id','$book_date','$status','$checkin_date', '$room_id')";

    if (mysqli_query($conn, $query)) {
        $msg = "Room booked by user " . $user_id;
        header('Location:../home.php?msg=' . $msg);
        exit(); 
    } else {
        die("Error: " . mysqli_error($conn));
    }
} else {
    die("Data cannot be accessed");
    header('Location:../homes.php?msg=' . $msg);
}
?>
