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
                // background-image: url("<?= site_url("library/images/hotel_background05.jpg") ?>"); 
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
                    <h1>Hotels List</h1>
                    <table id="hotels_list" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <td>Hotel Name</td>
                                <td>Type</td>
                                <td>Reg. Number</td>
                                <td>Has Restourant</td>
                                <td>Has Bar</td>
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                        {"mData": 'hotel_name'},
                        {"mData": 'hotel_type'},
                        {"mData": 'hotel_reg_number'},
                        {"mData": 'hotel_has_restaurant'},
                        {"mData": 'hotel_has_bar'},
                    ]
                });
                $('#hotels_list tbody').on('click', 'tr', function () {
                    var id = table1.row(this).id();
                    var idNo = id.substr(id.indexOf("_") + 1);
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('index.php/hotels/ajaxHotelDetails') ?>",
                        data: {hotel_id: idNo},
                        success: function (result) {
                            var data = $.parseJSON(result);
                            $("#hotelDetails .modal-title").html("<span>" + data['hotel_name'] + "</span><button onclick='deleteHotel(\"" + data['hotel_id'] + "\")'>Delete Hotel</button>");
                            hotelDetails.modal("show");
                        }
                    });
                });
            });
            function deleteHotel(hotel_id) {
                var r = confirm("You Sure to delete the Hotel?");
                if (r == true) {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('index.php/hotels/ajaxHotelDelete') ?>",
                        data: {hotel_id: hotel_id},
                        success: function (result) {
                            
                            $.getJSON(dataTableHotel, null, function( json ){
                                table = $('#hotels_list').dataTable();
                                oSettings = table.fnSettings(); 
                                table.fnClearTable(this);
                                for (var i=0; i<json['data'].length; i++){
                                    table.oApi._fnAddData(oSettings, json['data'][i]);
                                }
                                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                table.fnDraw();
                            });
                            hotelDetails.modal("hide");
                        }
                    });
                }
            }
        </script>
    </body>
</html>



