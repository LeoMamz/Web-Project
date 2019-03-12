<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.BorrowDAO" %>
<%@ page import="com.actionForm.BorrowForm" %>
<%@ page import="com.actionForm.ReaderForm" %>
<%@ page import="java.util.*"%>
<html>
<%
ReaderForm readerForm=(ReaderForm)request.getAttribute("readerinfo");
Collection coll=(Collection)request.getAttribute("borrowinfo");
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
				alert("请输入读者条形码!");form.barcode.focus();return;
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
    <td height="27" valign="top" style="padding:5px;" class="STYLE6">&nbsp;当前位置：图书借还-&gt; 图书续借-&gt;&gt;&gt;</td>
  </tr>
  <tr>
    <td align="center" valign="top" style="padding:5px;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="72" align="center" valign="top" bgcolor="#333333"><table width="96%" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
          <tr>
            <td valign="top" bgcolor="#F8BF73"><%
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
				<form name="form1" method="post" action="borrow.do?action=bookrenew">
				
                  <tr>
                    <td><table width="90%" height="21" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="24%" height="18" style="padding-left:7px;padding-top:7px;"><div align="center" class="STYLE3">输入借书证号自动寻找</div></td>
                          <td width="76%" style="padding-top:7px;" class="STYLE4">借书证号(bno)：
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
                    <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="27" class="STYLE4" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;名：
                            <input name="readername" type="text" id="readername" value="<%=name%>"></td>
                          <td class="STYLE4" align="left">性&nbsp;&nbsp;&nbsp;&nbsp;别：
                            <input name="sex" type="text" id="sex" value="<%=sex%>"></td>
                          <td class="STYLE4" align="left">读者类型：
                            <input name="readerType" type="text" id="readerType" value="<%=typename%>"></td>
                        </tr>
                        <tr>
                          <td height="27" class="STYLE4" align="left">证件类型：
                            <input name="paperType" type="text" id="paperType" value="<%=paperType%>"></td>
                          <td align="left" class="STYLE4">证件号码：
                            <input name="paperNo" type="text" id="paperNo" value="<%=paperNO%>"></td>
                          <td class="STYLE4" align="left">可借数量：
                            <input name="number" type="text" id="number" value="<%=number%>" size="17">
                            册
                            &nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
				 </form>
              </table></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" height="35" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFB6C1" bgcolor="#FFFFFF">
                <tr align="center" bgcolor="#e3F4F7">
                  <td width="20%" height="25" bgcolor="#333333" class="STYLE1">图书名称</td>
                  <td width="15%" bgcolor="#333333" class="STYLE1">借阅时间</td>
                  <td width="15%" bgcolor="#333333" class="STYLE1">应还时间</td>
                  <td width="15%" bgcolor="#333333" class="STYLE1">出版社</td>
                  <td width="10%" bgcolor="#333333" class="STYLE1">作者</td>
                  <td bgcolor="#333333" class="STYLE1">定价/元</td>
                  <td width="12%" bgcolor="#FFFFFF"><input name="Button22" type="button" class="btn_grey" value="完成续借" onClick="window.location.href='bookRenew.jsp'"></td>
                </tr>
<%
int id=0;
String bookname="";
String borrowTime="";
String backTime="";
Float price=new Float(0);
String pubname="";
String author="";
if(coll!=null && !coll.isEmpty()){
	Iterator it=coll.iterator();
	while(it.hasNext()){
	BorrowForm borrowForm=(BorrowForm)it.next();
        id=borrowForm.getId().intValue();
	bookname=borrowForm.getBookName();
	borrowTime=borrowForm.getBorrowTime();
	backTime=borrowForm.getBackTime();
	price=borrowForm.getPrice();
	pubname=borrowForm.getPubName();
	author=borrowForm.getAuthor();
%>
                   <tr>
                     <td bgcolor="#333333" class="STYLE5" height="25" style="padding:5px;">&nbsp;<%=bookname%></td>
                     <td bgcolor="#333333" class="STYLE5" style="padding:5px;">&nbsp;<%=borrowTime%></td>
                     <td bgcolor="#333333" class="STYLE5" style="padding:5px;">&nbsp;<%=backTime%></td>
                     <td bgcolor="#333333" class="STYLE5" align="center">&nbsp;<%=pubname%></td>
                     <td bgcolor="#333333" class="STYLE5" align="center">&nbsp;<%=author%></td>
                     <td bgcolor="#333333" class="STYLE5" width="13%" align="center">&nbsp;<%=price%></td>
                     <td bgcolor="#333333" class="STYLE5" width="12%" align="center"><a href="borrow.do?action=bookrenew&barcode=<%=barcode%>&id=<%=id%>">续借</a>&nbsp;</td>
                   </tr>
                <%	}
}%>
            </table>
			</td>
          </tr>
		 
        </table></td>
      </tr>
      <tr>
        <td height="19" >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
    <%@ include file="copyright.jsp"%></td>
  </tr>
</table>
</body>
</html>
