<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login'] == 1) {
    header('Location: login.php');
}
$id = $_SESSION['user_id'];

include('db/connect.php');

// Fetch rooms
$query = "SELECT * FROM room ORDER BY room_id DESC";
$result = mysqli_query($conn, $query);

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

    <style>
      body {
        overflow-x: hidden;
      }
      .outer {
        display: grid;
        grid-template-columns: auto auto;
        gap: 30px;

        justify-content: center;
      }

      .card {
        box-shadow: 0 20px 50px -15px black;
        width: 45vw;
      }
    </style>
    <title>Guest Panel</title>
  </head>

  <body>
    <?php include('include/nav.php')  ?>
    <div class="outer">
      <?php while ($post = mysqli_fetch_assoc($result)) {
        $room_id = $post['room_id'];

        // Fetch booking status for the current room
        $status_query = "SELECT status FROM bookings WHERE room_id = $room_id";
        $status_result = mysqli_query($conn, $status_query);
        $booking_status = mysqli_fetch_assoc($status_result);

    ?>

      <div>
        <div
          style="background-color: #444; margin-top: 30px; color: white"
          class="card"
        >
          <div>
            Status:
            <?php echo ($booking_status) ? $booking_status['status'] : 'Available'; ?>
          </div>
          <img
            style="height: 400px"
            src="<?php echo './super/' . $post['image'] ?>"
            alt="image"
          />
          <div>
            <h3 style="background-color: black; color: white">
              <?php echo $post['room_title'] ?>
            </h3>
            <h6>
              Room No:
              <?php echo $post['room_no']; ?>
            </h6>
          </div>
          <div><?php echo $post['description'] ?></div>
          <div style="float: right">
            Price: Rs.<?php echo $post['price'] ?>
            /day
            <form action="booking.php" method="POST">
              <input
                type="hidden"
                name="room_id"
                value="<?php echo $post['room_id'] ?>"
              />
              <input
                type="hidden"
                name="room_no"
                value="<?php echo $post['room_no'] ?>"
              />

              <?php if ($booking_status && strcasecmp($booking_status['status'], "booked") == 0) { ?>
              <button class="btn btn-secondary" disabled>Booked</button>
              <?php } else { ?>
              <button class="btn btn-success">Book Now</button>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>

      <?php } ?>
    </div>
  </body>
</html>
