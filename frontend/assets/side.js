
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>404哟</title>
    <style>
    a {
        color: #555;
        text-decoration: none;
    }
    
    a:hover {
        color: #000;
        text-decoration: none
    }
    
    img {
        display: block;
        max-width: 100%;
        margin: 60px auto 0;
        border: 0px
    }
    
    p span {
        display: block;
        text-align: center;
    }
    
    i {
        font-style: normal;
        color: #f00;
    }
    </style>
</head>

<body>
    <a href="/"><img border="0" src="/plug-in/login/images/404_3.gif" /></a>
    <p style="font-size: 14px; line-height: 24px; color:#888; font-family: 微软雅黑;">
        <span>啊~哦~ 您要查看的页面不存在或已删除！</span>
        <span>请检查您输入的网址是否正确，<i id="num">3</i>s后跳回 <a href="/">网站首页</a>！</span>
    </p>
</body>
<script type="text/javascript" src="/plug-in/login/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function() {
    var startNum = 3;
    setInterval(function() {
        if (startNum > 1) {
            startNum--;
            $("#num").html(startNum);
        } else {
            location.href = "/";
        }
    }, 1000);
});
</script>

</html>
