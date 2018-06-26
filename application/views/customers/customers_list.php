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
        <title>Companies</title>
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
                    <div class="h1">Customers<button onclick="addCustomer()" class="btn btn-warning">Add Customer</button></div>
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
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="customerDetailEdit" id="customerDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="cust_name">Name</label>
                                    <input type="hidden" name="cust_id" id="cust_id" value="0" class="form-control">
                                    <input type="text" name="cust_name" id="cust_name" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="hotel_id">Hotel</label>
                                    <select class="custom-select d-block w-100" id="hotel_id" name="hotel_id"></select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="cust_status">Status</label>
                                    <select class="custom-select d-block w-100" id="cust_status" name="cust_status"></select>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="form-group col-md-4 mb-3">
                                    <label for="cust_phone">Phone</label>
                                    <input type="text" name="cust_phone" id="cust_phone" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="cust_email">Email</label>
                                    <input type="text" name="cust_email" id="cust_email" class="form-control">
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
                        var dataTableCustomer = "<?= site_url("index.php/customers/ajaxAllCustomersMasterDataTable") ?>";
                        var customerDetails = $("#customerDetails");
                        var hotelList;var custStatus;
                        $(document).ready(function () {
                            hotelList = "<?= addslashes(json_encode($hotelOptions))?>";
                            custStatus = "<?= addslashes(json_encode(['Guest'=>'guest','Member'=>'member']))?>";
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
                        function popOptions(options,dom_id,sel_id=""){
                            var optionsList = $.parseJSON(options);
                            var option = "<option value=\"\">Choose...</option>";
                            $.each(optionsList,function(key,row){
                                var select = sel_id==key ? "selected='selected'" : "";
                               option = option + "<option "+select+" value=\""+key+"\">"+row+"</option>"; 
                            });
                            $(dom_id).html(option);
                        }
                        function addCustomer() {
                            $("#customerDetails .modal-title").html("");
                            $("#customerDetailEdit")[0].reset();
                            popOptions(hotelList,"#hotel_id");
                            popOptions(custStatus,"#cust_status");
                            
                            customerDetails.modal("show");
                        }
                        function editCustomer(customer_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/customers/ajaxCustomerMasterDetails') ?>",
                                data: {cust_id: customer_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    popOptions(hotelList,"#hotel_id",data['hotel_id']);
                                     popOptions(custStatus,"#cust_status",data['cust_status']);
                                    $("input[name*='cust_name']").val(data['cust_name']);
                                    $("input[name*='cust_email']").val(data['cust_email']);
                                    $("input[name*='cust_phone']").val(data['cust_phone']);
                                    $("input[name*='cust_id']").val(data['cust_id']);
                                    $("input[name*='comp_reg_no']").val(data['comp_reg_no']);
                                    $("#comp_address").html(data['comp_address']);
                                    $("input[name*='comp_id']").val(data['comp_id']);
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
                                    data: {cust_id : customer_id},
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
                            $("#customerDetailEdit").submit();
                        });
                        $("#customerDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var comp_name = $.trim($("input[name*='comp_name']").val());
                            var comp_id = $.trim($("input[name*='comp_id']").val());
                            if (comp_name == '') {
                                common_alert = '\n Please enter Company name';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#customerDetailEdit")[0].reset();
                                customerDetails.modal("hide");
                            } else {
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
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>