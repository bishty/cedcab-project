<?php
session_start();
if (isset($_SESSION['user']['email'])) {
  header('location:user/dashboard.php');
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <?php include_once 'header.php' ?>
    <h1>LOGIN</h1>
    <form mehod="post">
      <p id="alert"></p>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
      </div>

      <button type="submit" id="submit" class="btn btn-primary">LOGIN </button>
    </form>
    <?php include_once 'footer.php' ?>
    <script>
      $(document).ready(function() {
        $("#submit").click(function(e) {
          e.preventDefault();
          var email_id = $('#email').val();
          var password = $("#password").val();
          $.ajax({
            type: "post",
            url: 'helper.php',
            data: {
              email_id: email_id,
              action: 'logincheck',
              password: password,
            },
            success: function(data) {
              console.log(data);
              if (data == 1) {
                alert("welcome to user dashboard");
                location.replace("user/dashboard.php");
              } else if (data == 0) {
                $("#alert").html("Invalid");
                $("#email").val("");
                $("#password").val("");
              }
              
              else if(data==2)
              {
                alert("HII ADMIN WHATSUP")
                location.replace("admin/dashboard.php");
              }
              else 
              {
                alert("you are blocked");
              }

            }

          });
        });

      });
    </script>


  </body>

<?php }
?>

  </html>