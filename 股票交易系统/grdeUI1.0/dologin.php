<?php
$size = 'a';
echo '<form action="loginmanage.php" method="post">';
echo '账号：<input type=\"text\" name=1><br>
    密码：<input type=\"text\" name=2><br>';
echo '<button name= "update" type = "submit" title=\"详情\" value="adsf">修改</button>';
echo '<button name= "delete" type = "submit" title=\"删除\" value=' .$size.'>删除</button>';
echo '<input type="submit" value="立即登陆">
</form>';
