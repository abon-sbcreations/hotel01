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
        <title>Hotel Room Types</title>
        <link href="<?= site_url("library/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/datatables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/bootstrap-datepicker3.min.css") ?>" rel="stylesheet" type="text/css"/>
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
                    <div class="h1">Hotel Admin's <button onclick="addHotelAdmins()" class="btn btn-warning">Add Hotel Admin</button></div>
                    <table id="hotelAdmin_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hotel Name<br>&nbsp;</th>
                                <th>User Name<br>&nbsp;</th>
                                <th>Activation Date<br>&nbsp;</th>
                                <th>Package Duration<br>(Months)</th>
                                <th>Actions<br>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="hotelAdminPasswords" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelAdminPasswordForm" id="hotelAdminPasswordForm" >
                            <div class="row">
                                <div class="form-group col-md-3 mb-1">
                                    <label for="oldHotel_passwd">Old Password</label>
                                    <input type="text" name="oldHotel_passwd" id="oldHotel_passwd" class="form-control">
                                </div> 

                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 mb-1">
                                    <label for="hotel_passwd">New Password</label>
                                    <input type="hidden" name="hotel_admin_id" id="passHotel_admin_id" value="0" class="form-control">
                                    <input type="text" name="hotel_passwd" id="hotel_passwd" class="form-control">
                                </div>
                                <div class="form-group col-md-3 mb-1">
                                    <label for="rehotel_passwd">Confirm Password</label>
                                    <input type="text" name="rehotel_passwd" id="rehotel_passwd" class="form-control">
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 mb-1">
                                    <input id="submitPassBtn" type="button" class="btn btn-info" value="submit" >
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="hotelAdminDetails" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="hotelAdminEdit" id="hotelAdminEdit" >
                            <div class="row">
                                <div class="form-group col-md-3 mb-2">
                                    <label for="hotel_id">Hotel</label>
                                    <input type="hidden" name="hotel_admin_id" id="hotel_admin_id" value="0" class="form-control">
                                    <br><select class="custom-select d-block w-100" id="hotel_id" name="hotel_id"></select>
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label for="hotel_userid">User Id</label>
                                    <input type="text" name="hotel_userid" id="hotel_userid" class="form-control">
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label for="hotel_admin_status">Status</label>
                                    <br><select class="custom-select d-block w-100" id="hotel_admin_status" name="hotel_admin_status"></select>
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label for="is_rent_paid">Rent Paid</label>
                                    <br><select class="custom-select d-block w-100" id="is_rent_paid" name="is_rent_paid"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_access_duration">Access Duration</label>
                                    <input type="text" name="hotel_access_duration" id="hotel_access_duration" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_access_activation">Activation Date</label>
                                    <input type="text" name="hotel_access_activation" id="hotel_access_activation" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_access_rent">Rent Amount</label>
                                    <input type="text" name="hotel_access_rent" id="hotel_access_rent" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-6">
                                    <label for="hotel_module_permission">Module Permission</label>                                   
                                    <table id="modulePermission" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>view</th>
                                                <th>add</th>
                                                <th>edit</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
        <script src="<?= site_url("library/js/bootstrap-datepicker.min.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
                        var dataTableHotelAdmin = "<?= site_url("index.php/hotel_admins/ajaxAllHotelAdminDataTable") ?>";
                        var hotelAdminDetails = $("#hotelAdminDetails");
                        var hotelList;          var moduleList;                 var isActive;
                        var yesNo;
                        $(document).ready(function () {
                            isActive = "<?= addslashes(json_encode($isActive)) ?>";
                            hotelList = "<?= addslashes(json_encode($hotelOptions)) ?>";
                            moduleList = "<?= addslashes(json_encode($moduleOptions)) ?>";
                            yesNo = "<?= addslashes(json_encode($yesNo)) ?>";
                            var table1 = $('#hotelAdmin_list').DataTable({
                                "ajax": {
                                    url: dataTableHotelAdmin,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'hotel_name'},
                                    {mData: 'hotel_userid'},
                                    {mData: 'hotel_access_activation'},
                                    {mData: 'hotel_access_duration'},
                                    {mData: "hotel_admin_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var changeBtn = "<button class=\"btn btn-primary btn-xs\" onclick=\"changePassword(" + data + ")\">Change Password</button>";
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editHotelAdmin(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteHotelAdmin(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn + "<br><br>" + changeBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addHotelAdmins() {
                            $("#hotelAdminDetails .modal-title").html("");
                            $("#hotelAdminEdit input:not(#submitBtn)").val("");
                            $("#hotelAdminEdit textarea").html("");
                            $("#hotelAdminEdit")[0].reset();
                            popOptions(hotelList, "#hotel_id");
                            popOptions(isActive, "#hotel_admin_status");
                            popOptions(yesNo, "#is_rent_paid");
                            popModulePermissions();
                            hotelAdminDetails.modal("show");
                        }
                        function editHotelAdmin(hotel_admin_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/hotel_admins/ajaxHotelAdminDetails') ?>",
                                data: {hotel_admin_id: hotel_admin_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList, "#hotel_id", data['hotel_id']);
                                    popOptions(isActive, "#hotel_admin_status", data['hotel_admin_status']);
                                    popOptions(yesNo, "#is_rent_paid", data['is_rent_paid']);
                                    $("input[name*='hotel_admin_id']").val(data['hotel_admin_id']);
                                    $("input[name*='hotel_userid']").val(data['hotel_userid']);
                                    $("input[name*='hotel_access_duration']").val(data['hotel_access_duration']);
                                    $("input[name*='hotel_access_activation']").val(data['hotel_access_activation']);
                                    $("input[name*='hotel_access_rent']").val(data['hotel_access_rent']);
                                    popModulePermissions(data['hotel_module_permission']);
                                    hotelAdminDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableHotelAdmin, null, function (json) {
                                table = $('#hotelAdmin_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteHotelAdmin(hotel_admin_id) {
                            var r = confirm("You Sure to delete the Hotel admin?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/hotel_admins/ajaxHotelAdminDelete') ?>",
                                    data: {hotel_admin_id: hotel_admin_id},
                                    success: function (result) {
                                        hotelAdminDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                hotelAdminDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#hotelAdminEdit").submit();
                        });
                        $("#hotelAdminEdit").submit(function (e) {
                            var common_alert = "";
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/hotel_admins/ajaxHotelAdminSubmit') ?>",
                                data: $("#hotelAdminEdit").serialize(),
                                success: function (result) {
                                    $("#hotelAdminEdit")[0].reset();
                                    hotelAdminDetails.modal("hide");
                                    refreshTable();
                                }
                            });
                            e.preventDefault();
                        });
                        function changePassword(hotel_admin_id) {
                            $("#passHotel_admin_id").val(hotel_admin_id);
                            $("#hotelAdminPasswords").modal("show");
                            
                        }                        
                        $("#submitPassBtn").on("click", function () { 
                            $("#hotelAdminPasswordForm").submit();
                        });
                        $("#hotelAdminPasswordForm").submit(function (e) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/hotel_admins/ajaxHotelAdminPasswordsSubmit') ?>",
                                data: $("#hotelAdminPasswordForm").serialize(),
                                success: function (result) {
                                    console.log(result);
                                    var data = $.parseJSON(result);
                                    console.log(result);
                                    if(data['status'] < 0){
                                          alert(data['message']);
                                    }
                                    $("#hotelAdminPasswordForm")[0].reset();
                                    $("#hotelAdminPasswords").modal("hide");
                                    refreshTable();
                                }
                            });
                            e.preventDefault();
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
                        function popModulePermissions(modulePermissons = "") {
                            var modList = $.parseJSON(moduleList);
                            var modPermissions;
                            if (modulePermissons.length > 0) {
                                modPermissions = $.parseJSON(modulePermissons);
                            }
                            $("#modulePermission > tbody").html("");
                            $.each(modList, function (id, name) {
                                var viewCheck = "";
                                var addCheck = "";
                                var editCheck = "";
                                var delCheck = "";
                                $.each(modPermissions, function (mid, mod) {
                                    if (mid == id) {
                                        $.each(mod, function (k1, permission) {
                                            if (permission == "view") {
                                                viewCheck = "checked='checked'";
                                            }
                                            if (permission == "add") {
                                                addCheck = "checked='checked'";
                                            }
                                            if (permission == "edit") {
                                                editCheck = "checked='checked'";
                                            }
                                            if (permission == "delete") {
                                                delCheck = "checked='checked'";
                                            }
                                        });
                                    }
                                });
                                $("#modulePermission > tbody").append("<tr><td>" + name + "</td><td>"
                                        + "<input " + viewCheck + " type=\"checkbox\" name=\"module[" + id + "][0]\" value=\"1\"></td>"
                                        + "<td><input " + addCheck + " type=\"checkbox\" name=\"module[" + id + "][1]\" value=\"1\"></td>"
                                        + "<td><input " + editCheck + " type=\"checkbox\" name=\"module[" + id + "][2]\" value=\"1\"></td>"
                                        + "<td><input " + delCheck + " type=\"checkbox\" name=\"module[" + id + "][3]\" value=\"1\"></td>"
                                        + "</tr>");
                            });
                        }
                        $("#hotel_access_activation").datepicker({
                            format: "dd-mm-yyyy",
                            weekStart: 1,
                            daysOfWeekHighlighted: "0,6",
                            autoclose: true
                        });
        </script>
    </body>
</html>