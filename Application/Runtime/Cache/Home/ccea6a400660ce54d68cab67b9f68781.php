<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>南京邮电大学社团招新系统|登陆</title>

    <!-- Bootstrap -->
    <link href="/thinkphp/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/thinkphp/Public/css/style.css" rel="stylesheet">
    <script language='javascript'>
    function onEnterDown () {
      if(window.event.keyCode == 13){
        $("#login").click();
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
        <li role="presentation" class="active first">
          <a href="/thinkphp/index.php/Home/Index/login" data-toggle="link" role="tab" aria-expanded="true" ><span>登陆</span></a>
        </li>
        <li role="presentation">
          <a href="/thinkphp/index.php/Home/Index/reg" data-toggle="link" role="tab" aria-expanded="true" ><span>注册</span></a>                                         <!--链接到注册页面-->
        </li>
        <li role="presentation" id="forgetKeyWord">
          <a href="#" data-toggle="link" id="forget"><span>忘记密码</span></a>
        </li>
      </ul>

      <!--信息填写界面面板-->
      <div class="tab-content">
        <!--登陆界面-->
        <div role="tabpannel" class="tab-pane active" id="sign-in">
          <form role="form">
            <div class="form-group">
              <input type="studentId" class="form-control" id="inputStudentId" placeholder="学号" checked="">
            </div>
            <div class="form-group">
              <input type="passWord" class="form-control" id="inputPassWord" placeholder="密码" checked="">
            </div>
            <div class="checkbox">
                <label>
                    <input id="rememberMe" type="checkbox"> 记住我
                </label>
            </div>
          </form>
          <!--信息提交按钮-->
      <button type="button" class="btn btn-primary center-block" id="login">sign in</button>
        </div>
        
      </div>
    </div> <!-- /container -->
    </div>
    <div class="footer">
      <div class="container bottom">
      <p class="test-muted">&copy; 校科协</p>
    </div>
    </div>
    <script src="/thinkphp/Public/js/jquery-1.11.2.min.js"></script>
    <script src="/thinkphp/Public/js/bootstrap.min.js"></script>
    <script src="/thinkphp/Public/js/jquery.cookie.min.js"></script>
    <script>
    
    $(document).ready(function(){
      
    $("#forget").click(function(){
      alert("请联系社团管理员，告知其学号姓名后重置密码");
    });
    $("#login").click(function(){
      var studentid = $('#inputStudentId').val();
      var password = $('#inputPassWord').val();
      if(($("#inputStudentId").attr("checked")=="checked")&&($("#inputPassWord").attr("checked")=="checked")){
        $.ajax({  
                    type : "POST",  
                    url : "<?php echo U('Home/User/doLogin');?>",
                    data : {"xh":studentid,"password":password},
                    dataType : "json",
                    success : function(back){
                        if(back.status == 1){
                          window.location.href = '<?php echo U('Home/Index/changeDepartment');?>'
                        } else {
                          alert(back.info);
                        }
                    },
                    error : function(XMLHttpRequest,info){
                      console.log(XMLHttpRequest);

                    }
                });
      } else {
        alert("请正确输入信息");
      }
    });

     
    $("#inputStudentId").blur(function(){
    var id = /^[BQH][0-9]{8}$/;
    if(!id.test($("#inputStudentId").val())){
        $("#inputStudentId").css("border-color","#8B0000");
        $("#inputStudentId").attr("checked","");
    } else {
        $("#inputStudentId").css("border-color","#66afe9");
        $("#inputStudentId").attr("checked","checked");
    }
    });    

    $("#inputPassWord").blur(function(){
    if($("#inputPassWord").val().length == 0){
        $("#inputPassWord").css("border-color","#8B0000");
        $("#inputPassWord").attr("checked","");
    } else {
        $("#inputPassWord").css("border-color","#66afe9");
        $("#inputPassWord").attr("checked","checked");
    }
    }); 

});

    //判断之前是否有设置cookie，如果有，则设置【记住我】选择框  
    if($.cookie('absms_crm2_userName')!=undefined){  
        $("#rememberMe").attr("checked", true);  
    }else{  
        $("#rememberMe").attr("checked", false);  
    }  
      
    //读取cookie  
    if($('#rememberMe:checked').length>0){  
        $('#inputStudentId').val($.cookie('absms_crm2_userName'));  
    }  
      
    //监听【记住我】事件  //设置cookie //清除cookie 
    $("#rememberMe").click(function(){  
        if($('#rememberMe:checked').length>0){ 
            $.cookie('absms_crm2_userName', $('#inputStudentId').val(),{ expires: 15 });  
        }else{ 
            $.removeCookie('absms_crm2_userName');  
        }  
    });  

    </script>
  </body>
</html>