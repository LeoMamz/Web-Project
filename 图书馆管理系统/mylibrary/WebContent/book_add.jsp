<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BookDAO" %>
<%@ page import="com.dao.BookTypeDAO" %>
<%@ page import="com.actionForm.BookForm" %>
<%@ page import="com.actionForm.BookTypeForm"%>
<%@ page import="com.dao.BookCaseDAO" %>
<%@ page import="com.actionForm.BookCaseForm" %>
<%@ page import="com.dao.PublishingDAO" %>
<%@ page import="com.actionForm.PublishingForm" %>
<%@ page import="java.util.*"%>
<html>
<%
String str=null;
BookTypeDAO bookTypeDAO=new BookTypeDAO();
Collection coll_type=(Collection)bookTypeDAO.query(str);
if(coll_type==null || coll_type.isEmpty()){
	out.println("<script>alert('请先输入图书类型信息(type)!');history.back(-1);</script>");
}else{
	  Iterator it_type=coll_type.iterator();
	  int typeID=0;
	  String typename="";
	  BookCaseDAO bookcaseDAO=new BookCaseDAO();
	  String str1=null;
	  Collection coll_bookcase=(Collection)bookcaseDAO.query(str1);
	  if(coll_bookcase==null || coll_bookcase.isEmpty()){
	  	out.println("<script>alert('请先输入书架信息(bookshelt)!');history.back(-1);</script>");
	  }else{
	  	Iterator it_bookcase=coll_bookcase.iterator();
	  	int bookcaseID=0;
	  	String bookcasename="";
	  PublishingDAO pubDAO=new PublishingDAO();
	  String str2=null;
	  Collection coll_pub=(Collection)pubDAO.query(str2);
	  if(coll_pub==null || coll_pub.isEmpty()){
	  	out.println("<script>alert('请先输入出版社信息(press)!');history.back(-1);</script>");
	  }else{	
	  	Iterator it_pub=coll_pub.iterator();
	  	String isbn="";
	  	String pubname="";	  	
%>
<script language="jscript">
function check(form){
	if(form.barcode.value==""){
		alert("请输入图数编号(bno)!");form.barcode.focus();return false;
	}
	if(form.bookName.value==""){
		alert("请输入图书名称(name)!");form.bookName.focus();return false;
	}
	if(form.price.value==""){
		alert("请输入图书价格(price)!");form.price.focus();return false;
	}
}
</script>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE11 {
color: #FFFFFA;
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
<table width="778"  border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td valign="top" bgcolor="#333333"><table width="99%" height="510" background="Images/AF11.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：图书管理-&gt; 图书档案管理-&gt; 添加图书信息-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><table width="65%" height="493"  border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolordark="#D2E3E6" bordercolorlight="#FFFFFF">
  <tr>
    <td align="center" valign="top">
	<form name="form1" method="post" action="book.do?action=bookAdd">
	
      <tr>
        <td width="173" align="center"><div align="left" class="STYLE11">图数编号(bno)：</div></td>
        <td width="427" height="39">
          <input name="barcode" type="text" id="barcode">
          *</td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">图书名称(name)：</div></td>
        <td height="39"><input name="bookName" type="text" id="bookName" size="50">
          * </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">图书类型(type)：</div></td>
        <td>
		<select name="typeId" class="wenbenkuang" id="typeId">
<%
  while(it_type.hasNext()){
    BookTypeForm bookTypeForm=(BookTypeForm)it_type.next();
	typeID=bookTypeForm.getId().intValue();
	typename=bookTypeForm.getTypeName();
	%> 		
				
          <option value="<%=typeID%>"><%=typename%></option>
<%}%> 
        </select>        </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">作&nbsp;&nbsp;者(author)：</div></td>
        <td><input name="author" type="text" id="author" size="40"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">译&nbsp;&nbsp;者(translator)：</div></td>
        <td><input name="translator" type="text" id="translator" size="40"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">出版社(press)：</div></td>
        <td><select name="isbn" class="wenbenkuang">
<%
  while(it_pub.hasNext()){
    PublishingForm pubForm=(PublishingForm)it_pub.next();
	isbn=pubForm.getIsbn();
	pubname=pubForm.getPubname();
	%> 		
				
          <option value="<%=isbn%>"><%=pubname%></option>
<%}%> 
        </select> </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">价&nbsp;&nbsp;格(price)：</div></td>
        <td><input name="price" type="text" id="price"> 
          (元) * </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">页&nbsp;&nbsp;码(page)：</div></td>
        <td><input name="page" type="text" id="page"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">藏&nbsp;书&nbsp;量：</div></td>
        <td><input name="total" type="number" id="total"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">库&nbsp;&nbsp;存：</div></td>
        <td><input name="stock" type="number" id="stock"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">书&nbsp;&nbsp;架(bookshelf)：</div></td>
        <td><select name="bookcaseid" class="wenbenkuang" id="bookcaseid">
        
<%
  while(it_bookcase.hasNext()){
    BookCaseForm bookCaseForm=(BookCaseForm)it_bookcase.next();
	bookcaseID=bookCaseForm.getId().intValue();
	bookcasename=bookCaseForm.getName();
	%> 		
				
          <option value="<%=bookcaseID%>"><%=bookcasename%></option>
<%}%> 
        </select>
          <input name="operator" type="hidden" id="operator" value="<%=manager%>"></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><p class="STYLE21">(带有标记符号*的为必填栏目！)</p>
        
        <p>
        <input name="Submit" type="submit" class="btn_grey" value="保存" onClick="return check(form1)">
&nbsp;
<input name="Submit2" type="button" class="btn_grey" value="返回" onClick="history.back()">
</p></td>
      </tr>
   
	</form>
	</td>
  </tr>
</table></td>
      </tr>
    </table>
</td>
  </tr>
</table><%@ include file="copyright.jsp"%></td>
  </tr>
</table>
<%}
}
}%>
</body>
</html>
