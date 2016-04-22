<style>
    body {
        color: #fff;
        font-family: "Open Sans",sans-serif;
        background: url(img/bg_images.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    #mainWrap {
        background-color: lightpink;
        min-height: 100%;
        overflow: auto;
        padding-bottom: 60px;
    }
    #loggit {
        background-color: orange;
        width: 480px;
        margin: 6% auto 0;
        padding: 20px 40px;
        color: white;
    }
    #loggit h1 {
        text-align: center;
        font-size: 100px;
        margin: 0 0 0px;
    }
    #loggit h3 {
        text-align: center;
        font-size: 18px;
        color: #bbb;
        margin: 0 0 20px;
    }
    #loggit .input-group-addon {
        border: 0 none;
    }
    #loggit .form-control {
        border: 0 none;
    }
    #loggit .form-control:focus {
        box-shadow: none;
    }
    #loggit .formSubmit {
        margin-bottom: 25px;
    }
    #loggit .submitWrap {
        text-align: right;
    }
    #loggit .formNotice {
        margin: 0;
        font-size: 13px;
    }
    #loggit .formNotice span {
        cursor: pointer;
        color: #428BCA;
    }
    #loggit .formNotice span:hover,
    #loggit .formNotice span:focus {
        color: #2A6496;
        text-decoration: underline;
    }
    #loggit #regForm {
        display: none;
    }
</style>
<div id="mainWrap">
    <nav class="navbar navbar-static-top" role="navigation">
        <p style="text-align: center; font-size: 20px;font-family: 'Arial', cursive;font-size: 35px"></p>
    </nav>
    <div id="loggit">
        <h1>CRM</h1>
        <h3>Please <strong>Login</strong> to <strong>Continue</strong></h3>

        <form action="#" id="logForm" method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                        <input name="data[User][username]" type="text" class="form-control input-lg" placeholder="Email" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input  name="data[User][password]" type="password" class="form-control input-lg" placeholder="Password" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group formSubmit">
                <div class="col-sm-7">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked autocomplete="off"> Keep me logged in
                        </label>
                    </div>
                </div>
                <div class="col-sm-5 submitWrap">
                    <button type="submit" class="btn btn-primary btn-primary">Log In</button>
                </div>
            </div>
        </form>
    </div>

</div>
<footer class="footer-text">
    <p >Copyright © <b>2014 Legal Compliance Management System</b></p>
</footer>