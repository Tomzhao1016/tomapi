
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<meta name="referrer" content="never">
<meta http-equiv="X-UA-Compatible" content="IE=11" />
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
</head>
<body marginwidth="0" marginheight="0" style="position:absolute;width:100%;top:0;bottom:0;backgroung:#000">
<link rel="stylesheet" href="./DPlayer.min.css">
<script src="./jquery.min.js"></script>
<div id="player1"></div>
<script type="text/javascript" src="./hls.min.js"></script>
<script type="text/javascript" src="./DPlayer.min.js" charset="utf-8"></script>
<script>
var dp = new DPlayer({
    element: document.getElementById('player1'),
    video: {
        url: "<?php echo $_GET['url'];?>"
    }
});
dp.play();
</script>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>

<script language="javascript" type="text/javascript" src="http://js.users.51.la/18759442.js"></script>
</body>
</html>
