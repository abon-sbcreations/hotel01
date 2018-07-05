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
        <title>Customers</title>
        <link href="<?= site_url("library/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/datatables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/bootstrap-datepicker3.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("assets/css/custom02.css") ?>" rel="stylesheet">

        <style>
            #modalDialog{
                width:50%;
            }
        </style>
    </head>
    <body>
        <?= $head02Temp ?>
        <div class="container-fluid">
            <div class="row">
                <?= $leftmenu02Temp ?>
                <div class="col-md-10 col-lg-offset-2">
                    <div class="h3"><span>Customers</span><span class="addbttn"><button onclick="addCustomer()" class="btn btn-info">Add Customer</button></span></div>
                    <table id="customer_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hotel</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="customerDetails" class="modal fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Customers</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="customerDetailEdit" id="customerDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-6 mb-6">
                                    <label for="cust_name">Name</label>
                                    <input type="hidden" name="cust_id" id="cust_id" value="0" class="form-control">
                                    <input type="text" name="cust_name" id="cust_name" class="form-control">
                                    <span id='cust_nameError'></span>
                                    <label for="cust_phone">Phone</label>
                                    <input type="text" name="cust_phone" id="cust_phone" class="form-control">
                                    <span id='cust_phoneError'></span>
                                    <label for="cust_email">Email</label>
                                    <input type="text" name="cust_email" id="cust_email" class="form-control">                                    
                                    <label for="cust_status">Status</label>
                                    <select class="custom-select d-block w-100 form-control" id="cust_status" name="cust_status"></select>
                                    <label class='memberCond' for="membership_type">Membership</label>                                    
                                    <select class="custom-select d-block w-100 form-control memberCond" id="membership_type" name="membership_type"></select>
                                    <label class='memberCond' for="membership_num">Mem. Number</label>
                                    <input type="text" name="membership_num" id="membership_num" class="form-control memberCond">
                                    <label class='memberCond' for="membership_issue_date">Mem. Issue Date</label>
                                    <input type="text" name="membership_issue_date" id="membership_issue_date" class="form-control memberCond">
                                </div>
                                <div class="form-group col-md-6 mb-6">
                                    <label for="pan_card">Pan Card</label><input type="text" name="pan_card_value" id="pan_card_value" class="form-control">
                                    <label for="electoral_card">Electoral Card</label><input type="text" name="electoral_card_value" id="electoral_card_value" class="form-control">
                                    <label for="aadhar_card">Aadhar Card</label><input type="text" name="aadhar_card_value" id="aadhar_card_value" class="form-control">
                                    <label for="driving_lic">Driving License</label><input type="text" name="driving_lic_value" id="driving_lic_value" class="form-control">
                                    <label for="passport">Passport</label><input type="text" name="passport_value" id="passport_value" class="form-control">
                                    <label id='errorDocument' ></label>
                                </div><!--checked="checked"-->

                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="cust_address">Address</label>
                                    <textarea name="cust_address" class="form-control" rows="5" cols="" id="cust_address"></textarea>
                                    <span id='cust_addressError'></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-6">
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
        <script src="<?= site_url("library/js/bootstrap-datepicker.min.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
                        var dataTableCustomer = "<?= site_url("index.php/customers/ajaxAllCustomersMasterDataTable") ?>";
                        var customerDetails = $("#customerDetails");
                        var hotelList;
                        var custStatus;
                        var membershipType;
                        $(document).ready(function () {
                            hotelList = "<?= addslashes(json_encode($hotelOptions)) ?>";
                            membershipType = "<?= addslashes(json_encode($membershipOptions)) ?>";
                            custStatus = "<?= addslashes(json_encode(['Guest' => 'Guest', 'Member' => 'Member'])) ?>";
                            var table1 = $('#customer_list').DataTable({
                                "ajax": {
                                    url: dataTableCustomer,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'cust_name'},
                                    {mData: 'hotel_name'},
                                    {mData: 'cust_status'},
                                    {mData: "cust_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editCustomer(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteCustomer(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
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
                        function addCustomer() {
                            $("#customerDetailEdit")[0].reset();
                            $("#customerDetailEdit option").removeAttr("selected");
                            $("#customerDetailEdit input:not(#submitBtn)").val("");
                            $("#customerDetailEdit textarea").html("");
                            $(".memberCond").hide();
                            popOptions(custStatus, "#cust_status");
                            $("#cust_status").val("Guest");
                            $("#cust_status").attr("disabled", "disabled");
                            hotelToMembership();
                            customerDetails.modal("show");
                        }
                        function editCustomer(customer_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/customers/ajaxCustomerMasterDetails') ?>",
                                data: {cust_id: customer_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList, "#hotel_id", data['hotel_id']);
                                    popOptions(custStatus, "#cust_status", data['cust_status']);
                                    $("input[name*='cust_name']").val(data['cust_name']);
                                    $("input[name*='cust_email']").val(data['cust_email']);
                                    $("input[name*='cust_phone']").val(data['cust_phone']);
                                    $("input[name*='cust_id']").val(data['cust_id']);
                                    $("input[name*='membership_issue_date']").val(data['membership_issue_date']);
                                    $("input[name*='membership_num']").val(data['membership_num']);
                                    $("#cust_address").html(data['cust_address']);
                                    $("input[name*='cust_id']").val(data['cust_id']);
                                    $("#cust_status").val(data['cust_status']);
                                    isMemberStatus($("#cust_status").val());
                                    hotelToMembership(data['hotel_id'], data['membership_type']);
                                    customerDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableCustomer, null, function (json) {
                                table = $('#customer_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteCustomer(customer_id) {
                            var r = confirm("You Sure to delete the Customer?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/Customers/ajaxCustomerMasterDelete') ?>",
                                    data: {cust_id: customer_id},
                                    success: function (result) {
                                        customerDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                customerDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            var flag = 0;
                            if(checkDocuments()===1){
                                flag++;
                            }
                            if($("input[name*='cust_name']").val().length < 1){
                                console.log($("input[name*='cust_name']").html());
                                flag++;
                                $("#cust_nameError").html("<span class='errorlabel'>Required</span><br>");
                            }else{
                                 $("#cust_nameError").html("");
                            }
                            if($("input[name*='cust_phone']").val().length < 1){
                                $("#cust_phoneError").html("<span class='errorlabel'>Required</span><br>");
                                flag++;
                            }else{
                                $("#cust_phoneError").html("");
                            }
                            /*if($("#cust_adddress").val().length < 1){
                                $("#cust_addressError").html("<span class='errorlabel'>Required</span>");
                                flag++;
                            }else{
                                $("#cust_addressError").html("");
                            }*/
                            if(flag==0){
                                $("#customerDetailEdit").submit();
                            }
                        });
                        
                        $("#customerDetailEdit").submit(function (e) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/customers/ajaxCustomersMasterSubmit') ?>",
                                data: $("#customerDetailEdit").serialize(),
                                success: function (result) {
                                    $("#customerDetailEdit")[0].reset();
                                    customerDetails.modal("hide");
                                    refreshTable();
                                }
                            });
                            e.preventDefault();
                        });
                        function hotelToMembership(id = "", opt = "") {
                            var hotelMembershipType = $.parseJSON(membershipType);
                            var option = "<option value=\"\">Choose...</option>";
                            if (id !== "" && $("#cust_status").val() == 'Member') {
                                $.each(hotelMembershipType[id], function (key, row) {
                                    var select = opt == key ? "selected='selected'" : "";
                                    option = option + "<option " + select + " value=\"" + key + "\">" + row + "</option>";
                                });
                            }
                            $("#membership_type").html(option);
                        }
                        function isMemberStatus(status, hotel_id = 0) {
                            if (status == "Guest") {
                                $("#membership_type").html(
                                        "<option value=\"\">Choose...</option>"
                                        + "<option value=\"0\" selected='selected'>None</option>");
                                $("#membership_num").val(0);
                                $("#membership_issue_date").val(0);
                                $("#memberBlock").hide();
                            } else {
                                $("#memberBlock").show();
                                hotelToMembership($("#hotel_id").val());
                        }
                        }
                        $("#cust_status").on("change", function () {
                            var valueSelected = this.value;
                            isMemberStatus(valueSelected);
                        });
                        $("#hotel_id").on("change", function () {
                            var valueSelected = this.value;
                            hotelToMembership(valueSelected);
                        });
                        $("#membership_issue_date").datepicker({
                            format: "dd-mm-yyyy",
                            weekStart: 1,
                            daysOfWeekHighlighted: "0,6",
                            autoclose: true
                        });
                        function checkDocuments(){
                            var  pan_card_value =  $.trim($("input[name*='pan_card_value']").val());
                            var  electoral_card_value =  $.trim($("input[name*='electoral_card_value']").val());
                            var  aadhar_card_value =  $.trim($("input[name*='aadhar_card_value']").val());
                            var  driving_lic_value =  $.trim($("input[name*='driving_lic_value']").val());
                            var  passport_value =  $.trim($("input[name*='passport_value']").val());
                            if(pan_card_value.length > 0 || electoral_card_value.length >0 
                            || aadhar_card_value.length > 0 || driving_lic_value.length > 0 
                            || passport_value.length > 0 ){
                                $("#errorDocument").html("");
                                return 1;
                            }else{
                                $("#errorDocument").html("<p class='errorlabel'>Atleast one document need to be provided</p>");
                                return 0;
                            }                            
                        }

        </script>
    </body>
</html>