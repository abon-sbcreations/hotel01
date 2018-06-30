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
                    <div class="h1">Restaurants List<button onclick="addHotelbar()" class="btn btn-warning">Add Restaurant</button></div>
                    <table id="room_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Restaurant Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="hotelbarDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelbarDetailEdit" id="hotelbarsDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotelbar_name">Name</label>
                                    <input type="hidden" name="hotelbar_id" id="hotelbar_id" value="0" class="form-control">
                                    <input type="text" name="hotelbar_name" id="hotelbar_name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
                                    <label for="hotelbar_desc">Hotel Desc:</label>
                                    <textarea name="hotelbar_desc" class="form-control" rows="5" cols="" id="hotelbar_desc"></textarea>
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
                        var dataTableRoom = "<?= site_url("index.php/hotelbars/ajaxAllHotelbarMasterDataTable") ?>";
                        var hotelbarDetails = $("#hotelbarDetails");
                        $(document).ready(function () {
                            var table1 = $('#room_list').DataTable({
                                "ajax": {
                                    url : dataTableRoom,
                                    type : 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'restaurant_name'},
                                    {mData: "restaurant_id", bSortable: false, sWidth: "80px",
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
                            $("#hotelbarDetails") .modal-title").html("");
                            $("#hotelbarDetailEdit")[0].reset();
							 
                             hotelbarDetails.modal("show");
                        }
                     
					 function editHotelbar(hotelbar_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/hotelbars/ajaxHotelbarMasterDetails') ?>",
                                data: {hotelbar_id: hotelbar_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='hotel_id']").val(data['hotel_id']);
                                    $("#menu_session").html(data['menu_session']);
									 $("#menu_type").html(data['menu_type']);
									  $("#item_name").html(data['item_name']);
									   $("#item_img").html(data['item_img']);
									    $("#item_desc").html(data['item_desc']);
										  $("#item_price").html(data['item_price']);
										   $("#item_available").html(data['item_available']);
										   $("input[name*='menu_id']").val(data['menu_id']);
                                     hotelbarDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableRoom, null, function (json) {
                                table = $('#room_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteHotelbar(hotelbar_id) {
                            var r = confirm("You Sure to delete the Amenity?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotelbars/ajaxHotelbarMasterDelete') ?>",
                                    data: { hotelbar_id : hotelbar_id },
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
                        $("#hotelbarDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var hotel_id = $.trim($("input[name*='hotel_id']").val());
                            var menu_id = $.trim($("input[name*='menu_id']").val());
                            if (hotel_id == '') {
                                common_alert = '\n Please enter amenity name';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#hotelbarDetailEdit")[0].reset();
                                 hotelbarDetails.modmal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotelbars/ajaxHotelbarMasterSubmit') ?>",
                                    data: $("#hotelbarDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#hotelbarDetailEdit")[0].reset();
                                        hotelbarDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>







