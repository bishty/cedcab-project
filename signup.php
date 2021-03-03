<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
  <?php include_once 'header.php' ?>
  <form method="post" id="formid">
    <h1>SIGN-UP</h1>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="username">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
  
      
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Phone</label>
        <input type="number" class="form-control" id="phone" name="phone" placeholder="phone">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">profile Pic</label>
        <input type="file" class="form-control" id="file" name="file">
      </div>
    </div>

    <button type="submit" id="submit" class="btn btn-primary">Sign in</button>

  </form>
</body>
<?php include_once 'footer.php' ?>
<script>
  $(document).ready(function() {
    $('#formid').on('submit', function(e) {
      e.preventDefault();

      var formddatas = new FormData(document.getElementById("formid"));


      formddatas.append('file', $('input[type=file]')[0].files[0]);
      formddatas.append('action', 'Signup');


      if ($("#username").val() != "") {
        $.ajax({
          type: 'POST',
          url: 'helper.php',
          dataType: 'JSON',
          contentType: false,
          processData: false,
          data: formddatas,
          success: function(data) {
            window.open("login.php");
          }
        });
      } else {
        alert("please fill all the fields");
      }
    });

  });

  $(document).ready(function() {
    $("#email").change(function() {
      var email = $("#email").val();
      var password = $("#password").val();
      $.ajax({
        type: 'post',
        url: 'helper.php',
        action: 'emailcheck',
        data: {
          email: email,
          password: password,
          action: 'emailcheck'
        },
        success: function(data) {
       
          if (data == 1) {
            alert("alredy exist");
          } else if (data == 0) {
            alert("continue your process");
          }
        },
        error: function(data) {
          alert(data);
        }
      });
    });

  });
 
 
</script>


</html>