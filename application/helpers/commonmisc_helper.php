<?php
function timeSlotOptions() {
    $h = 0;    $m = 0;    $count = 1;
    $list = "<option value=\"00:00\">00:00 hrs</option>";
    for ($i = 0; $i < 24 * 4 - 1; $i++) {
        $count++;   //15 min difference
        if ($count % 4 == 1) {            $m = 15;        }
        if ($count % 2 == 0) {            $m = 30;        }
        if ($count % 4 == 3) {            $m = 45;        }
        if ($count % 4 == 0) {            $m = "00";            $h++;        }
        if ($h != 24) {
            $time = str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . $m;
            $list .= "<option value=\"{$time}\">{$time} hrs</option>";
        }
    }
    return $list;
}
function hotelTypeSlotOptions() {
    $list = "<option value=\"\">Choose...</option>";
    $types = [
        "1*"=>"1 star",        "2*"=>"2 star",
        "3*"=>"3 star",        "4*"=>"4 star",
        "5*"=>"5 star",        "6*"=>"6 star",
        "7*"=>"7 star"];
    foreach ($types as $key=>$typ){
        $list .= "<option value=\"{$key}\">{$typ}</option>";
    }
    return $list;
}

function roomTypeOptions() {
    $list = "<option value=\"\">Choose...</option>";
    $types = [
        "none"=>"none AC",        "ac"=>"AC",
        "delux"=>"Delux",        "corporate"=>"Corporate"];
    foreach ($types as $key=>$typ){
        $list .= "<option value=\"{$key}\">{$typ}</option>";
    }
    return $list;
}