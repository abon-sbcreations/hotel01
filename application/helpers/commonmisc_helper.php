<?php

function timeSlotOptions() {
    $h = 0;
    $m = 0;
    $count = 1;
    $list = "<option value=\"00:00\">00:00 hrs</option>";
    for ($i = 0; $i < 24 * 4 - 1; $i++) {
        $count++;   //15 min difference
        if ($count % 4 == 1) {
            $m = 15;
        }
        if ($count % 2 == 0) {
            $m = 30;
        }
        if ($count % 4 == 3) {
            $m = 45;
        }
        if ($count % 4 == 0) {
            $m = "00";
            $h++;
        }
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
        "1*" => "1 star", "2*" => "2 star",
        "3*" => "3 star", "4*" => "4 star",
        "5*" => "5 star", "6*" => "6 star",
        "7*" => "7 star"];
    foreach ($types as $key => $typ) {
        $list .= "<option value=\"{$key}\">{$typ}</option>";
    }
    return $list;
}

function roomTypeOptions() {
    $list = "<option value=\"\">Choose...</option>";
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->from("tbl_room_master");
    $ci->db->select("room_master_id,room_type");
    $query = $ci->db->get();
    $result = $query->result_array();
    $rooms = [];
    if (!empty($result)) {
        foreach ($result as $key => $typ) {
            $rooms[$typ['room_master_id']] = $typ['room_type'];
        }
    }
    return $rooms;
}

function hotelOptions() {
    $list = "<option value=\"\">Choose...</option>";
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->from("tbl_hotel_master");
    $ci->db->select("hotel_id,hotel_name");
    $query = $ci->db->get();
    $result = $query->result_array();
    $hotels = [];
    if (!empty($result)) {
        foreach ($result as $key => $htl) {
            $hotels[$htl['hotel_id']] = $htl['hotel_name'];
        }
    }
    return $hotels;
}

function amenityOptions() {
    $list = "<option value=\"\">Choose...</option>";
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->from("tbl_amenities_master");
    $ci->db->select("amenity_id,amenity_name");
    $query = $ci->db->get();
    $result = $query->result_array();
    $amenities = [];
    if (!empty($result)) {
        foreach ($result as $key => $amt) {
            $amenities[$amt['amenity_id']] = $amt['amenity_name'];
        }
    }
    return $amenities;
}

function roomItemCategories() {
    $types = [
        "c1" => "category 1", "c2" => "category 2",
        "c3" => "category 3"];
    $itemCategory['category'] = $types;
    $types = ['c1' => [
            "c11" => "sub cat 11", "c12" => "sub cat 12",
            "c13" => "sub cat 13", "c14" => "sub cat 14"
        ], 'c2' => [
            "c21" => "sub cat 21", "c22" => "sub cat 22",
            "c23" => "sub cat 23", "c24" => "sub cat 24"
        ], 'c3' => [
            "c31" => "sub cat 31", "c32" => "sub cat 32",
            "c33" => "sub cat 13", "c34" => "sub cat 34"
        ]
    ];
    $itemCategory['sub_category'] = $types;
    return $itemCategory;
}
