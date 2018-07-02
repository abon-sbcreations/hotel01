<?php
function checkTableUnique($arr){
     $ci = & get_instance();
     $ci->load->database();     $ci->db->from($arr['table']);     $ci->db->select(" * ");     
     if($arr['primaryVal'] == 0){
         $ci->db->where([$arr['attr'] => $arr['attrVal']]);     
     }else{
         $ci->db->where([$arr['primary_id'] => $arr['primaryVal'],$arr['attr'] => $arr['attrVal']]);     
     }     
     $count = $ci->db->count_all_results();
     if($arr['primaryVal'] == 0 && $count == 0){
         return 0;
     }else if($arr['primaryVal'] != 0 && $count == 1){
         return 0;
     }else{
         return 1;
     }
}

