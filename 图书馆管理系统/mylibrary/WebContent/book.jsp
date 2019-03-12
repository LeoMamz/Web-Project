<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BookDAO" %>
<%@ page import="com.actionForm.BookForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("book");
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
	color: #333333;
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
<table width="778" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" bgcolor="#333333"><table width="99%" height="510" background="Images/AF11.png"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFC" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：图书管理-&gt; 图书档案管理-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无图书信息！</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <a href="book_add.jsp" class="STYLE21">添加图书信息</a> </td>
  </tr>
</table>
 <%
}else{
  //通过迭代方式显示数据
  Iterator it=coll.iterator();
  int ID=0;
  int total=0;
  int stock=0;
  String bookname="";
  String barcode="";
  String typename="";
  String publishing="";
  String bookcase="";
  int storage=0;
  %>
 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%">&nbsp;      </td>
<td width="30%">
      <div align="right"> <a href="book_add.jsp" class="STYLE21">添加图书信息</a></div></td>  
  </tr>
</table>  
  <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#D2E3E6" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#e3F4F7">
    <td class="STYLE1" width="15%" bgcolor="#333333">图书编号(bno)</td>  
    <td class="STYLE1" width="20%" bgcolor="#333333">图书名称</td>
    <td class="STYLE1" width="15%" bgcolor="#333333">出版社</td>
    <td class="STYLE1" width="12%" bgcolor="#333333">图书类型</td>
    <td class="STYLE1" width="8%" bgcolor="#333333">藏书量</td>
    <td class="STYLE1" width="8%" bgcolor="#333333">库存</td>
    <td class="STYLE1" width="8%" bgcolor="#333333">修改(update)</td>
    <td class="STYLE1" width="8%" bgcolor="#333333">删除(delete)</td>
  </tr>
<%
  while(it.hasNext()){
    BookForm bookForm=(BookForm)it.next();
	ID=bookForm.getId().intValue();
	bookname=bookForm.getBookName();
	barcode=chStr.nullToString(bookForm.getBarcode(),"&nbsp;");
	typename=bookForm.getTypeName();
	publishing=bookForm.getPublishing();
	total=bookForm.getTotal();
	stock=bookForm.getStock();
	%> 
  <tr bgcolor="#333333">
    <td class="STYLE5" style="padding:5px;">&nbsp;<%=barcode%></td>  
    <td class="STYLE5" style="padding:5px;"><a href="book.do?action=bookDetail&ID=<%=ID%>"><%=bookname%></a></td>
    <td class="STYLE5" style="padding:5px;">&nbsp;<%=publishing%></td>
    <td class="STYLE5" style="padding:5px;">&nbsp;<%=typename%></td>  
	<td class="STYLE5" style="padding:5px;">&nbsp;<%=total%></td> 
	<td class="STYLE5" style="padding:5px;">&nbsp;<%=stock%></td> 
    <td class="STYLE5" align="center"><a href="book.do?action=bookModifyQuery&ID=<%=ID%>">修改</a></td>
    <td class="STYLE5" align="center"><a href="book.do?action=bookDel&ID=<%=ID%>">删除</a></td>
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
