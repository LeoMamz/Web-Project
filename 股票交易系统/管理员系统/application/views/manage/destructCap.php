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
                                <h3>Capital Account Management - Destruct Account</h3>
                            </div>
                            <div class="module-body">

                                    <br />

                                    <form class="form-horizontal row-fluid" method="post">

                                        <div class="control-group">
                                            <label class="control-label" for="id">资金账户账号</label>
                                            <div class="controls">
                                                <input type="text" id="id" placeholder="Type something here..." class="span8">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit_Cap" class="btn" id="submit_Cap">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
                    <div id="dialog_Cap" title="Please confirm the contents of the form">
                      <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>这是我们接收到的数据！如果确认无误请点击Confirm</p>
                      <ul>
                          <li id="sec_id_con"><label id="sec_id_l" for="sec_id_b">证券账户:</label><b id="sec_id_b"></b></li>
                          <li id="id_con"><label id="id_l" for="id_b">ID. Number:</label><b id="id_b"></b></li>
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
        <script src="<?php echo base_url() ?>/static/js/destruct.js" type="text/javascript"></script>
      
    </body>
