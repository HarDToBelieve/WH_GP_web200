<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 21/10/17
 * Time: 16:13
 */
    $query = 'SELECT link, img FROM foods';
    $result = $db->query($query);

    $menu = array();
    if ( $result->num_rows > 0 ) {
        while($row = $result->fetch_assoc()) {
            array_push($menu, $row);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Material Design Bootstrap</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="bootstrap/css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <style>
            body {
                background-image: url('images/maxresdefault_live.jpg');
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
    </head>

    <body>

    <!-- Start your project here-->
    <div class="container" style="padding-top: 4%">
        <div class="row" style="margin: 0 auto">
            <!--Panel-->
            <div class="card" style="width: 50%; margin: 0 auto">
                <div class="card-header deep-orange lighten-1 white-text">
                    Profile
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $_SESSION['username']; ?></h4>
                    <p class="card-text">Nickname: <?php echo $_SESSION['nickname']; ?></p>
                    <p class="card-text">Role: <?php echo $_SESSION['role']; ?></p>
                    <p class="card-text">Suffix key: <?php echo $_SESSION['suffix']; ?></p>
                </div>
            </div>
            <!--/.Panel-->
        </div>
        <br>
        <!--Panel-->
        <div class="card">
            <div class="card-header deep-orange lighten-1 white-text">
                Foods
            </div>
            <div id="food-content" class="card-body">
                <?php
                    foreach ($menu as $food) {
                        echo '<img src="' . $food['img'] . '" width="150px" class="img-thumbnail" alt="'. $food['link'] .'" onclick="getFood(this)">';
                    }
                ?>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <script type="text/javascript">
        function getFood(image) {
            var food_link = image.alt;
            $.get("foods.php", { "page" : food_link }, function (data) {
                document.getElementById("food-content").innerHTML = data;
            });
        }
    </script>
    <!-- JQuery -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="bootstrap/js/mdb.min.js"></script>
    </body>

</html>
