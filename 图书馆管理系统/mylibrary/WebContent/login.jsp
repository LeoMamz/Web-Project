<%@ page contentType="text/html; charset=utf-8" language="java"%>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style type="text/css">
<!--
.STYLE0 {
	font-size: xx-large;
	font-weight: bold;
	color: #000000;
}
.STYLE1 {
    color: #FFFFFF;
    font-weight: bold;
    font-size: 12pt;
}
.STYLE2 {color: #FFFFF2}
-->
</style>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<script language="javascript">
function check(form){
	if (form.name.value==""){
		alert("请输入管理员名称!");form.name.focus();return false;
	}
	if (form.pwd.value==""){
		alert("请输入密码!");form.pwd.focus();return false;
	}	
}
</script>
</head>
<body">
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFF2" class="tableBorder">
  <tr>
    <td>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="142" valign="top"><p>&nbsp;</p>
      <p align="center" class="STYLE0">图书馆管理系统</p></td>
  </tr>
</table>
	</td>
  </tr>
	<td>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="525"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="523" align="center" valign="top"><table width="100%" height="271"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="271" align="right" valign="top" class="word_orange"><table width="100%" height="255"  border="0" cellpadding="0" cellspacing="0" background="Images/2.jpg">
          <tr>
            <td height="57">&nbsp;</td>
            </tr>
          <tr>
            <td height="179" valign="top"><table width="100%" height="63"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="2%">&nbsp;</td>
                  <td width="97%" align="center" valign="top">
                    <form name="form1" method="post" action="manager.do?action=login">
                      <table width="100%"  border="0" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#D2E3E6">
                        <tr>
                          <td height="57">&nbsp;</td>
                          <td height="57" colspan="2" align="center">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr> 
                        <tr>
                          <td width="20%" height="37">&nbsp;</td>
                      <td width="20%"><span class="STYLE1">管理员账号：</span></td>
                      <td width="41%">
                        <input name="name" type="text" class="logininput" id="name" size="27">                        </td>
                      <td width="19%"><span class="STYLE2">游客账号：123</span></td>
                    </tr>
                        <tr>
                          <td height="37">&nbsp;</td>
                      <td><span class="STYLE1">管理员密码：</span></td>
                      <td><input name="pwd" type="password" class="logininput" id="pwd" size="27"></td>
                      <td><span class="STYLE2">游客密码：123</span></td>
                    </tr>
                        <tr>
                          <td height="30">&nbsp;</td>
                      <td colspan="2" align="center"><input name="Submit" type="submit" class="btn_grey" value="确定" onClick="return check(form1)">
                        &nbsp;
                        <input name="Submit3" type="reset" class="btn_grey" value="重置">&nbsp;
                        <input name="Submit2" type="button" class="btn_grey" value="关闭" onClick="window.close();"></td>
                      <td>&nbsp;</td>
                    </tr>
                        </table> 
			  </form>				   </td>
                  <td width="1%">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          <tr>
            <td height="19">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      
    </table>
      <table width="100%" height="60"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" class="word_login">3160104793-马铭泽</td>
        </tr>
      </table></td>
  </tr>
</table></td>
  </tr>
</table>
</td>
  </tr>
</table>
</body>
</html>
