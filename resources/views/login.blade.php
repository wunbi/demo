<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        @include('layouts.flash-message')
        <div class="form-group text-center" style="margin: 15% auto;">
            <h3>會員登入</h3>
            <form id="consent" method="post" action="<?= route('doLogin') ?>">
                {{ csrf_field() }}
                <div class="well" style="width:200px;margin: 0 auto;">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                        <input type="text" name="account" placeholder="帳號" class="form-control" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                        <input type="password" name="password" placeholder="密碼" class="form-control" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">登入</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>