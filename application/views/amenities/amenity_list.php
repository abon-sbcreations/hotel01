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
                    <div class="h1">Amenities List<button onclick="addAmenity()" class="btn btn-warning">Add Amenity</button></div>
                    <table id="room_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Amenity Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="amenityDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="amenityDetailEdit" id="amenityDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="amenity_name">Name</label>
                                    <input type="hidden" name="amenity_id" id="amenity_id" value="0" class="form-control">
                                    <input type="text" name="amenity_name" id="amenity_name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
                                    <label for="amenity_desc">Amenity Desc:</label>
                                    <textarea name="amenity_desc" class="form-control" rows="5" cols="" id="amenity_desc"></textarea>
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
                        var dataTableRoom = "<?= site_url("index.php/amenities/ajaxAllAmenitiesMasterDataTable") ?>";
                        var amenityDetails = $("#amenityDetails");
                        $(document).ready(function () {
                            var table1 = $('#room_list').DataTable({
                                "ajax": {
                                    url : dataTableRoom,
                                    type : 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'amenity_name'},
                                    {mData: "amenity_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editAmenity(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteAmenity(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addAmenity() {
                            $("#amenityDetails .modal-title").html("");
                            $("#amenityDetailEdit input:not(#submitBtn)").val("");
                            $("#amenityDetailEdit textarea").html("");
                            $("#amenityDetailEdit")[0].reset();
                            amenityDetails.modal("show");
                        }
                        function editAmenity(amenity_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/amenities/ajaxAmenityMasterDetails') ?>",
                                data: {amenity_id: amenity_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='amenity_name']").val(data['amenity_name']);
                                    $("#amenity_desc").html(data['amenity_desc']);
                                    $("input[name*='amenity_id']").val(data['amenity_id']);
                                    amenityDetails.modal("show");
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
                        function deleteAmenity(amenity_id) {
                            var r = confirm("You Sure to delete the Amenity?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/amenities/ajaxAmenityMasterDelete') ?>",
                                    data: { amenity_id : amenity_id },
                                    success: function (result) {
                                        amenityDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                amenityDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#amenityDetailEdit").submit();
                        });
                        $("#amenityDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var amenity_name = $.trim($("input[name*='amenity_name']").val());
                            var amenity_id = $.trim($("input[name*='amenity_id']").val());
                            if (amenity_name == '') {
                                common_alert = '\n Please enter amenity name';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#amenityDetailEdit")[0].reset();
                                amenityDetails.modal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/amenities/ajaxAmenityMasterSubmit') ?>",
                                    data: $("#amenityDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#amenityDetailEdit")[0].reset();
                                        amenityDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>