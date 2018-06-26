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
        <title>Restaurant's Master List</title>
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
                    <div class="h1">Restaurants Menu List<button onclick="addRestaurant()" class="btn btn-warning">Add Food Item</button></div>
                    <table id="restaurant_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Session</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Available</th>
                                <th>Hotel</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="restaurantDetails" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="restaurantDetailEdit" id="restaurantDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_id">Hotel Name</label>
                                    <input type="hidden" name="menu_id" id="menu_id" value="0" class="form-control">
                                    <!--span id="htlnamemsg"></span-->
                                    <select class="custom-select d-block w-100" id="hotel_id" name="hotel_id"></select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="item_name">Name</label>

                                    <input type="text" name="item_name" id="item_name" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="item_price">Price</label>
                                    <input type="text" name="item_price" id="item_price" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="menu_session">Session</label>
                                    <select class="custom-select d-block w-100" id="menu_session" name="menu_session"></select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="menu_type">Type</label>
                                    <select class="custom-select d-block w-100" id="menu_type" name="menu_type"></select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="item_available">Available</label>
                                    <select class="custom-select d-block w-100" id="item_available" name="item_available"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
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
                        var dataTableRestaurant = "<?= site_url("index.php/restaurants/ajaxAllRestaurantMasterDataTable") ?>";
                        var restaurantDetails = $("#restaurantDetails");
                        var hotelList;
                        var sessionList;
                        var typeList;
                        var isAvailable;
                        $(document).ready(function () {
                            hotelList = "<?= addslashes(json_encode($hotelOptions)) ?>";
                            sessionList = "<?= addslashes(json_encode($sessionOption)) ?>";
                            typeList = "<?= addslashes(json_encode($menuTypeOption)) ?>";
                            isAvailable = "<?= addslashes(json_encode($availableOption)) ?>";
                            var table1 = $('#restaurant_list').DataTable({
                                "ajax": {
                                    url: dataTableRestaurant,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'item_name'},
                                    {mData: 'menu_session'},
                                    {mData: 'menu_type'},
                                    {mData: 'item_price'},
                                    {mData: 'item_available'},
                                    {mData: 'hotel_name'},
                                    {mData: "menu_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editRestaurant(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteRestaurant(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addRestaurant() {
                            $("#restaurantDetailEdit")[0].reset();
                            $("#restaurantDetailEdit input:not(#submitBtn)").val("");
                            $("#restaurantDetailEdit textarea").html("");
                            popOptions(hotelList, "#hotel_id");
                            popOptions(sessionList, "#menu_session");
                            popOptions(typeList, "#menu_type");
                            popOptions(typeList, "#menu_type");
                            popOptions(isAvailable, "#item_available");                            
                            restaurantDetails.modal("show");
                        }
                        function editRestaurant(menu_id) {
                            console.log(menu_id);
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/restaurants/ajaxRestaurantMasterDetails') ?>",
                                data: {menu_id: menu_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList, "#hotel_id", data['hotel_id']);
                                    popOptions(sessionList, "#menu_session", data['menu_session']);
                                    popOptions(typeList, "#menu_type", data['menu_type']);
                                    popOptions(isAvailable, "#item_available", data['item_available']);
                                    $("input[name*='menu_id']").val(data['menu_id']);
                                    $("input[name*='item_name']").val(data['item_name']);
                                    $("input[name*='item_price']").val(data['item_price']);
                                    $("#item_desc").html(data['item_desc']);
                                    restaurantDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableRestaurant, null, function (json) {
                                table = $('#restaurant_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteRestaurant(menu_id) {
                            var r = confirm("You Sure to delete the Menu Item ?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/restaurants/ajaxRestaurantMasterDelete') ?>",
                                    data: {menu_id: menu_id},
                                    success: function (result) {
                                        restaurantDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                restaurantDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            //if($('#item_name').val()==""){
                            //     $('#htlnamemsg').html("Please Enter Hotel Name");
                            // }else{
                            $("#restaurantDetailEdit").submit();
                            //  } 
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
                        $("#restaurantDetailEdit").submit(function (e) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/restaurants/ajaxRestaurantMasterSubmit') ?>",
                                data: $("#restaurantDetailEdit").serialize(),
                                success: function (result) {
                                    $("#restaurantDetailEdit")[0].reset();
                                    restaurantDetails.modal("hide");
                                    refreshTable();
                                }
                            });
                            e.preventDefault();
                        });
        </script>
    </body>
</html>







