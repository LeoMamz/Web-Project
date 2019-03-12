<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administration</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="static/css/form-elements.css">
        <link rel="stylesheet" href="static/css/style.css">


        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="static/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="static/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="static/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="static/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="static/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <div>
                                <h1><strong>Administration</strong></h1>
                                <span class="version">version 1.0.7</span>
                            </div>
                            <div class="description">
                            	<p>
	                            	This is a brand new Administration system!</br>
                                    Feel free to have a such a good powerful, useful system!</br>
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our system</h3>
                            		<p>Enter your username and password to log in:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" method="post" class="login-form" onsubmit="return Login(this)">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">Log in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h3>...Oops, did i create a administrator?</h3>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="static/js/jquery-1.11.1.min.js"></script>
        <script src="static/bootstrap/js/bootstrap.min.js"></script>
        <script src="static/js/jquery.backstretch.min.js"></script>
        <script src="static/js/scripts.js"></script>

    </body>

</html>