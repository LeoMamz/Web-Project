<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<html>
<head>
<title>添加图书类型信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE1 {
    color: #FFFFFC;
	font-size: 10pt;
	font-weight: bold;
}
.STYLE2 {
	font-size: 10pt;
	color: #DC143C;
	font-weight: bold;
}
-->
</style>
</head>
<script language="jscript">
function check(form){
	if(form.typeName.value==""){
		alert("请输入类型名称!");form.typeName.focus();return false;
	}
	if(form.days.value==""){
		alert("请输入可借天数!");form.days.focus();return false;
	}	
}
</script>
<body>
<table width="292" height="175" border="0" cellpadding="0" cellspacing="0" background="Images/book1.png">
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%" height="31">&nbsp;</td>
        <td width="94%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table width="100%" height="131"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center">	<form name="form1" method="post" action="bookType.do?action=bookTypeAdd">
	
      <tr>
        <td width="45%" align="center" class="STYLE1">类型名称：</td>
        <td width="55%" height="39">
          <input name="typeName" type="text" size="30">        </td>
      </tr>
      <tr>
        <td width="90" align="center" class="STYLE1">可借天数：</td>
        <td height="35"  class="STYLE1"><input name="days" type="text" id="days" size="25">
          (天)</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><input name="Submit" type="submit" class="btn_grey" value="保存" onClick="return check(form1)">
          &nbsp;
          <input name="Submit2" type="button" class="btn_grey" value="关闭" onClick="window.close();"></td>
      </tr>
    
	        </form></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
