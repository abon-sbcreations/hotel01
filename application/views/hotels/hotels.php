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
        <title>Hotels List</title>
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
                    <div class="h1">Hotels List<button onclick="addHotel()" class="btn btn-warning">Add Hotel</button></div>
                    <table id="hotels_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hotel Name</th>
                                <th>Type</th>
                                <th>Reg. Number</th>
                                <th>Has Restourant</th>
                                <th>Has Bar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="hotelDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">

                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelDetailEdit" id="hotelDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_name">Name</label>
                                    <input type="hidden" name="hotel_id" id="hotel_id" value="0" class="form-control">
                                    <input type="text" name="hotel_name" id="hotel_name" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_reg_number">Reg. No</label>
                                    <input type="text" name="hotel_reg_number" id="hotel_reg_number" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_gst_number">GST No</label>
                                    <input type="text" name="hotel_gst_number" id="hotel_gst_number" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_type">Hotel Type</label>
                                    <select class="custom-select d-block w-100" id="hotel_type" name="hotel_type">
                                        <?= $hotelTypeSlotOptions ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_check_in_time">Check-in Time</label>
                                    <select class="custom-select d-block w-100" id="hotel_check_in_time" name="hotel_check_in_time">
                                        <?= $timeSlotOptions ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_type">Check-out Time</label>
                                    <select class="custom-select d-block w-100" id="hotel_check_out_time" name="hotel_check_out_time">
                                        <?= $timeSlotOptions ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_has_resturant">Resturant</label>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input id="yesResturant" name="hotel_has_restaurant" value="Y" type="radio" class="custom-control-input" checked="">
                                            <label class="custom-control-label" for="yesResturant">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="noResturant" name="hotel_has_restaurant" value="N" type="radio" class="custom-control-input" >
                                            <label class="custom-control-label" for="noResturant">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_has_bar">Bar</label>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input id="yesBar" name="hotel_has_bar" value="Y" type="radio" class="custom-control-input" checked="" >
                                            <label class="custom-control-label" for="yesBar">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="noBar" name="hotel_has_bar" value="N" type="radio" class="custom-control-input" >
                                            <label class="custom-control-label" for="noBar">No</label>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
                                    <label for="hotel_address">Hotel Address:</label>
                                    <textarea name="hotel_address" class="form-control" rows="5" cols="" id="hotel_address"></textarea>
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
                        var dataTableHotel = "<?= site_url("index.php/hotels/ajaxAllHotelsDataTable") ?>";
                        var hotelDetails = $("#hotelDetails");
                        $(document).ready(function () {
                            var table1 = $('#hotels_list').DataTable({
                                "ajax": {
                                    url: dataTableHotel,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'hotel_name'},
                                    {mData: 'hotel_type'},
                                    {mData: 'hotel_reg_number'},
                                    {mData: 'hotel_has_restaurant', sWidth: "40px"},
                                    {mData: 'hotel_has_bar', sWidth: "40px"},
                                    {mData: "hotel_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editHotel(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteHotel(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addHotel() {
                            $("#hotelDetails .modal-title").html("");
                            $("#hotelDetailEdit")[0].reset();
                            hotelDetails.modal("show");
                        }
                        function editHotel(hotel_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/hotels/ajaxHotelDetails') ?>",
                                data: {hotel_id: hotel_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("#hotelDetails .modal-title").html("<span>" + data['hotel_name'] + "</span>");
                                    $("input[name*='hotel_name']").val(data['hotel_name']);
                                    $("input[name*='hotel_id']").val(data['hotel_id']);
                                    $("input[name*='hotel_reg_number']").val(data['hotel_reg_number']);
                                    $("input[name*='hotel_gst_number']").val(data['hotel_gst_number']);
                                    $("select[name*='hotel_type'] option[value='" + data['hotel_type'] + "']").attr('selected', 'selected');
                                    $("select[name*='hotel_check_in_time'] option[value='" + data['hotel_check_in_time'] + "']").attr('selected', 'selected');
                                    $("select[name*='hotel_check_out_time'] option[value='" + data['hotel_check_out_time'] + "']").attr('selected', 'selected');
                                    var has_bar = data['hotel_has_bar'] === 'Y' ? 0 : 1;
                                    $("input:radio[name=hotel_has_bar]:nth(" + has_bar + ")").attr('checked', true);
                                    var has_resturant = data['hotel_has_restaurant'] === 'Y' ? 0 : 1;
                                    $("input:radio[name=hotel_has_restaurant]:nth(" + has_resturant + ")").attr('checked', true);
                                    $("#hotel_address").html(data['hotel_address']);
                                    hotelDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableHotel, null, function (json) {
                                table = $('#hotels_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteHotel(hotel_id) {
                            var r = confirm("You Sure to delete the Hotel?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotels/ajaxHotelDelete') ?>",
                                    data: {hotel_id: hotel_id},
                                    success: function (result) {
                                        hotelDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                hotelDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#hotelDetailEdit").submit();
                        });
                        $("#hotelDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var hotel_name = $.trim($("input[name*='hotel_name']").val());
                            var reg_no = $.trim($("input[name*='hotel_reg_number']").val());
                            var gst_no = $.trim($("input[name*='hotel_gst_number']").val());
                            var hotel_id = $.trim($("input[name*='hotel_id']").val());
                            if (hotel_name == '') {
                                common_alert = '\n Please enter hotel_name';
                            }
                            if (reg_no == '' && gst_no == '') {
                                common_alert = common_alert + "\n enter proper gst no and registration number";
                            } else if (reg_no == '') {
                                common_alert = common_alert + "\n enter proper registration number";
                            } else if (gst_no == '') {
                                common_alert = common_alert + "\n enter proper registration number";
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotels/ajaxNoUnique') ?>",
                                    data: {hotel_id: hotel_id,
                                        hotel_reg_number: reg_no, hotel_gst_number: gst_no},
                                    success: function (result) {
                                        result = JSON.parse(result)
                                                ;
                                        if (result['regStatus'] == 0) {
                                            common_alert = common_alert + "\n Registration no is taken";
                                        }
                                        if (result['gstStatus'] == 0) {
                                            common_alert = common_alert + "\n GST No is taken";
                                        }
                                    }
                                });
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#hotelDetailEdit")[0].reset();
                                hotelDetails.modal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotels/ajaxHotelSubmit') ?>",
                                    data: $("#hotelDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#hotelDetailEdit")[0].reset();
                                        hotelDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>



