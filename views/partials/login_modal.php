
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h2 class="modal-title" id="myModalLabel">Welcome Back!</h2>
			</div>
			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" method="POST">
					<div class="form-group">
						<label for="exampleUserName1">Username</label><br>
						<input value ="<?= escape($name) ?>"type="text" name="name" placeholder="Enter username"><br>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label><br>
						<input value ="<?= escape($password) ?>"type="password" name="password" placeholder="Enter password"><br>
					</div>
					<div class="checkbox">
						<label><input type="checkbox"/>Remember Me</label>
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
					<script language="javascript">
				    	<?= $javascript; ?>
					</script>
				</form>
			</div>
		</div>
	</div>
</div>