<?php
$activeMenu = empty($activeMenu) ? "" : $activeMenu;
?>
<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="<?=$activeMenu=="hotel_rooms/master" ? "active":"" ?>"><a href="<?=site_url('index.php/hotel_rooms/master')?>">Hotel's Room Types</a></li>
            <li class="<?=$activeMenu=="hotel_items/master" ? "active":"" ?>"><a href="<?=site_url('index.php/hotel_items/master')?>">Hotel Items Master</a></li>
            <li class="<?=$activeMenu=="restaurants/restaurant_list" ? "active":"" ?>"><a href="<?=site_url('index.php/restaurants/restaurant_list')?>">Restaurant Master</a></li>
            <li class="<?=$activeMenu=="bars/bar_list" ? "active":"" ?>"><a href="<?=site_url('index.php/bars/bar_list')?>">Bar Master</a></li>
            <li class="<?=$activeMenu=="item_masters/master" ? "active":"" ?>"><a href="<?=site_url('index.php/item_masters/master')?>">Items Master</a></li>                    
            <li class="<?=$activeMenu=="customers" ? "active":"" ?>"><a href="<?=site_url('index.php/customers')?>">Customers</a></li>
            <li class="<?=$activeMenu=="membership_masters/master"?"active":"" ?>"><a href="<?=site_url('index.php/membership_masters/master')?>">Memberships</a></li>
          </ul>
          <ul class="nav nav-sidebar"></ul>
          <!--ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul-->
        </div>
