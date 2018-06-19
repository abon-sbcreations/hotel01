<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?= site_url("library/images/hotel-flat-icon-vector.jpg") ?>">
        <title>Room's Master List</title>
        <link href="<?= site_url("library/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/datatables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("assets/css/custom02.css") ?>" rel="stylesheet">

        <style>
            #modalDialog{
                width:90%;
            }
            body{
                background-color:#ccc;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Hotel Software</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= site_url('index.php/Dashboards/admin_area') ?>">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="<?= site_url('index.php/admins/logout') ?>">(<?= $loggedDisplay ?>)</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11">
                    <div class="h1">Room's Item Master List<button onclick="addRoomItem()" class="btn btn-warning">Add Room Item</button></div>
                    <table id="roomItem_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Room Item</th>   
                                 <th>Room Category</th> 
                                 <th>Room Sub - Category</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="roomItemDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="roomItemEdit" id="roomItemEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="room_item_name">Name</label>
                                    <input type="hidden" name="room_item_id" id="room_item_id" value="0" class="form-control">
                                    <input type="text" name="room_item_name" id="room_item_name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-3">
                                    <label for="room_item_cat">Room Item Category:</label>
                                    <select id="room_item_cat" name="room_item_cat"></select>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label for="room_item_cat">Item Sub Category:</label>
                                    <select id="room_item_subcat" name="room_item_subcat"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <input id="submitBtn" type="button" class="btn btn-info" value="submit" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= site_url("library/js/jquery.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/datatables.min.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
                        var dataItemTable = "<?= site_url("index.php/room_items/ajaxAllRoomItemMasterDataTable") ?>";
                        var roomItemDetails = $("#roomItemDetails");
                       // var itemCategory;   var itemSubCategory;
                        $(document).ready(function () {                           
                             itemCategory = "<?= addslashes(json_encode($itemCategory['category']))?>";
                             itemSubCategory = "<?= addslashes(json_encode($itemCategory['sub_category']))?>";
                            var table1 = $('#roomItem_list').DataTable({
                                "ajax": {
                                    url : dataItemTable,
                                    type : 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'room_item_name'},
                                    {mData: 'room_item_cat'},
                                    {mData: 'room_item_subcat'},
                                    {mData: "room_item_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editRoomItem(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteRoomItem(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addRoomItem() {
                            $("#roomItemDetails .modal-title").html("");
                            $("#roomItemEdit")[0].reset();
                            popCategory();
                            popSubCategory();
                            roomItemDetails.modal("show");
                        }
                        function editRoomItem(room_item_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/room_items/ajaxRoomItemMasterDetails') ?>",
                                data: {room_item_id: room_item_id},
                                success: function (result) {
                                    var data = $.parseJSON(result); 
                                    $("input[name*='room_item_name']").val(data['room_item_name']);
                                    popCategory(data['room_item_cat']);
                                    popSubCategory(data['room_item_cat'],data['room_item_subcat']);
                                    roomItemDetails.modal("show");
                                    
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataItemTable, null, function (json) {
                                table = $("#roomItem_list").dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteRoomItem (room_item_id) {
                            var r = confirm("You Sure to delete the Room Type?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/room_items/ajaxRoomItemMasterDelete') ?>",
                                    data: { room_item_id : room_item_id },
                                    success: function (result) {
                                        roomItemDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                roomItemDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#roomItemEdit").submit();
                        });
                        $("#roomItemEdit").submit(function (e) {
                            var common_alert = "";
                            var item_name = $.trim($("input[name*='room_item_name']").val());
                           if (item_name == '') {
                                common_alert = '\n Please enter item name';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#roomDetailEdit")[0].reset();
                                roomItemDetails.modal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/room_items/ajaxRoomItemsMasterSubmit') ?>",
                                    data: $("#roomItemEdit").serialize(),
                                    success: function (result) {
                                        $("#roomItemEdit")[0].reset();
                                        roomItemDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
                        function popCategory(id=""){
                            var category = $.parseJSON(itemCategory);
                            var option = "<option value=\"\">Choose...</option>";
                            $.each(category,function(key,row){
                                var select = id==key ? "selected='selected'" : "";
                               option = option + "<option "+select+" value=\""+key+"\">"+row+"</option>"; 
                            });
                            $("#room_item_cat").html(option);
                        }
                        function popSubCategory(id = "",opt=""){
                            var subCategory = $.parseJSON(itemSubCategory);
                            var option = "<option value=\"\">Choose...</option>";
                            if(id !== ""){                                
                                $.each(subCategory[id],function(key,row){
                                   var select = opt==key ? "selected='selected'" : "";
                                   option = option + "<option "+select+" value=\""+key+"\">"+row+"</option>"; 
                                });                                
                            }
                            $("#room_item_subcat").html(option);
                        }
                        $("#room_item_cat").on("change",function(){
                             var valueSelected = this.value;
                             popSubCategory(valueSelected);
                        });
        </script>
    </body>
</html>