<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login'] == 1) {
    header('Location: login.php');
    exit();
}

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    // Perform the cancellation logic (e.g., delete the booking record)
    $cancel_query = "DELETE FROM bookings WHERE booking_id = $booking_id";
    $cancel_result = mysqli_query($conn, $cancel_query);

    if ($cancel_result) {
        $msg = "Booking canceled successfully.";
        header('Location: ../home.php?msg=' . $msg);
        exit();
    } else {
        $msg = "Failed to cancel booking. Please try again.";
        header('Location: ../home.php?msg=' . $msg);
        exit();
    }
} else {
    header('Location: ../home.php');
    exit();
}
?>
