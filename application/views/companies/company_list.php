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
                    <div class="h1">Companies<button onclick="addCompany()" class="btn btn-warning">Add Company</button></div>
                    <table id="company_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Registration No.</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="companyDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-lg">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="companyDetailEdit" id="companyDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="comp_name">Name</label>
                                    <input type="hidden" name="comp_id" id="comp_id" value="0" class="form-control">
                                    <input type="text" name="comp_name" id="comp_name" class="form-control">
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="comp_reg_no">Registration No</label>
                                    <input type="text" name="comp_reg_no" id="comp_reg_no" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-8">
                                    <label for="comp_address"></label>
                                    <textarea name="comp_address" class="form-control" rows="5" cols="" id="comp_address"></textarea>
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
                        var dataTableCompany = "<?= site_url("index.php/companies/ajaxAllCompaniesMasterDataTable") ?>";
                        var companyDetails = $("#companyDetails");
                        $(document).ready(function () {
                            var table1 = $('#company_list').DataTable({
                                "ajax": {
                                    url: dataTableCompany,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: 'comp_name'},
                                    {mData: 'comp_reg_no'},
                                    {mData: "comp_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editCompany(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteCompany(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addCompany() {
                            $("#companyDetails .modal-title").html("");
                            $("#companyDetailEdit input:not(#submitBtn)").val("");
                            $("#companyDetailEdit textarea").html("");
                            $("#companyDetailEdit")[0].reset();
                            companyDetails.modal("show");
                        }
                        function editCompany(company_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/companies/ajaxCompanyMasterDetails') ?>",
                                data: {comp_id: company_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='comp_name']").val(data['comp_name']);
                                    $("input[name*='comp_reg_no']").val(data['comp_reg_no']);
                                    $("#comp_address").html(data['comp_address']);
                                    $("input[name*='comp_id']").val(data['comp_id']);
                                    companyDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableCompany, null, function (json) {
                                table = $('#company_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteCompany(comp_id) {
                            var r = confirm("You Sure to delete the Amenity?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/companies/ajaxCompanyMasterDelete') ?>",
                                    data: {comp_id : comp_id},
                                    success: function (result) {
                                        companyDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                companyDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#companyDetailEdit").submit();
                        });
                        $("#companyDetailEdit").submit(function (e) {
                            var common_alert = "";
                            var comp_name = $.trim($("input[name*='comp_name']").val());
                            var comp_id = $.trim($("input[name*='comp_id']").val());
                            if (comp_name == '') {
                                common_alert = '\n Please enter Company name';
                            }
                            if ($.trim(common_alert) != '') {
                                alert(common_alert);
                                $("#companyyDetailEdit")[0].reset();
                                companyDetails.modal("hide");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/companies/ajaxCompaniesMasterSubmit') ?>",
                                    data: $("#companyDetailEdit").serialize(),
                                    success: function (result) {
                                        $("#companyDetailEdit")[0].reset();
                                        companyDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            }
                            e.preventDefault();
                        });
        </script>
    </body>
</html>