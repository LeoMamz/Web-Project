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
	<script language="javascript">
		function checkreader(form){
			if(form.barcode.value==""){
				alert("请输入借书证号(cno)!");form.barcode.focus();return;
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
    <td valign="top" bgcolor="#FFFFFF"><table width="100%" height="558" background="Images/AF13.png" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFA" class="tableBorder_gray">
  <tr>
    <td height="27" valign="top" style="padding:5px;" class="STYLE6">&nbsp;当前位置：图书借还-&gt; 图书归还-&gt;&gt;&gt;</td>
  </tr>
  <tr>
    <td align="center" valign="top" style="padding:5px;"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
     
      <tr>
        <td height="72" align="center" valign="top" bgcolor="#333333"><table width="96%" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
          <tr>
            <td valign="top" bgcolor="#FFFFFA"><%
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
				<form name="form1" method="post" action="borrow.do?action=bookback">
				
                  <tr>
                    <td><table width="90%" height="21" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="30%" height="18" style="padding-left:7px;padding-top:7px;"><div align="center" class="STYLE21">输入借书证号验证身份</div></td>
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
				 </form>
              </table></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" height="35" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFB6C1" bgcolor="#FFFFFF">
                <tr align="center" bgcolor="#333333">
                  <td width="24%" height="25" class="STYLE1">图书名称</td>
                  <td width="15%" class="STYLE1">借阅时间</td>
                  <td width="15%" class="STYLE1">应还时间</td>
                  <td width="18%" class="STYLE1">出版社</td>
                  <td class="STYLE1">定价/元</td>
                  <td bgcolor="#FFFFFF" width="12%" ><input name="Button22" type="button" class="btn_grey" value="完成归还" onClick="window.location.href='bookBack.jsp'"></td>
                </tr>
                <%
int id=0;
String bookname="";
String borrowTime="";
String backTime="";
Float price=new Float(0);
String pubname="";
String bookcase="";
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
	bookcase=borrowForm.getBookcaseName();
%>
                <tr bgcolor="#333333">
                  <td class="STYLE5" height="25" style="padding:5px;">&nbsp;<%=bookname%></td>
                  <td class="STYLE5" style="padding:5px;">&nbsp;<%=borrowTime%></td>
                  <td class="STYLE5" style="padding:5px;">&nbsp;<%=backTime%></td>
                  <td class="STYLE5" align="center">&nbsp;<%=pubname%></td>
                  <td class="STYLE5" width="13%" align="center">&nbsp;<%=price%></td>
                  <td class="STYLE5" width="12%" align="center"><a href="borrow.do?action=bookback&barcode=<%=barcode%>&id=<%=id%>&operator=<%=manager%>">归还</a>&nbsp;</td>
                </tr>
                <%	}
}%>
            </table>
			</td>
          </tr>
		 
        </table></td>
      </tr>
     
    </table></td>
  </tr>
</table>
    <%@ include file="copyright.jsp"%></td>
  </tr>
</table>
</body>
</html>
