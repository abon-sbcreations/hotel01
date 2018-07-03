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
        <title>Signin Template for Bootstrap</title>
        <link href="<?= site_url("library/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url("assets/css/custom01.css") ?>" rel="stylesheet">
        <style>
            body{
                background-image: url("<?= site_url("library/images/hotel_background02.jpg") ?>");
                background-repeat : no-repeat;
                background-size: 100% ;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?= form_open('index.php/hoteladmins', ['name' => 'loginForm', 'method' => 'post', 'class' => 'form-signin', 'id' => 'loginForm']); ?>
            <h2 class="form-signin-heading">Please sign in</h2>
            <div class="form-group">
                <?= form_label('User Name', 'hotel_userid', ['class' => 'sr-only', 'id' => '']); ?>
                <?= form_input(['name' => 'hotel_userid', 'placeholder' => "User Name", 'class' => 'form-control', 'id' => 'hotel_userid']); ?>
                <?= form_error('hotel_passwd'); ?>
            </div>
            <div class="form-group">
                <?= form_label('Password', 'hotel_passwd', ['class' => 'sr-only', 'id' => '']); ?>
                <?= form_password(['name' => 'hotel_passwd', 'placeholder' => "Password", 'class' => 'form-control', 'id' => 'hotel_passwd']); ?>
                <?= form_error('hotel_passwd'); ?>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <?=form_close()?>
    </div> 
    <script src="<?= site_url("library/js/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= site_url("library/js/bootstrap.min.js") ?>" type="text/javascript"></script>
    <script src="<?= site_url("library/js/jquery.validate.min.js") ?>" type="text/javascript"></script>
    <script>
        $(function(){
          $("label#error").remove();
            $("#loginForm").validate({
                rules: {
                    hotel_userid: {required: "true"},
                    hotel_passwd: {
                        required: "true",
                        remote: {
                            url: "<?= site_url('index.php/hoteladmins/ajaxCheckUnamePass') ?>",
                            type: "post",
                            delay: 150,
                            data: {
                                hotel_userid: function () {
                                    return $("#hotel_userid").val();
                                },
                                hotel_passwd: function () {
                                    return $("#hotel_passwd").val();
                                }
                            }
                        }
                    },
                },
                messages: {
                    uname: {required:"User Name is Required"},
                    password: {required: "Password is Required",
                        remote: "User name and password combination invalid"}

                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
