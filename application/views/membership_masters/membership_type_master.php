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
        <title>Membership Types</title>
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
                    <div class="h1">Membership Type<button onclick="addMembership()" class="btn btn-warning">Add Membership Type</button></div>
                    <table id="membership_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hotel Name</th>
                                <th>Membership Card</th>
                                <th>Membership Card Value</th>
                                <th>Membership Validity</th>
                                <th>Membership Amenities</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="membershipDetails" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="membershipDetailEdit" id="membershipDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_id">Hotel Name</label>
                                    <input type="hidden" name="membership_id" id="membership_id" value="0" class="form-control">
                                    <select class="custom-select d-block w-100" id="hotel_id" name="hotel_id"></select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="membership_card">Membership Card</label>
                                    <input type="text" name="membership_card" id="membership_card" class="form-control">
                                </div>
                                <div class="form-group col-md-2 mb-2">
                                    <label for="membership_card_value">Card Value</label>
                                    <input type="text" name="membership_card_value" id="membership_card_value" class="form-control">
                                </div>
                                <div class="form-group col-md-2 mb-2">
                                    <label for="membership_validity">Card Validity</label>
                                    <input type="text" name="membership_validity" id="membership_validity" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="form-group col-md-4">
                                    <label for="membership_amenity">Card Facilities</label>
                                    <div id="membershipAmenity"></div>
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
                        var dataTableMembership = "<?= site_url("index.php/membership_masters/ajaxAllMembershipDataTable") ?>";
                        var membershipDetails = $("#membershipDetails");
                        var hotelList;var amenityOptions;
                        $(document).ready(function () {
                            hotelList = "<?= addslashes(json_encode($hotelOptions))?>";
                            amenityOptions = "<?= addslashes(json_encode($amenityOptions))?>";
                            var table1 = $('#membership_list').DataTable({
                                "ajax": {
                                    url: dataTableMembership,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'hotel_name'},
                                    {mData: 'membership_card'},
                                    {mData: 'membership_card_value'},
                                    {mData: 'membership_validity'},
                                    {mData: 'membership_amenity'},
                                    {mData: "membership_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editMembership(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteMembership(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addMembership() {
                            $("#membershipDetails .modal-title").html("");
                            $("#membershipDetailEdit")[0].reset();
                            $("#membershipDetails .modal-title").html("");
                            $("#membershipDetailEdit input:not(#submitBtn)").val("");
                            $("#membershipDetailEdit option").removeAttr("selected");
                            popOptions(hotelList,"#hotel_id");
                            popAmenities();
                            membershipDetails.modal("show");
                        }
                        function editMembership(membership_id) {
                            console.log(membership_id);
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/membership_masters/ajaxMembershipDetails') ?>",
                                data: {membership_id: membership_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList,"#hotel_id",data['hotel_id']);
                                    $("input[name*='membership_id']").val(data['membership_id']);
                                    $("input[name*='membership_card']").val(data['membership_card']);
                                    $("input[name*='membership_card_value']").val(data['membership_card_value']);
                                    $("input[name*='membership_card_validity']").val(data['membership_card_validity']);
                                    popAmenities(data['membership_amenity']);
                                    membershipDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableMembership, null, function (json) {
                                table = $('#membership_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteMembership(membership_id) {
                            var r = confirm("You Sure to delete the Membership card?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/membership_masters/ajaxMembershipMasterDelete') ?>",
                                    data: {membership_id: membership_id},
                                    success: function (result) {
                                        membershipDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                membershipDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#membershipDetailEdit").submit();
                        });
                        $("#membershipDetailEdit").submit(function (e) {
                            var common_alert = "";
                           // var comp_name = $.trim($("input[name*='hotel_id']").val());
                           // var comp_name = $.trim($("input[name*='hotel_room_type']").val());
                           // var comp_id = $.trim($("input[name*='hotel_room_rent']").val());
                           // if (comp_name == '') {
                           //     common_alert = '\n Please enter Company name';
                          //  }
                          //  if ($.trim(common_alert) != '') {
                           //     alert(common_alert);
                           //     $("#roomTypeDetailEdit")[0].reset();
                           //     companyDetails.modal("hide");
                            //} else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/membership_masters/ajaxMembershipMasterSubmit') ?>",
                                    data: $("#membershipDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#membershipDetailEdit")[0].reset();
                                        membershipDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                           // }
                            e.preventDefault();
                        });
                         function popOptions(options,dom_id,sel_id=""){
                            var optionsList = $.parseJSON(options);
                            var option = "<option value=\"\">Choose...</option>";
                            $.each(optionsList,function(key,row){
                                var select = sel_id==key ? "selected='selected'" : "";
                               option = option + "<option "+select+" value=\""+key+"\">"+row+"</option>"; 
                            });
                            $(dom_id).html(option);
                        }
                        function popAmenities(membershipAmenities = ""){
                            $("#membershipAmenity").html("");
                            var amenitiesList = $.parseJSON(amenityOptions);
                            var amenitiyArr = membershipAmenities.split(",");
                            $.each(amenitiesList,function(id,name){
                                var check = jQuery.inArray(id, amenitiyArr) !== -1 ? "checked='checked'":"";
                                $("#membershipAmenity").append("<span><input "+check+" type=\"checkbox\" name=\"amenity["+id+"]\" value=\"1\" >"+name+"</span><br/>");
                            });
                        }
        </script>
    </body>
</html>