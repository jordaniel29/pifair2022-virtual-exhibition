<?php

if (isset($_POST['vote_open'])){
    $data = file_get_contents('../json/vote-status.json');
    $array = json_decode($data, true);

    $array["vote_open"] = $_POST['vote_open'];
    file_put_contents('../json/vote-status.json', json_encode($array));
}