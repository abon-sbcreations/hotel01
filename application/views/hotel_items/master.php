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
                width:60%;
            }
        </style>
    </head>
    <body>
        <?= $head02Temp ?>
        <div class="container-fluid">
            <div class="row">
                <?= $leftmenu02Temp ?>
                <div class="col-md-10 col-lg-offset-2">
                    <div class="h3"><span>Hotel's Item Master List</span><span class="addbttn"><button onclick="addHotelItem()" class="btn btn-info">Add Room Item</button></span></div>
                    <table id="roomItem_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hotel</th>   
                                <th>Item Name</th> 
                                <th>Category</th> 
                                <th>Sub - Category</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="hotelItemDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Hotel's Item Master List</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelItemEdit" id="hotelItemEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_id">Hotel</label>
                                    <input type="hidden" name="item_id" id="item_id" value="0" class="form-control">
                                    <select id="hotel_id" name="hotel_id"></select>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label for="item_name">Item Name</label>
                                    <select id="item_name" name="item_name"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-3">
                                    <label for="item_cat">Item Category:</label>
                                    <select id="item_cat" name="item_cat"></select>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label for="item_subcat">Item Sub Category:</label>
                                    <select id="item_subcat" name="item_subcat"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <input id="submitBtn" type="button" class="btn btn-info" value="submit" >
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="<?= site_url("library/js/jquery.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= site_url("library/js/datatables.min.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
                        var dataItemTable = "<?= site_url("index.php/hotel_items/ajaxAllHotelItemMasterDataTable") ?>";
                        var hotelItemDetails = $("#hotelItemDetails");
                        var itemCategory;
                        var itemSubCategory;
                        $(document).ready(function () {
                            itemCategory = "<?= addslashes(json_encode($itemCategory['category'])) ?>";
                            itemSubCategory = "<?= addslashes(json_encode($itemCategory['sub_category'])) ?>";
                            var table1 = $('#hotelItem_list').DataTable({
                                "ajax": {
                                    url: dataItemTable,
                                    type: 'GET'
                                },
                                "oLanguage": {
                                    "sEmptyTable": "My Custom Message On Empty Table"
                                },
                                "aoColumns": [
                                    {mData: 'hotel_name'},
                                    {mData: 'item_name'},
                                    {mData: 'item_cat'},
                                    {mData: 'item_subcat'},
                                    {mData: "item_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editHotelItem(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteHotelItem(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addHotelItem() {
                            $("#roomItemEdit input:not(#submitBtn)").val("");
                            $("#roomItemEdit option").removeAttr("selected");
                            $("#roomItemEdit")[0].reset();
                            popCategory();
                            popSubCategory();
                            roomItemDetails.modal("show");
                        }
                        function editHotelItem(room_item_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/room_items/ajaxRoomItemMasterDetails') ?>",
                                data: {room_item_id: room_item_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='room_item_name']").val(data['room_item_name']);
                                    $("input[name*='room_item_id']").val(data['room_item_id']);
                                    popCategory(data['room_item_cat']);
                                    popSubCategory(data['room_item_cat'], data['room_item_subcat']);
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
                        function deleteHotelItem(room_item_id) {
                            var r = confirm("You Sure to delete the Room Type?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/room_items/ajaxRoomItemMasterDelete') ?>",
                                    data: {room_item_id: room_item_id},
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
                        function popCategory(id = "") {
                            var category = $.parseJSON(itemCategory);
                            var option = "<option value=\"\">Choose...</option>";
                            $.each(category, function (key, row) {
                                var select = id == key ? "selected='selected'" : "";
                                option = option + "<option " + select + " value=\"" + key + "\">" + row + "</option>";
                            });
                            $("#room_item_cat").html(option);
                        }
                        function popSubCategory(id = "", opt = "") {
                            var subCategory = $.parseJSON(itemSubCategory);
                            var option = "<option value=\"\">Choose...</option>";
                            if (id !== "") {
                                $.each(subCategory[id], function (key, row) {
                                    var select = opt == key ? "selected='selected'" : "";
                                    option = option + "<option " + select + " value=\"" + key + "\">" + row + "</option>";
                                });
                            }
                            $("#room_item_subcat").html(option);
                        }
                        $("#room_item_cat").on("change", function () {
                            var valueSelected = this.value;
                            popSubCategory(valueSelected);
                        });
        </script>
    </body>
</html>