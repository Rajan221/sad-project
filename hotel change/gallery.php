<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Guest Pannel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css " />

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

      h3 {
        text-align: center;
        margin-top: 30px;
        font-size: 40px;
        width: 100vw;
        font-weight: bold;
      }
      .divs {
        display: grid;
        grid-template-columns: auto auto;
        row-gap: 40px;
        column-gap: 10vw;
        justify-content: center;
      }

      .divs div img {
        box-shadow: 0 20px 50px -15px black;
        object-fit: cover;
        height: 50vh;
        width: 40vw;
      }
    </style>
  </head>
  <body>
    <?php include('include/nav.php') ?>

    <div>
      <h3>GALLERY</h3>

      <div class="divs">
        <div>
          <img src="img/a.jpg" height="250" />
        </div>
        <div>
          <img src="img/b.jpg" height="250" />
        </div>
        <div>
          <img src="img/c.jpg" height="250" />
        </div>
        <div>
          <img src="img/d.jpg" height="250" />
        </div>

        <div>
          <img src="img/e.jpg" height="250" />
        </div>
        <div>
          <img src="img/f.jpg" height="250" />
        </div>

        <div>
          <img src="img/g.jpg" height="250" />
        </div>
        <div>
          <img src="img/h.jpg" height="250" />
        </div>

        <div>
          <img src="img/j.jpg" height="250" />
        </div>
      </div>
    </div>
  </body>

  <script src="js/bootstrap.js"></script>
</html>
