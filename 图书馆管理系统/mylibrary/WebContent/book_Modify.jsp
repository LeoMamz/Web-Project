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
	out.println("<script>alert('请先录入图书类型信息!');history.back(-1);</script>");
}else{
	  Iterator it_type=coll_type.iterator();
	  int typeID=0;
	  String typename1="";
	  BookCaseDAO bookcaseDAO=new BookCaseDAO();
	  String str1=null;
	  Collection coll_bookcase=(Collection)bookcaseDAO.query(str1);
	  if(coll_bookcase==null || coll_bookcase.isEmpty()){
	  	out.println("<script>alert('请先录入书架信息!');history.back(-1);</script>");
	  }else{
	  	Iterator it_bookcase=coll_bookcase.iterator();
	  	int bookcaseID=0;
	  	String bookcasename="";
	  PublishingDAO pubDAO=new PublishingDAO();
	  String str2=null;
	  Collection coll_pub=(Collection)pubDAO.query(str2);
	  if(coll_pub==null || coll_pub.isEmpty()){
	  	out.println("<script>alert('请先录入出版社信息!');history.back(-1);</script>");
	  }else{	
	  	Iterator it_pub=coll_pub.iterator();
	  	String isbn="";
	  	String pubname="";	 
		BookForm bookForm=(BookForm)request.getAttribute("bookQueryif"); 	
%>
<script language="jscript">
function check(form){
	if(form.barcode.value==""){
		alert("请输入条形码!");form.barcode.focus();return false;
	}
	if(form.bookName.value==""){
		alert("请输入图书姓名!");form.bookName.focus();return false;
	}
	if(form.price.value==""){
		alert("请输入图书定价!");form.price.focus();return false;
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
	font-size: 12pt;
	font-weight: bold;
}
.STYLE21 {
	font-size: 10pt;
	color: #DC143C;
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
    <td valign="top" bgcolor="#333333"><table width="99%" height="510" background="Images/AF11.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tableBorder_gray">
  <tr>
    <td height="510" valign="top" style="padding:5px;"><table width="98%" height="487"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" valign="top" class="STYLE6">当前位置：图书管理-&gt; 图书档案管理-&gt; 修改图书信息-&gt;&gt;&gt;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><table width="70%" height="493"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top">
	<form name="form1" method="post" action="book.do?action=bookModify">
<%	int ID=bookForm.getId().intValue();
	String bookname=bookForm.getBookName();
	String barcode=bookForm.getBarcode();
	if(barcode==null) barcode="";
	int TypeId=bookForm.getTypeId();
	String typename=bookForm.getTypeName();
	String author=bookForm.getAuthor();
	String translator=bookForm.getTranslator();	
	String ISBN=bookForm.getIsbn();
	String publishing=bookForm.getPublishing();
	Float price=bookForm.getPrice();
	int pages=bookForm.getPage();
	int bookcaseid=bookForm.getBookcaseid();
	String bookcase=bookForm.getBookcaseName();	
	String inTime=bookForm.getInTime();
	String operator=bookForm.getOperator();
	int total=bookForm.getTotal();
	int stock=bookForm.getStock();
  %>
      <tr>
        <td width="173" align="center"><input name="id" type="hidden" id="id" value="<%=ID%>">
          <div align="left" class="STYLE11">图数编号：</div></td>
        <td width="427" height="39">
          <input name="barcode" type="text" id="barcode" value="<%=barcode%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">图书名称：</div></td>
        <td height="39"><input name="bookName" type="text" id="bookName" value="<%=bookname%>" size="60">
          * </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">图书类型：</div></td>
        <td>
		<select name="typeId" class="wenbenkuang" id="typeId">
<%
  while(it_type.hasNext()){
    BookTypeForm bookTypeForm=(BookTypeForm)it_type.next();
	typeID=bookTypeForm.getId().intValue();
	typename1=bookTypeForm.getTypeName();
	%> 		
				
          <option value="<%=typeID%>" <%if(TypeId==typeID) out.println("selected");%>><%=typename1%></option>
<%}%> 
        </select>        </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">作&nbsp;&nbsp;者：</div></td>
        <td><input name="author" type="text" id="author" value="<%=author%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">译&nbsp;&nbsp;者：</div></td>
        <td><input name="translator" type="text" id="translator" value="<%=translator%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">出版社：</div></td>
        <td><select name="isbn" class="wenbenkuang">
<%
  while(it_pub.hasNext()){
    PublishingForm pubForm=(PublishingForm)it_pub.next();
	isbn=pubForm.getIsbn();
	pubname=pubForm.getPubname();
	%> 		
				
          <option value="<%=isbn%>" <%if(isbn.equals(ISBN)) out.println("selected");%>><%=pubname%></option>
<%}%> 
        </select> </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">价&nbsp;&nbsp;格：</div></td>
        <td><input name="price" type="text" id="price" value="<%=price%>"> 
          (元) * </td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">页&nbsp;&nbsp;码：</div></td>
        <td><input name="page" type="text" id="page" value="<%=pages%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">藏&nbsp;书&nbsp;量：</div></td>
        <td><input name="total" type="number" id="total" value="<%=total%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">库&nbsp;&nbsp;存：</div></td>
        <td><input name="stock" type="number" id="stock" value="<%=stock%>"></td>
      </tr>
      <tr>
        <td align="center"><div align="left" class="STYLE11">书&nbsp;&nbsp;架：</div></td>
        <td><select name="bookcaseid" class="wenbenkuang" id="bookcaseid">
<%
  while(it_bookcase.hasNext()){
    BookCaseForm bookCaseForm=(BookCaseForm)it_bookcase.next();
	bookcaseID=bookCaseForm.getId().intValue();
	bookcasename=bookCaseForm.getName();
	%> 		
				
          <option value="<%=bookcaseID%>" <%if(bookcaseid==bookcaseID) out.println("selected");%>><%=bookcasename%></option>
<%}%> 
        </select>
          <input name="operator" type="hidden" id="operator" value="<%=manager%>"></td>
      </tr>
     
      <tr>
        <td align="center">&nbsp;</td>
        <td><input name="Submit" type="submit" class="btn_grey" value="保存" onClick="return check(form1)">
&nbsp;
<input name="Submit2" type="button" class="btn_grey" value="返回" onClick="history.back()"></td>
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
