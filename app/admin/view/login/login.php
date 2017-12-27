<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
    <meta charset="utf-8" />
    <title>微信cms系统后台登录</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{__ROOT__}}/resource/admin/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{{__ROOT__}}/resource/admin/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="{{__ROOT__}}/resource/admin/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="{{__ROOT__}}/resource/admin/css/font.css" type="text/css" />
    <link rel="stylesheet" href="{{__ROOT__}}/resource/admin/css/app.css" type="text/css" />
</head>
<body class="">
<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xxl">
        <a class="navbar-brand block" href="http://wubin.pro" target="_blank">微信cms系统后台登录</a>
        <section class="panel panel-default m-t-lg bg-white">
            <header class="panel-heading text-center">
                <h4>登录</h4>
            </header>
            <form action="" method="post" class="panel-body wrapper-lg">
                <div class="form-group">
                    <label class="control-label">帐号</label>
                    <input type="text" placeholder="请输入登录帐号" name="username"  class="form-control input-lg">
                </div>
                <div class="form-group">
                    <label class="control-label">密码</label>
                    <input type="text"  name="password" placeholder="请输入登录密码" class="form-control input-lg">
                </div>
                <div class="form-group" style="overflow: hidden">
                    <label class="control-label">验证码</label>
                    <div>
                        <input type="text" style="width: 60%;float: left"  name="code" placeholder="请输入验证码" class="form-control input-lg">
                        <img style="float: right;width: 39%" src="{{u('code')}}" alt="" onclick="this.src = this.src+'&rand='+Math.random()">
                    </div>
                </div>
                <div class="line line-dashed"></div>
                <button type="submit" class="btn btn-primary btn-block">登录</button>
            </form>
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder clearfix">
        <p>
            <small>超人：wubin.mail@foxmail.com<br>&copy; 2017</small>
        </p>
    </div>
</footer>
<!-- / footer -->
<script src="{{__ROOT__}}/resource/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{__ROOT__}}/resource/admin/js/bootstrap.js"></script>
<!-- App -->
<script src="{{__ROOT__}}/resource/admin/js/app.js"></script>
<script src="{{__ROOT__}}/resource/admin/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{__ROOT__}}/resource/admin/js/app.plugin.js"></script>
</body>
</html>