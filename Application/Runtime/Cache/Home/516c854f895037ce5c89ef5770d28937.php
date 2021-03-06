<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>南京邮电大学社团招新系统|注册</title>
    <!-- Bootstrap -->
    <link href="/thinkphp/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/thinkphp/Public/css/style.css" rel="stylesheet">
    <script language='javascript'>
    function onEnterDown() {
        if (window.event.keyCode == 13) {
            $("#reg").click();
        }
    }

    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>

<body onkeydown='onEnterDown()'>
    <div class="wrap">
        <div class="container" id="main">
            <!--logo图片-->
            <div class="logoImg">
                <img src="/thinkphp/Public/images/logom.gif" class="img-responsive center-block">
            </div>
            <!--信息填写界面导航-->
            <ul class="nav nav-tabs RL" id="tab-list" role="tablist">
                <li role="presentation" class="first">
                    <a href="/thinkphp/index.php/Home/Index/login" data-toggle="link" role="tab" aria-expanded="true"><span>登陆</span></a>
                    <!--链接到登陆页面-->
                </li>
                <li role="presentation" class="active">
                    <a href="/thinkphp/index.php/Home/Index/reg" data-toggle="link" role="tab" aria-expanded="true"><span>注册</span></a>
                </li>
                <li role="presentation" id="forgetKeyWord">
                    <a href="#" data-toggle="link" id="forget"><span>忘记密码</span></a>
                </li>
            </ul>
            <!--信息填写界面面板-->
            <div class="tab-content">
                <!--注册界面-->
                <div role="tabpannel" class="tab-pane active" id="sign-up">
                    <form role="form">
                        <div class="form-group">
                            <input type="studentId" class="form-control" id="inputStudentId1" placeholder="学号" checkedd="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputName1" placeholder="姓名" checkedd="">
                        </div>
                        <div class="form-group">
                            <input type="passWord" class="form-control" id="inputPassWord1" placeholder="密码" checkedd="">
                        </div>
                        <div class="form-group">
                            <input type="passWord" class="form-control" id="confirmPassWord1" placeholder="确认密码" checkedd="">
                        </div>
                        <div class="form-group" id="identifyingCode1">
                            <input type="text" class="form-control" id="inputIdentifyingCode1" placeholder="验证码">
                            <div id="identifyingPicture">
                                <img src="/thinkphp/index.php/Home/Index/verify" alt="验证码" onClick="this.src=this.src+'?'+Math.random()" title="看不清，换一张">
                            </div>
                        </div>
                    </form>
                    <!--信息提交按钮-->
                    <button type="button" class="btn btn-primary center-block" id="reg">sign up</button>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
    <div class="footer">
        <div class="container bottom">
            <p class="test-muted">&copy; 校科协</p>
        </div>
    </div>
    <script src="/thinkphp/Public/js/jquery-1.11.2.min.js"></script>
    <script src="/thinkphp/Public/js/bootstrap.min.js"></script>
    <!--<script src="../../../../public/js/ajax.js"></script>-->
    <script>
    $(document).ready(function() {

        $("#forget").click(function() {
            alert("请联系社团管理员，告知其学号姓名后重置密码");
        });
        $("#reg").click(function() {
            var xh = $("#inputStudentId1").val();
            var name = $("#inputName1").val();
            var password = $("#inputPassWord1").val();
            var verifyCode  = $("#inputIdentifyingCode1").val();
            if (($("#inputStudentId1").attr("checkedd") == "checked") && ($("#inputName1").attr("checkedd") == "checked") && ($("#inputPassWord1").attr("checkedd") == "checked") && ($("#confirmPassWord1").attr("checkedd") == "checked")) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('Home/User/doReg');?>",
                    dataType: "json",
                    data: {
                        "xh": xh,
                        "name": name,
                        "password": password,
                        "verifyCode": verifyCode
                    },
                    success: function(back) {
                        if (back.status == 1) {
                            console.log(back);
                            window.location.href = "<?php echo U('Home/Index/changeDepartment');?>";

                        } else {
                            console.log(back);
                            alert(back.info);
                        }
                    },
                    error: function() {
                        alert("服务器异常！");
                    }
                });
            } else {
                if ($("#inputStudentId1").attr("checkedd") == "") {
                    alert("请正确输入学号");
                } else if ($("#inputName1").attr("checkedd") == "") {
                    alert("请正确输入姓名，2-6个汉字");
                } else if ($("#inputPassWord1").attr("checkedd") == "") {
                    alert("请正确输入密码，长度在6-18之间");
                } else {
                    alert("两次输入密码不一致");
                }
            }
        });

        $("#inputStudentId1").blur(function() {
            var id = /^[BQH][1][2345][0-9]{6}$/;
            if (!id.test($("#inputStudentId1").val())) {
                $("#inputStudentId1").css("border-color", "#8B0000");
                $("#inputStudentId1").attr("checkedd","");
            } 
            else {
                $("#inputStudentId1").css("border-color", "#66afe9");
                $("#inputStudentId1").attr("checkedd", "checked");
            }
        });
        $("#inputName1").blur(function() {
            if (!$("#inputName1").val()) {
                $("#inputName1").attr("placeholder", "姓名");
            }
            var id = /[\u4e00-\u9fa5]{2,6}/;
            if (!id.test($("#inputName1").val())) {
                $("#inputName1").css("border-color", "#8B0000");
                $("#inputName1").attr("checkedd", "");
            } else {
                $("#inputName1").css("border-color", "#66afe9");
                $("#inputName1").attr("checkedd", "checked");
            }
        });
        $("#inputPassWord1").blur(function() {
            if (!$("#inputPassWord1").val()) {
                $("#inputPassWord1").attr("placeholder", "密码");
            }
            var id = /^[\w\W]{6,16}$/;
            if (!id.test($("#inputPassWord1").val())) {
                $("#inputPassWord1").css("border-color", "#8B0000");
                $("#inputPassWord1").attr("checkedd", "");
            } else {
                $("#inputPassWord1").css("border-color", "#66afe9");
                $("#inputPassWord1").attr("checkedd", "checked");
            }
        });
        $("#confirmPassWord1").blur(function() {
            var id = /^[\w\W]{6,16}$/;
            if (($("#inputPassWord1").val() == $("#confirmPassWord1").val()) && (id.test($("#inputPassWord1").val()))) {
                $("#confirmPassWord1").css("border-color", "#66afe9");
                $("#confirmPassWord1").attr("checkedd", "checked");
                console.log($("#confirmPassWord1").attr("checkedd"));
            } else {
                $("#confirmPassWord1").css("border-color", "#8B0000");
                $("#confirmPassWord1").attr("checkedd", "");
            }
        });
        $("#inputName1").focus(function() {
            $("#inputName1").attr("placeholder", "2-6位汉字");
        });
        $("#inputPassWord1").focus(function() {
            $("#inputPassWord1").attr("placeholder", "6-18位、字母或数字开头");
        });
    });

    </script>
</body>

</html>