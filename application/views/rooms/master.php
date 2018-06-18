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
                    <div class="h1">Room's Master Type List<button onclick="addRoomType()" class="btn btn-warning">Add Room Type</button></div>
                    <table id="room_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Room Type</th>       
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="roomDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="roomDetailEdit" id="roomDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="room_type">Type</label>
                                    <input type="hidden" name="room_master_id" id="room_master_id" value="0" class="form-control">
                                    <input type="text" name="room_type" id="room_type" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
                                    <label for="room_type_Desc">Room Type Desc:</label>
                                    <textarea name="room_type_Desc" class="form-control" rows="5" cols="" id="room_type_Desc"></textarea>
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
                        var dataTableRoom = "<?= site_url("index.php/rooms/ajaxAllRoomMasterDataTable") ?>";
                        var roomDetails = $("#hotelDetails");
                        $(document).ready(function () {
                            var table1 = $('#room_list').DataTable({
                                "ajax": {
                                    url : dataTableRoom,
                                    type : 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'room_type'},
                                    {mData: "room_master_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editRoom(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteRoom(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addRoomType() {
                            $("#hotelDetails .modal-title").html("");
                            $("#roomDetailEdit")[0].reset();
                            roomDetails.modal("show");
                        }
                        function editRoom(room_master_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/rooms/ajaxRoomMasterDetails') ?>",
                                data: {room_master_id: room_master_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='room_type']").val(data['room_type']);
                                    $("input[name*='room_type_Desc']").val(data['room_type_Desc']);
                                    roomDetails.modal("show");
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
                        function deleteHotel(hotel_id) {
                            var r = confirm("You Sure to delete the Room Type?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotels/ajaxRoomDelete') ?>",
                                    data: { room_master_id : room_master_id },
                                    success: function (result) {
                                        roomDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                roomDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#roomDetailEdit").submit();
                        });
                        $("#roomDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var room_type = $.trim($("input[name*='room_type']").val());
                            var room_master_id = $.trim($("input[name*='room_master_id']").val());
                            if (room_type == '') {
                                common_alert = '\n Please enter room type';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#roomDetailEdit")[0].reset();
                                roomDetails.modal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/rooms/ajaxRoomSubmit') ?>",
                                    data: $("#roomDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#roomDetailEdit")[0].reset();
                                        roomDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>



