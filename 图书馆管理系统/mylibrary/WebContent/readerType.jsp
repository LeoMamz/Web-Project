<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.ReaderTypeDAO" %>
<%@ page import="com.actionForm.ReaderTypeForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("readerType");
%>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE11 {
	font-size: 13pt;
	font-weight: bold;
}
.STYLE21 {
	font-size: 10pt;
	color: #DC143C;
	font-weight: bold;
}
.STYLE1 {
	font-size: 13pt;
	font-weight: bold;
	color: #FFFFFF;
}
.STYLE5 {
    color: #FFFFFF;
	font-size: 10pt;
}
.STYLE6 {
    color: #FFFFF2;
	font-size: 12pt;
	font-weight: bold;
}
-->
</style>
</head>
<body onLoad="clockon(bgclock)">
<%@include file="banner.jsp"%>
<%@include file="navigation.jsp"%>
<table width="778"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="99%" height="510" background="Images/AF12.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：读者管理-&gt; 读者类型管理-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无读者类型信息！</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <a href="#" onClick="window.open('readerType_add.jsp','','width=292,height=175')">添加读者类型信息</a> </td>
  </tr>
</table>
 <%
}else{
  //通过迭代方式显示数据
  Iterator it=coll.iterator();
  int ID=0;
  String name="";
  int number=0;
  %>
 <table width="91%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right">      
      <a href="#" onClick="window.open('readerType_add.jsp','','width=292,height=175')">添加读者类型信息</a> </td>
</tr>
</table>  
  <table width="91%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#F6b83B" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#333333">
    <td width="35%" class="STYLE1">读者类型名称</td>
    <td width="35%" class="STYLE1">可借数量</td>
    <td width="16%" class="STYLE1">修改</td>
    <td width="14%" class="STYLE1">删除</td>
  </tr>
<%
  while(it.hasNext()){
    ReaderTypeForm readerTypeForm=(ReaderTypeForm)it.next();
	ID=readerTypeForm.getId().intValue();
	name=readerTypeForm.getName();
	number=readerTypeForm.getNumber();
	%> 
  <tr bgcolor="#333333">
    <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=name%></td>
    <td class="STYLE5" align="right" style="padding:5px;">&nbsp;<%=number%></td>
    <td class="STYLE5" align="center"><a href="#" onClick="window.open('readerType.do?action=readerTypeModifyQuery&ID=<%=ID%>','','width=292,height=175')">修改</a></td>
    <td class="STYLE5" align="center"><a href="readerType.do?action=readerTypeDel&ID=<%=ID%>">删除</a></td>
  </tr>
<%
  }
}
%>  
</table></td>
      </tr>
    </table>
</td>
  </tr>
</table><%@ include file="copyright.jsp"%></td>
  </tr>
</table>
</body>
</html>
