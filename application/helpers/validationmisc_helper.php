<?php
function checkTableUnique($arr){
     $ci = & get_instance();
     $ci->load->database();     $ci->db->from($arr['table']);     $ci->db->select(" * ");     
     //$arr['primaryVal']
     $ci->db->where([$arr['attr'] => $arr['attrVal']]);         
     $count = $ci->db->count_all_results();      
     if($count==0){
         return 0;
     }else{
         $ci->load->database();     $ci->db->from($arr['table']);     $ci->db->select(" * ");    
         $ci->db->where([$arr['attr'] => $arr['attrVal']]);
         $qry = $ci->db->get();      $res = $qry->result();
         if($res[0]->hotel_id == $arr['primaryVal']){
             return 0;
         }else{
             return 1;
         }
     } 
}