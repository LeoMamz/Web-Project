<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BookDAO" %>
<%@ page import="com.actionForm.BookForm" %>
<%@ page import="java.util.*"%>
<html>
<%
Collection coll=(Collection)request.getAttribute("ifbook");
%>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE1 {
	font-size: 13pt;
	font-weight: bold;
	color: #FFFFFF;
}
.STYLE2 {
	font-size: 10pt;
	color: #FFFFFF;
}
.STYLE3 {
	font-size: 10pt;
	color: #DC143C;
	font-weight: bold;
}
.STYLE4 {
	font-size: 13pt;
	font-weight: bold;
	color: #333333;
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
    <td valign="top" bgcolor="#FFFFFF"><table width="99%" height="510" background="Images/AF13.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFC" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：系统查询-&gt; 图书档案查询-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top">
	<form action="" method="post" name="form1">  
 <table width="98%" height="38"  border="0" cellpadding="0" cellspacing="0" bgcolor="#E3F4F7" class="tableBorder_gray">
  <tr>
    
    <td class="STYLE1" bgcolor="#333333">请选择查询依据：
      <select name="f" class="wenbenkuang" id="f">
        <option value="barcode">编号</option>
        <option value="typename">类别</option>
        <option value="bookname" selected>书名</option>
        <option value="author">作者</option>
        <option value="publishing">出版社</option>
        <option value="bookcasename">书架</option>
                  </select>
      <input name="key" type="text" id="key" size="50">
      <input name="Submit" type="submit" class="btn_grey" value="查询"></td>
  </tr>
</table>
<%
if(coll==null || coll.isEmpty()){
%>
          <table width="100%" height="30"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="36" align="center">暂无图书信息！</td>
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
  String author="";
  int storage=0;
  %>  
  <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#F6B83B" bordercolorlight="#FFFFFF">
  <tr align="center" bgcolor="#e3F4F7">
    <td class="STYLE1" width="20%" bgcolor="#333333">图书编号(bno)</td>  
    <td class="STYLE1" width="20%" bgcolor="#333333">图书名称</td>
    <td class="STYLE1" width="13%" bgcolor="#333333">图书类型</td>
    <td class="STYLE1" width="17%" bgcolor="#333333">出版社</td>
    <td class="STYLE1" width="12%" bgcolor="#333333">作者</td>
    <td class="STYLE1" width="10%" bgcolor="#333333">藏书量</td>
    <td class="STYLE1" width="10%" bgcolor="#333333">库存</td>
    </tr>
<%
  while(it.hasNext()){
    BookForm bookForm=(BookForm)it.next();
	ID=bookForm.getId().intValue();
	bookname=bookForm.getBookName();
	barcode=bookForm.getBarcode();
	if(barcode==null) barcode="";
	typename=bookForm.getTypeName();
	publishing=bookForm.getPublishing();
	author=bookForm.getAuthor();
	total=bookForm.getTotal();
	stock=bookForm.getStock();
	%> 
  <tr>
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=barcode%></td>  
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;"><a href="book.do?action=bookDetail&ID=<%=ID%>"><%=bookname%></a></td>
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=typename%></td>  
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=publishing%></td>  
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=author%></td>  
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=total%></td> 
    <td class="STYLE5" bgcolor="#333333" style="padding:5px;">&nbsp;<%=stock%></td> 
    </tr>
<%
  }
}
%>  
</table>
	</form>
</td>
      </tr>
    </table>
</td>
  </tr>
</table><%@ include file="copyright.jsp"%></td>
  </tr>
</table>
</body>
</html>
