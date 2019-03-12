<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BorrowDAO" %>
<%@ page import="com.actionForm.BorrowForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("Bremind");
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
    <td valign="top" bgcolor="#FFFFFF"><table width="99%" height="510" background="Images/AF13.png"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：系统查询-&gt; 归还查询-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无到期提醒信息！</td>
            </tr>
          </table>
          <%
}else{
  //通过迭代方式显示数据
  Iterator it=coll.iterator();
  String bookname="";
  String bookbarcode="";
  String readerbar="";
  String readername="";
  String borrowTime="";
  String backTime="";
  %>
          <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#F6B83B" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#333333">
    <td width="15%" class="STYLE1" >图书编号</td>
    <td width="23%" class="STYLE1" align="center">图书名称</td>
    <td width="17%" class="STYLE1" align="center">借书证号</td>
    <td width="14%" class="STYLE1" align="center">读者名称</td>
    <td width="15%" class="STYLE1" align="center">借阅时间</td>
    <td width="16%" class="STYLE1" align="center">应还时间</td>
    </tr>
<%
  while(it.hasNext()){
    BorrowForm borrowForm=(BorrowForm)it.next();
	bookname=borrowForm.getBookName();
	bookbarcode=borrowForm.getBookBarcode();
	readerbar=borrowForm.getReaderBarcode();
	readername=borrowForm.getReaderName();
	borrowTime=borrowForm.getBorrowTime();
	backTime=borrowForm.getBackTime();
	%>
  <tr bgcolor="#333333">
    <td class="STYLE5" style="padding:5px;">&nbsp;<%=bookbarcode%></td>
    <td class="STYLE5" align="center" style="padding:5px;"><%=bookname%></td>
    <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=readerbar%></td>
    <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=readername%></td>
    <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=borrowTime%></td>
    <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=backTime%></td>
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
