<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BorrowDAO" %>
<%@ page import="com.actionForm.BorrowForm" %>
<%@ page import="com.actionForm.BookForm" %>
<%@ page import="com.actionForm.ReaderForm" %>
<%@ page import="java.util.*"%>
<html>
<%
ReaderForm readerForm=(ReaderForm)request.getAttribute("readerinfo");
Collection coll=(Collection)request.getAttribute("borrowinfo");
int borrowNumber=0;
%>
<head>
<title>图书馆管理系统</title>
<link href="CSS/style.css" rel="stylesheet">
<style type="text/css">
<!--
.STYLE11 {
	font-size: 13pt;
	font-weight: bold;
	color: #FFFFFA;
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
		<script language="javascript">
		function checkreader(form){
			if(form.barcode.value==""){
				alert("请输入借书证号!");form.barcode.focus();return;
			}
			form.submit();
		}
		function checkbook(form){
			if(form.barcode.value==""){
				alert("请输入借书证号!");form.barcode.focus();return;
			}		
			if(form.inputkey.value==""){
				alert("请输入要查询关键字!");form.inputkey.focus();return;
			}

			if(form.number.value-form.borrowNumber.value<=0){
				alert("您借阅的书籍已达上限，不能再借阅其他图书了!");return;
			}
			
			form.submit();
		}
		</script>
</head>
<body onLoad="clockon(bgclock)">
<%@include file="banner.jsp"%>
<%@include file="navigation.jsp"%>
<table width="778"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="100%" height="509" background="Images/AF13.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="27" valign="top" style="padding:5px;" class="STYLE6">当前位置：图书借还-&gt; 图书借阅-&gt;&gt;&gt;</td>
  </tr>
  <tr>
    <td align="center" valign="top" style="padding:5px;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<form name="form1" method="post" action="borrow.do?action=bookborrow">
	
      <tr>
        <td height="72" align="center" valign="top" bgcolor="#333333"><table width="96%" border="0" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#333333">
          <tr>
            <td valign="top" bgcolor="#FFFFF0"><%
int ID=0;
String name="";
String sex="";
String barcode="";
String birthday="";
String paperType="";
String paperNO="";
int number=0;
String typename="";
if(readerForm!=null){
	ID=readerForm.getId().intValue();
	name=readerForm.getName();
	sex=readerForm.getSex();
	barcode=readerForm.getBarcode();
	birthday=readerForm.getBirthday();
	paperType=readerForm.getPaperType();
	paperNO=readerForm.getPaperNO();
	number=readerForm.getNumber();
	typename=readerForm.getTypename();
}
%>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
                
				
                  <tr>
                    <td><table width="90%" height="21" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="30%" height="18" style="padding-left:7px;padding-top:7px;"><div align="center" class="STYLE21">输入借书证号自动寻找</div></td>
                          <td width="70%" style="padding-top:7px;"><div align="left" class="STYLE11">借书证号：</div>
                            <input name="barcode" type="text" id="barcode" value="<%=barcode%>" size="24">
                            &nbsp;
                            <input name="Button" type="button" class="btn_grey" value="确定" onClick="checkreader(form1)"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="13" align="left" style="padding-left:7px;"><hr width="90%" size="1"></td>
                    </tr>
                  <tr>
                    <td align="center"><table width="96%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="27"><div align="left" class="STYLE11">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</div>
                            <input name="readername" type="text" id="readername" value="<%=name%>"></td>
                          <td><div align="left" class="STYLE11">性&nbsp;&nbsp;&nbsp;&nbsp;别：</div>
                            <input name="sex" type="text" id="sex" value="<%=sex%>"></td>
                          <td><div align="left" class="STYLE11">读者类型：</div>
                            <input name="readerType" type="text" id="readerType" value="<%=typename%>"></td>
                        </tr>
                        <tr>
                          <td height="27"><div align="left" class="STYLE11">证件类型：</div>
                            <input name="paperType" type="text" id="paperType" value="<%=paperType%>"></td>
                          <td><div align="left" class="STYLE11">证件号码：</div>
                            <input name="paperNo" type="text" id="paperNo" value="<%=paperNO%>"></td>
                          <td class="STYLE11"><div align="left" class="STYLE11">可借数量：</div>
                            <input name="number" type="text" id="number" value="<%=number%>" size="17">
                            册
                            &nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
				 
              </table></td>
          </tr>
               <tr>
                 <td height="32" >&nbsp;<span class="STYLE11">搜索书籍</span>：
                   <input name="f" type="radio" class="noborder" value="barcode" checked>
                   <span class="STYLE21">图书编号</span> &nbsp;&nbsp;
                   <input name="f" type="radio" class="noborder" value="bookname">
<span class="STYLE21">图书名称</span>&nbsp;&nbsp;
<input name="inputkey" type="text" id="inputkey" size="50">
                   <input name="Submit2" type="button" class="btn_grey" value="确定" onClick="checkbook(form1)">
                   <input name="operator" type="hidden" id="operator" value="<%=manager%>">
 
                   </td>
               </tr> 
          <tr>
            <td valign="top"><table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFB6C1" bgcolor="#FFFFFF">
                   <tr align="center" bgcolor="#333333">
                     <td width="27%" height="40"><span class="STYLE1">图书名称</span></td>
                     <td width="18%" ><span class="STYLE1">借阅时间</span></td>
                     <td width="18%"><span class="STYLE1" >应还时间</span></td>
                     <td width="24%"><span class="STYLE1">出版社</span></td>
                     <td width="12%"><span class="STYLE1">价格/元</span></td>
                     
                   </tr>
<%
String bookname="";
String borrowTime="";
String backTime="";
Float price=new Float(0);
String pubname="";
String author="";
String bookID="";

int borrowN=0;
if(coll!=null && !coll.isEmpty()){
	borrowNumber=coll.size();
	Iterator it=coll.iterator();
	
	while(it.hasNext()){
	BorrowForm borrowForm=(BorrowForm)it.next();
	bookname=borrowForm.getBookName();
	borrowTime=borrowForm.getBorrowTime();
	backTime=borrowForm.getBackTime();
	price=borrowForm.getPrice();
	pubname=borrowForm.getPubName();
	author=borrowForm.getAuthor();
	bookID=borrowForm.getBookBarcode();
	
	borrowN=borrowN+1;
%>
                   <tr bgcolor="#333333">
                     <td class="STYLE5" align="center" height="25" style="padding:5px;">&nbsp;<%=bookname%></td>
                     <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=borrowTime%></td>
                     <td class="STYLE5" align="center" style="padding:5px;">&nbsp;<%=backTime%></td>
                     <td class="STYLE5" align="center">&nbsp;<%=pubname%></td>
                     <td class="STYLE5" align="center">&nbsp;<%=price%></td>
                     
                   </tr>
<%	}
}%>
 <input name="borrowN" type="hidden" id="borrowN" value="<%=borrowN%>">
 <input name="borrowNumber" type="hidden" id="borrowNumber" value="<%=borrowNumber%>">
                 </table>
			</td>
          </tr>
		 
        </table></td>
		 
      </tr>
      
	 </form>
    </table></td>
  </tr>
</table>
    <%@ include file="copyright.jsp"%></td>
  </tr>
</table>
</body>
</html>