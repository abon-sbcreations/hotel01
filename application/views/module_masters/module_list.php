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
        <title>Module List</title>
        <link href="<?= site_url("library/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("library/css/datatables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("assets/css/custom02.css") ?>" rel="stylesheet">

        <style>
            #modalDialog{
                width:50%;
            }
        </style>
    </head>
    <body>
        <?=$head01Temp?>
        <div class="container-fluid">
            <div class="row">
                <?=$leftmenu01Temp?>
                <div class="col-md-10 col-lg-offset-2">
                    <div class="h2"><span>Module Management</span><span class="addbttn"><button onclick="addModule()" class="btn btn-info">Add Module</button></span></div>
                    <table id="module_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Description</th>
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
        <div id="moduleDetails" class="modal  fade" role="dialog">
            <div id="modalDialog" class="modal-dialog  modal-sm">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Module Management</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" name="moduleDetailEdit" id="moduleDetailEdit" >
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label for="module_name">Name</label>
                                    <input type="hidden" name="module_id" id="module_id" value="0" class="form-control">
                                    <input type="text" name="module_name" id="module_name" class="form-control">
                                </div>
                                <div class="form-group col-md-10">
                                    <label for="module_status">Status</label>
                                    <br><select class="custom-select d-block w-100 form-control" id="module_status" name="module_status"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-md-10">
                                    <label for="module_desc">Amenity Description:</label>
                                    <textarea name="module_desc" class="form-control" rows="5" cols="" id="module_desc"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-10">
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
        <script type="text/javascript">
                        var dataTableModule = "<?= site_url("index.php/module_masters/ajaxAllModulesMasterDataTable") ?>";
                        var moduleDetails = $("#moduleDetails");
                        var statusOption;
                        $(document).ready(function () {
                            statusOption = "<?= addslashes(json_encode($statusOption)) ?>";
                            var table1 = $('#module_list').DataTable({
                                "ajax": {
                                    url: dataTableModule,
                                    type: 'GET'
                                },
                                "aoColumns": [
                                    {mData: "module_name",  sWidth: "150px",
                                        mRender: function (data, type, full) {
                                            return data;
                                        }
                                    },
                                    {mData: 'module_desc'},
                                    {mData: "module_status",  sWidth: "40px",
                                        mRender: function (data, type, full) {
                                            return data;
                                        }
                                    },
                                    {mData: "module_id", bSortable: false, sWidth: "80px",
                                        mRender: function (data, type, full) {
                                            var editBtn = "<button class=\"btn btn-info btn-xs\" onclick=\"editModule(" + data + ")\">Edit</button>";
                                            var delBtn = "<button class=\"btn btn-danger btn-xs\" onclick=\"deleteModule(" + data + ")\">Delete</button>";
                                            return editBtn + "&nbsp;&nbsp;&nbsp;&nbsp;" + delBtn;
                                        }
                                    }
                                ]
                            });
                        });
                        function addModule() {
                            $("#moduleDetailEdit input:not(#submitBtn)").val("");
                            $("#moduleDetailEdit textarea").html("");
                            popOptions(statusOption, "#module_status");
                            $("#moduleDetailEdit")[0].reset();
                            moduleDetails.modal("show");
                        }
                        function editModule(module_id) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/module_masters/ajaxModulesMasterDetails') ?>",
                                data: {module_id: module_id},
                                success: function (result) {
                                    var data = $.parseJSON(result);
                                    $("input[name*='module_name']").val(data['module_name']);
                                    $("#module_desc").html(data['module_desc']);
                                    $("input[name*='module_id']").val(data['module_id']);
                                    popOptions(statusOption, "#module_status", data['module_status']);
                                    moduleDetails.modal("show");
                                }
                            });
                        }
                        function refreshTable() {
                            $.getJSON(dataTableModule, null, function (json) {
                                table = $('#module_list').dataTable();
                                oSettings = table.fnSettings();
                                table.fnClearTable(this);
                                for (var i = 0; i < json['data'].length; i++) {
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                        }
                        function deleteModule(module_id) {
                            var r = confirm("You Sure to delete the Module?");
                            if (r == true) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= site_url('index.php/module_masters/ajaxModulesMasterDelete') ?>",
                                    data: {module_id: module_id},
                                    success: function (result) {
                                        moduleDetails.modal("hide");
                                        refreshTable();
                                    }
                                });
                            } else {
                                moduleDetails.modal("hide");
                            }
                        }
                        $("#submitBtn").on("click", function () {
                            $("#moduleDetailEdit").submit();
                        });
                        $("#moduleDetailEdit").submit(function (e) {
                            $.ajax({
                                type: "POST",
                                url: "<?= site_url('index.php/module_masters/ajaxAModulesMasterSubmit') ?>",
                                data: $("#moduleDetailEdit").serialize(),
                                success: function (result) {
                                    $("#moduleDetailEdit")[0].reset();
                                    moduleDetails.modal("hide");
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
        </script>
    </body>
</html>