<?php
/**
 * Created by PhpStorm.
 * User: HarDToBelieve
 * Date: 10/26/2017
 * Time: 4:15 PM
 */
    $query = 'SELECT link, img FROM foods';
    $result = $db->query($query);

    $menu = array();
    if ( $result->num_rows > 0 ) {
        while($row = $result->fetch_assoc()) {
            array_push($menu, $row);
        }
    }

    echo '<div class="row">' . PHP_EOL;
    foreach ($menu as $food) {
        echo '<div class="thumbnail" style="margin:0px auto;">' . PHP_EOL;
        echo '<img src="' . $food['img'] . '" width="150px" class="img-thumbnail" alt="'. $food['link'] .'" onclick="getFood(this)">' . PHP_EOL;
        echo '</div>' . PHP_EOL;
    }
    echo '</div>' . PHP_EOL;