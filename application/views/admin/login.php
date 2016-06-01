<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Вхід для співробітників</title>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <script type="text/javascript" src="/front-end/js/bootstrap.js"></script>
    <script type="text/javascript" src="/front-end/js/custom.js"></script>
    <link rel="stylesheet" href="/front-end/css/main.css">
    <link rel="stylesheet" href="/front-end/css/bootstrap.css">
    <link rel="stylesheet" href="/front-end/css/bootstrap-theme.css">


</head>
<body>
<div class="container-fluid">
    <div class="row login-form">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Вхід</div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Логін" name="email" type="email" autofocus="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Запам'ятати данні
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary login-btn" value="Увійти"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
</div>
</body>
</html>