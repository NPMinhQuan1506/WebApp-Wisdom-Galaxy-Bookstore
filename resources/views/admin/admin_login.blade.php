<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width= device-width, initial-scale = 1" />
    <title>Admin Đăng Nhập</title>
    <link rel="stylesheet" href="{{asset('public/backend/css/login.css')}}" />

</head>

<body>
    <div class="logo">
        <div class="main-container">
            <div class="first-container share">
                <h1><span id="one">W</span><span>i</span><span>s</span><span>d</span><span>o</span><span>m</span>
                    <span>G</span><span>a</span><span>l</span><span>a</span><span>x</span><span>y</span></h1>
            </div>
            <div class="second-container share">
                <h1><span>B</span><span>o</span><span>o</span><span>k</span><span>s</span><span>t</span><span>o</span><span>r</span><span>e</span></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{URL::to('/admin-login')}}" method="POST">
            {{ csrf_field() }}
            <p>Admin Đăng Nhập</p>
            <?php
             $message = Session::get('message');
             if($message){
                 echo '<h5 class = "error-login">'.$message.'</h5>';
                Session::put('message', null);
             }
            ?>
            <input type="text" name="admin_username" readonly onfocus="this.removeAttribute('readonly');" placeholder="Nhập Tài Khoản"><br>
            <input type="password" name="admin_password" placeholder="Nhập Password"><br>
            <div class="support">
                <div class="remember">
                    <input type="checkbox" id="check" name="check" value="" />
                    <label for="check">
                        <span></span>Nhớ Đăng Nhập
                    </label>
                </div>
                <a href="#">Quên Mật Khẩu?</a>
            </div>
            <br>
            <input type="submit" value="Đăng Nhập"  onclick = 'this.form.submit();' >

        </form>

        <div class="drops">
            <div class="drop drop-1"></div>
            <div class="drop drop-2"></div>
            <div class="drop drop-3"></div>
            <div class="drop drop-4"></div>
            <div class="drop drop-5"></div>
        </div>
    </div>

</body>

</html>