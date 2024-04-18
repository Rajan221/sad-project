<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login'] == 1) {
    header('Location: login.php');
}
$id = $_SESSION['user_id'];

include('db/connect.php');
$query = "SELECT b.*, r.* FROM bookings b
          JOIN room r ON b.room_id = r.room_id
          WHERE b.user_id = $id";

$result = mysqli_query($conn, $query);


$userquery = "SELECT fullName FROM users WHERE user_id = $id";
$userresult = mysqli_query($conn, $userquery);
if ($userresult) {
    $userrow = mysqli_fetch_assoc($userresult);
    $fullName = $userrow['fullName'];
} else {
    
    $fullName = "Guest"; 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Guest Panel</title>
    <style>
        .cont{
            margin-left: 10px;
        }

      .bookings {
        background-color: #777;
        color: white;
        width: 20vw;
        margin-top: 10px;
      }
    </style>
  </head>

  <body>
    <?php include('include/nav.php') ?>
    
    <a href="rooms.php"
      >Welcome Guest!
      <?php echo $fullName; ?></a
    >
    
    <h1>Your Bookings:</h1>

    <div class="cont">
      <?php
    if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) { ?>
      <div class="bookings">
        <?php
                echo "<p>Booking ID: " . $row["booking_id"] . "<br />"; echo
        "Book Date: " . $row["book_date"] . "<br />"; echo "Status: " .
        $row["status"] . "<br />"; echo "Room ID: " . $row["room_id"] . "<br />";
        echo "Room Title: " . $row["room_title"] . "<br />"; echo "Room No: " .
        $row["room_no"] . "<br />"; echo "Description: " . $row["description"] .
        "<br />"; ?>

        <form action="./db/cancel_booking.php" method="POST" class="cancel-btn">
          <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
          <button type="submit" class="btn btn-danger">Cancel Booking</button>
        </form>
      </div>
      <?php    
        }
    } else {
        echo "No bookings found.";
    }
    ?>
    </div>

    <?php include('include/message.php') ?>
  </body>
</html>
