<!DOCTYPE html>
<html>
    <head>
    <title>Bootstrap 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel ="stylesheet">
    <link href="shubooks.css" rel ="stylesheet">
    
    </head>
    
    <body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <a href="#" class="navbar-brand">SHU Books</a>
                
                <button class ="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <div class="collapse navbar-collapse navHeaderCollapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                        <a href="index.php">Home</a>
                        </li>
                        <li>
                        <a href="shusignin.php">Sign In</a>
                        </li>
                        <li>
                        <a href="shureg.php">Register</a>
                        </li>
                        </ul>
                    
                </div>
            </div>
            
        </div>
        
       
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p class="navbar-text pull-left">Prototype created by Paul Cardiff</p>
                <a href="#contact" data-toggle="modal" class="navbar-btn btn-info btn pull-right">Contact SHU Books</a> 
            </div>                     
        </div>
        
<!--This will be used for displaying the book when it has been selected-->


<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3>Books for sale</h3>
                    </div>
                        <h4>Item heading</h4>
                        <p>This is the book that is for sale, This is the book that is for sale, This is the book that is for sale, This is the book that is for sale, This is the book that is for sale</p>
                </div>
            </div>        
        </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="page-header">
                                <h3>Basket</h3>
                            </div>
                            <h4>Heading</h4>
                            <p>items in basket</p>  
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>


<!--<div class="container">
    <div class="row">            
       <div class="col-md-12">
            <h3>Heading</h3>
            <p>bit of text</p>                
       </div>            
   </div>
</div>-->

<div class="modal fade" id="contact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>SHU Support</h4>
            </div>
            <div class="modal-body">
                <p>A contact form will be placed here and will issue email requests to shu books support team</p>
            </div>
            <div class ="modal-footer">
                <a class="btn btn-default" data-dismiss ="modal">Close</a>
            </div>
        </div>
    </div>    
</div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        
    </body>
    
</html>

