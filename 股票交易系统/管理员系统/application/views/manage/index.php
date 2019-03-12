<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration</title>
        <link type="text/css" href="static/bootstrap_sec/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="static/bootstrap_sec/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="static/css/theme.css" rel="stylesheet">
        <link type="text/css" href="static/images/icons/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="static/font-awesome/css/font-awesome.min.css">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="static/ico/favicon.png">
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
                                <img src="static/images/user.png" class="nav-avatar" />
                                <span class="nav-avatar"><?php echo $user['name']; ?></span>
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    
                                    <li class="divider"></li>
                                    <li><a href="Logout">Logout</a></li>
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
                                <li class="active"><a href="Manage"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i>Securities Account Management</a>
                                    <ul class="unstyled">
                                        <li><a href="Create/security/natual"><i class="icon-magic"></i>Create</a></li>
                                        <li><a href="Report/security/natual"><i class="icon-pushpin"></i>Report Loss</a></li>
                                        <li><a href="Replace/Security/natual"><i class="icon-random"></i>Replacement</a></li>
                                        <li><a href="Destruct/Security/natual"><i class="icon-inbox"></i>Destruct</a></li>
                                    </ul>
                                </li>
                                    
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-cog">
                                </i>Capital Account Management</a>
                                    <ul class="unstyled">
                                        <li><a href="Create/capital"><i class="icon-magic"></i>Create</a></li>
                                        <li><a href="Report/capital"><i class="icon-pushpin"></i>Report Loss</a></li>
                                        <li><a href="Replace/capital"><i class="icon-random"></i>Replacement</a></li>
                                        <li><a href="Destruct/capital"><i class="icon-inbox"></i>Destruct</a></li>
                                        <li><a href="Manage/capital"><i class="icon-money"></i>Capital Management</a></li>
                                        <li><a href="Manage/password"><i class="icon-wrench"></i>Change password</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            
                            <ul class="widget widget-menu unstyled">
                                
                                <li><a href="Logout"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <p style="font-size: 26px;margin-bottom: 25px;text-align: center;"><b>Special Space</b></p>
                                    <div style="text-align: center;margin: 0 25px 0 25px"><img style="height: 100%;width: 100%" src="static/img/jls.jpg"></div>
                                </div>
                                
                            </div>
                            <!--/#btn-controls-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2018 Library Management Sysment </b>All rights reserved.
            </div>
        </div>
        <script src="static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="static/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="static/bootstrap_sec/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="static/js/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="static/js/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="static/js/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="static/js/common.js" type="text/javascript"></script>
      
    </body>
