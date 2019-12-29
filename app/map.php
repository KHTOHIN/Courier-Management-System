<?php 

function findDistance($from, $to){
    $from = urlencode($from);
    $to = urlencode($to);
    $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
    $data = json_decode($data);
    $strDistance = explode(" ", $data->rows[0]->elements[0]->distance->text ) ;
    return (float) current($strDistance);
}