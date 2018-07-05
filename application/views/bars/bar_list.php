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
        <title>Bar's Master List</title>
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
 <?=$head02Temp?>
        <div class="container-fluid">
            <div class="row">
                 <?=$leftmenu02Temp?>
                <div class="col-md-10 col-lg-offset-2">
                    <div class="h3"><span>Bar Menu List</span><span class="addbttn"><button onclick="addHotelbar()" class="btn btn-info">Add Bar Item</button></span></div>
                    <table id="hotelbar_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>                                 
                                <th>Price</th>
                                <th>Available</th>
                                 <th>Actions</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="hotelbarDetails" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Bar Menu List</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelbarDetailEdit" id="hotelbarDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-6 mb-6">
                                    <label for="hotel_id">Hotel Name</label>
                                    <input type="hidden" name="menu_id" id="menu_id" value="0" class="form-control">
                                     <input type="hidden" name="menu_cat" id="menu_cat" value="10" class="form-control">
                                    <!--span id="htlnamemsg"></span-->
                                    <select class="custom-select d-block w-100 form-control" id="hotel_id" name="hotel_id"></select>
                                    <label for="item_name">Name</label>
                                    <input type="text" name="item_name" id="item_name" class="form-control">
                                </div>
                                
                                <div class="form-group col-md-6 mb-6">
                                    <label for="item_price">Price</label>
                                    <input type="text" name="item_price" id="item_price" class="form-control">
                                    
                                    <label for="item_available">Available</label>
                                    <select class="custom-select d-block w-100 form-control" id="item_available" name="item_available"></select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group  col-md-12">
                                    <label for="item_desc">Item Description:</label>
                                    <textarea name="item_desc" class="form-control" rows="5" cols="" id="item_desc"></textarea>
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
                        var dataTableHotelbar = "<?= site_url("index.php/bars/ajaxAllBarMasterDataTable") ?>";
                        var hotelbarDetails = $("#hotelbarDetails");
                        var hotelList; var typeList; var isAvailable;
                        $(document).ready(function () {
                            hotelList = "<?= addslashes(json_encode($hotelOptions)) ?>";
                            typeList = "<?= addslashes(json_encode($menuTypeOption)) ?>";
                            isAvailable = "<?= addslashes(json_encode($availableOption)) ?>";
                            var table1 = $('#hotelbar_list').DataTable({
                                "ajax": {
                                    url: dataTableHotelbar,
                                    type: 'GET'
                                },
                                "oLanguage": {
                                    "sEmptyTable": "My Custom Message On Empty Table"
                                },
                                "aoColumns": [
                                    {mData: 'item_name'},                              {mData: 'menu_type'},
                                   {mData: 'item_price'},                              {mData: 'item_available'},
                                    {mData: 'hotel_name'},
                                     {mData: "menu_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editHotelbar(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteHotelbar(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addHotelbar() {
                            $("#hotelbarDetailEdit")[0].reset();
                            $("#hotelbarDetailEdit input:not(#submitBtn)").val("");
                            $("#hotelbarDetailEdit textarea").html("");
                            $("input[name*='menu_cat']").val(1000);
                            popOptions(hotelList, "#hotel_id");
                             
                             popOptions(typeList, "#menu_type");
                            popOptions(isAvailable, "#item_available"); 
                         
                            hotelbarDetails.modal("show");
                        }
                        function editHotelbar(menu_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/bars/ajaxHotelbarMasterDetails') ?>",
                                data: {menu_id: menu_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList, "#hotel_id", data['hotel_id']); 
                                    popOptions(typeList, "#menu_type", data['menu_type']);
                                    popOptions(isAvailable, "#item_available", data['item_available']);
                                    $("input[name*='menu_id']").val(data['menu_id']);
                                    $("input[name*='item_name']").val(data['item_name']);
                                    $("input[name*='item_price']").val(data['item_price']);
                                    $("#item_desc").html(data['item_desc']);
                                    hotelbarDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableHotelbar, null, function (json) {
                                table = $('#hotelbar_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteHotelbar(menu_id) {
                            var r = confirm("You Sure to delete the Menu Item ?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/bars/ajaxHotelbarMasterDelete') ?>",
                                    data: {menu_id: menu_id},
                                    success: function (result) {
                                        hotelbarDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                hotelbarDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#hotelbarDetailEdit").submit();
                        });
                        function popOptions(options, dom_id, sel_id = "") {
                            var optionsList = $.parseJSON(options);
                            var option = "<option value=\"\">Choose...</option>";
                            $.each(optionsList, function (key, row) {
                                var select = sel_id == key ? "selected='selected'" : "";
                                option = option + "<option " + select + " value=\"" + key + "\">" + row + "</option>";
                            });
                            $(dom_id).html(option);
                        }
                        $("#hotelbarDetailEdit").submit(function (e) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/bars/ajaxHotelbarMasterSubmit') ?>",
                                data: $("#hotelbarDetailEdit").serialize(),
                                success: function (result) {
                                    $("#hotelbarDetailEdit")[0].reset();
                                    hotelbarDetails.modal("hide");
                                    refreshTable();
                                }
                            });
                            e.preventDefault();
                        });
        </script>
    </body>
</html>













