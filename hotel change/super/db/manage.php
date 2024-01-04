<?php
    session_start();
    $user_id= $_SESSION['user_id'];

    $room_id = $_POST['room_id'];
    $query = "DELETE FROM room WHERE room_id = '$room_id'";

    include('connect.php');
    if (mysqli_query($conn, $query)) {
        $msg = "Room Deleted";
        header('Location:../home.php?msg='.$msg);
    }
    else {
        $msg = "Some error occured :".mysqli_error($conn);
        header('Location:../home.php?msg='.$msg);
    }

?>