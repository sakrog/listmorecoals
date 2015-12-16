<nav class="navbar navbar-default">
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="container">
          
      	</div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    	<form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                	<input type="text" class="form-control" placeholder="Search">
                </div>
              </form>
              <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                	<input type="text" class="form-control" placeholder="Min">
                </div>
              </form>
              <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                	<input type="text" class="form-control" placeholder="Max">
                </div>
                	<button type="submit" class="btn btn-default">Submit</button>
            	</form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Account</a></li>
		        <li><a href="#">Sign Out</a></li>
		      </ul>
              	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Post</button>
              	<?php include "modal_nav.php"; ?>
    		</div>
 		</div>
 </nav>

