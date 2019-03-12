<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" errorPage="" %>
<%@ page import="com.dao.ManagerDAO"%>
<%@ page import="com.actionForm.ManagerForm"%>
<%
ManagerDAO managerDAO=new ManagerDAO();
ManagerForm form1=(ManagerForm)managerDAO.query_p(manager);
int sysset1=0;
int readerset1=0;
int bookset1=0;
int borrowback1=0;
int sysquery1=0;
if(form1!=null){
	sysset1=form1.getSysset();
	readerset1=form1.getReaderset();
	bookset1=form1.getBookset();
	borrowback1=form1.getBorrowback();
	sysquery1=form1.getSysquery();
}

%>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="JS/onclock.JS" charset="gbk"></script>
<script src="JS/menu.JS" charset="gbk"></script>
<style type="text/css">
<!--
.STYLE11 {
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
-->
</style>
<div class=menuskin id=popmenu
      onmouseover="clearhidemenu();highlightmenu(event,'on')"
      onmouseout="highlightmenu(event,'off');dynamichide(event)" style="Z-index:100;position:absolute;"></div>
<table width="778"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr bgcolor="#333333">
        <td width="3%" height="35">&nbsp;</td>
		<script language="javascript">
			function quit(){
				if(confirm("真的要退出系统吗?")){
					window.location.href="logout.jsp";
				}
			}
		</script>
        <td width="95%" align="right" bgcolor="#333333" class="word_white"><a href="main.jsp" class="btn_grey">首页</a> |
        <%if(sysset1==1){%><a  onmouseover=showmenu(event,sysmenu) onmouseout=delayhidemenu() class="btn_grey" style="cursor:pointer" >账号管理</a> | <%}%><%if(bookset1==1){%><a  onmouseover=showmenu(event,bookmenu) onmouseout=delayhidemenu() class="btn_grey" style="CURSOR:hand" >书籍管理</a> | <%}%><%if(readerset1==1){%><a  onmouseover=showmenu(event,readermenu) onmouseout=delayhidemenu() style="CURSOR:hand"  class="btn_grey">借书人管理</a> | <%}%><%if(borrowback1==1){%><a  onmouseover=showmenu(event,borrowmenu) onmouseout=delayhidemenu() class="btn_grey" style="CURSOR:hand">借还与续借</a> | <%}%><%if(sysquery1==1){%><a  onmouseover=showmenu(event,querymenu) onmouseout=delayhidemenu()  class="btn_grey" style="CURSOR:hand" >基本查询</a> | <%}%><a  href="manager.do?action=querypwd" class="btn_grey">修改密码</a> | <a href="#" onClick="quit()" class="btn_grey">退出登录</a></td>
        <td width="2%" bgcolor="#333333">&nbsp;</td>
  </tr>
      <tr bgcolor="#333333">
        <td height="9" colspan="4" background="Images/navigation_bg_bottom.gif"></td>
      </tr>
</table>
