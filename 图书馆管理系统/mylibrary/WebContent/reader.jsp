<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.ReaderDAO" %>
<%@ page import="com.actionForm.ReaderForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("reader");
%>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE11 {
	font-size: 13pt;
	font-weight: bold;
	color: #FFFFFF;
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
    <td valign="top" bgcolor="#FFFFFF"><table width="99%" height="510" background="Images/AF12.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：读者管理-&gt; 读者档案管理-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无读者信息！</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <a href="reader_add.jsp">添加读者信息</a> </td>
  </tr>
</table>
 <%
}else{
  //通过迭代方式显示数据
  Iterator it=coll.iterator();
  int ID=0;
  String name="";
  String typename="";
  String barcode="";
  String paperType="";
  String paperNO="";
  String tel="";
  String email="";
  %>
 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="87%">&nbsp;      </td>
<td width="13%">
      <a href="reader_add.jsp">添加读者信息</a></td>	  
  </tr>
</table>  
  <table width="95%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#F6B83B" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#333333">
    <td width="13%" class="STYLE1">借书证号</td>  
    <td width="8%" class="STYLE1">姓名</td>
    <td width="12%" class="STYLE1">读者类型</td>
    <td width="12%" class="STYLE1">证件类型</td>
    <td width="18%" class="STYLE1">证件号码</td>
    <td width="12%" class="STYLE1">电话</td>
    <td width="15%" class="STYLE1">Email</td>
    <td width="5%" class="STYLE1">修改</td>
    <td width="5%" class="STYLE1">删除</td>
  </tr>
<%
  while(it.hasNext()){
    ReaderForm readerForm=(ReaderForm)it.next();
	ID=readerForm.getId().intValue();
	name=readerForm.getName();
	barcode=readerForm.getBarcode();
	typename=chStr.nullToString(readerForm.getTypename(),"&nbsp;");
	paperType=readerForm.getPaperType();
	paperNO=chStr.nullToString(readerForm.getPaperNO(),"&nbsp;");
	tel=chStr.nullToString(readerForm.getTel(),"&nbsp;");
	email=chStr.nullToString(readerForm.getEmail(),"&nbsp;");
	%> 
  <tr bgcolor="#333333">
    <td class="STYLE5" style="padding:5px;"><%=barcode%></td>  
    <td class="STYLE5" align="center" style="padding:5px;"><a href="reader.do?action=readerDetail&ID=<%=ID%>"><%=name%></a></td>
    <td class="STYLE5" align="center" style="padding:5px;"><%=typename%></td>
    <td class="STYLE5" align="center"><%=paperType%></td>
    <td class="STYLE5" align="center"><%=paperNO%></td>
    <td class="STYLE5" align="center"><%=tel%></td>
    <td class="STYLE5" align="center"><%=email%></td>
    <td class="STYLE5" align="center"><a href="reader.do?action=readerModifyQuery&ID=<%=ID%>">修改</a></td>
    <td class="STYLE5" align="center"><a href="reader.do?action=readerDel&ID=<%=ID%>">删除</a></td>
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
