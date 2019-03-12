<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration</title>
        <link type="text/css" href="<?php echo base_url() ?>/static/bootstrap_sec/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>/static/bootstrap_sec/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>/static/css/theme.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>/static/images/icons/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url() ?>/static/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>/static/css/jquery-ui.min.css">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url() ?>/static/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="static/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="static/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="static/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="static/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="Manage">Administration </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        
                        
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url() ?>/static/images/user.png" class="nav-avatar" />
                                <span class="nav-avatar"><?php echo $user['name']; ?></span>
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url() ?>/Logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="<?php echo base_url() ?>/Manage"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i>Securities Account Management</a>
                                    <ul class="unstyled">
                                        <li><a href="<?php echo base_url() ?>/Create/security/natual"><i class="icon-magic"></i>Create</a></li>
                                        <li><a href="<?php echo base_url() ?>/Report/security/natual"><i class="icon-pushpin"></i>Report Loss</a></li>
                                        <li><a href="<?php echo base_url() ?>/Replace/Security/natual"><i class="icon-random"></i>Replacement</a></li>
                                        <li><a href="<?php echo base_url() ?>/Destruct/Security/natual"><i class="icon-inbox"></i>Destruct</a></li>
                                    </ul>
                                </li>
                                    
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-cog">
                                </i>Capital Account Management</a>
                                    <ul class="unstyled">
                                        <li><a href="<?php echo base_url() ?>/Create/capital"><i class="icon-magic"></i>Create</a></li>
                                        <li><a href="<?php echo base_url() ?>/Report/capital"><i class="icon-pushpin"></i>Report Loss</a></li>
                                        <li><a href="<?php echo base_url() ?>/Replace/capital"><i class="icon-random"></i>Replacement</a></li>
                                        <li><a href="<?php echo base_url() ?>/Destruct/capital"><i class="icon-inbox"></i>Destruct</a></li>
                                        <li><a href="<?php echo base_url() ?>/Manage/capital"><i class="icon-money"></i>Capital Management</a></li>
                                        <li><a href="<?php echo base_url() ?>/Manage/password"><i class="icon-wrench"></i>Change password</a></li>
                                    </ul>
                                </li>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            
                            <ul class="widget widget-menu unstyled">
                                
                                <li><a href="<?php echo base_url() ?>/Logout"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9" id="form1">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Securities Account Management - Open Account</h3>
                            </div>
                            <div class="module-body">

                                    <br />

                                    <form class="form-horizontal row-fluid" method="post">

                                        <div class="control-group">
                                            <label class="control-label">Account Type</label>
                                            <div class="controls">
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="Natural Person" checked="checked">
                                                    Natural Person
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="Legal person">
                                                    Legal person
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Name</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Sex</label>
                                            <div class="controls">
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios1" id="optionsRadios3" value="♀" checked="">
                                                    ♀
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios1" id="optionsRadios4" value="♂">
                                                    ♂
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput2">ID. Number</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput2" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput3">Address</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput3" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput4">Job</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput4" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput5">Education</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput5" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput6">Company/Organization</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput6" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput7">Tel</label>
                                            <div class="controls">
                                                <input type="text" id="basicinput7" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Proxy</label>
                                            <div class="controls">
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios2" id="optionsRadios5" value="No" checked="">
                                                    No
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="optionsRadios2" id="optionsRadios6" value="Yes">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn" id="submit1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
                    <div id="dialog_Sec1" title="Please confirm the contents of the form">
                      <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>这是我们接收到的数据！如果确认无误请点击Confirm</p>
                      <ul>
                          <li id="sec_id_con"><label id="sec_id_l" for="sec_id_b">Account Type:</label><b id="sec_id_b"></b></li>
                          <li id="id_con1"><label id="id_l1" for="id_1">Name:</label><b id="id_1"></b></li>
                          <li id="id_con2"><label id="id_l2" for="id_2">Sex:</label><b id="id_2"></b></li>
                          <li id="id_con3"><label id="id_l3" for="id_3">ID. Number:</label><b id="id_3"></b></li>
                          <li id="id_con4"><label id="id_l4" for="id_4">Address:</label><b id="id_4"></b></li>
                          <li id="id_con5"><label id="id_l5" for="id_5">Job:</label><b id="id_5"></b></li>
                          <li id="id_con6"><label id="id_l6" for="id_6">Education:</label><b id="id_6"></b></li>
                          <li id="id_con7"><label id="id_l7" for="id_7">Company/Organization:</label><b id="id_7"></b></li>
                          <li id="id_con8"><label id="id_l8" for="id_8">Tel:</label><b id="id_8"></b></li>
                          <li id="id_con9"><label id="id_l9" for="id_9">Proxy:</label><b id="id_9"></b></li>
                          <li id="id_con10"><label id="id_l10" for="id_10">Proxy ID. Number:</label><b id="id_10"></b></li>
                      </ul>
                    </div>
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2018 Adiministration </b>All rights reserved.
            </div>
        </div>
        <script src="<?php echo base_url() ?>/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>/static/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>/static/bootstrap_sec/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>/static/js/createAcc.js" type="text/javascript"></script>
      
    </body>
