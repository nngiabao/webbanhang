<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Trang quản trị
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-latest.js"></script>

</head>

<body class="">
  <div class="wrapper ">
    <?php
    //menu trai
    include('menuleft.php');
    ?>
    <div class="main-panel">
      <!--noidung -->
      <div class="content" >
        <div class="container-fluid">
          <!--load o day -->
          <div id="noidung"></div>
        </div>
      </div>
      <!--footer -->
      <?php
      //include("foot.php");
      ?>
    </div>
</div>
  <?php
  include ('js.php');
  ?>
</body>

</html>