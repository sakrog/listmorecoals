<!-- Modal -->
<div class="modal fade" tabindex="-1" id="post_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal content-->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">What Are You Posting?</h4>
			</div>
			<form role="form" method="POST">
				<div class="form-group col-md-6">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title">
				</div> 
				<div class="form-group col-md-8">
					<label for="description">Description</label>
					<textarea class="form-control" rows="10" name="description"></textarea>
				</div>  
				<div class="form-group col-md-4">
					<label for="location">Location</label>
					<input type="text" class="form-control" name="location">
				</div>
				<div class="form-group col-md-4">
					<label for="email">Email Address</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group col-md-4">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price">
				</div> 
				<div class="adCreate form-group">
					<label for="image">Image Input</label>
					<input type="file" name="image" id="image">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-lg">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>




