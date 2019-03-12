<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BorrowDAO" %>
<%@ page import="com.actionForm.BorrowForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("bookBorrowSort");
%>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE1 {
    color: #FFFFFE;
    font-size: 13pt;
    font-weight: bold;
}
.STYLE2 {
    color: #ffffff;
	font-size: 10pt;
}
-->
</style>
</head>
<body onLoad="clockon(bgclock)">
<%@include file="banner.jsp"%>
<%@include file="navigation.jsp"%>
<table width="778"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="99%" height="510"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="word_orange">当前位置：图书借阅排行榜-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无图书借阅信息！</td>
            </tr>
          </table>
          <%
}else{
  //通过迭代方式显示数据
  Iterator it=coll.iterator();
  int degree=0;
  String bookname="";
  String typename="";
  String barcode_book="";
  String bookcase="";
  String pub="";
  String author="";
  String translator="";
  Float price=new Float(0);
  %>
 <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#F6B83B" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#e3F4F7">
  <td width="12%" height="50" bgcolor="#333333"><span class="STYLE1">借阅次数(times)</span></td>
    <td width="14%" bgcolor="#333333"><span class="STYLE1">图书编号(bno)</span></td>
    <td width="17%" bgcolor="#333333"><span class="STYLE1">图书名称(name)</span></td>
    <td width="12%" bgcolor="#333333"><span class="STYLE1">图书类型(type)</span></td>
    <td width="17%" bgcolor="#333333"><span class="STYLE1">出版社(press)</span></td>
    <td width="12%" bgcolor="#333333"><span class="STYLE1">作者(author)</span></td>
    <td width="12%" bgcolor="#333333"><span class="STYLE1">定价(price)/元</span></td>
    </tr>
<%
  while(it.hasNext()){
    BorrowForm borrowForm=(BorrowForm)it.next();
	bookname=borrowForm.getBookName();
        barcode_book=borrowForm.getBookBarcode();
        typename=borrowForm.getBookType();
	degree=borrowForm.getDegree();
	bookcase=borrowForm.getBookcaseName();
        pub=borrowForm.getPubName();
        author=borrowForm.getAuthor();
        price=borrowForm.getPrice();
	%>
  <tr>
    <td class="STYLE2" bgcolor="#333333" align="center">&nbsp;<%=degree%></td>
    <td class="STYLE2" bgcolor="#333333" style="padding:5px;">&nbsp;<%=barcode_book%></td>
    <td class="STYLE2" bgcolor="#333333" style="padding:5px;"><%=bookname%></td>
    <td class="STYLE2" bgcolor="#333333" style="padding:5px;"><%=typename%></td>
    <td class="STYLE2" bgcolor="#333333" align="center">&nbsp;<%=pub%></td>
    <td class="STYLE2" bgcolor="#333333" width="11%" align="center"><%=author%></td>
    <td class="STYLE2" bgcolor="#333333" width="8%" align="center"><%=price%></td>
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
