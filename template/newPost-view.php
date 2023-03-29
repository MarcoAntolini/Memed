<div class="new-post-container container-fluid d-flex justify-content-center align-items-center">
	<form action="uploadPost.php" method="post" enctype="multipart/form-data">
		<div class="form-outline mb-3">
			<input class="form-control" type="file" id="image-input" accept="image/png, image/jpg, image/jpeg, image/gif" name="image-input">
		</div>
		<div class="form-outline mb-3">
			<label for="description-input">Descrizione:</label>
			<textarea class="form-control" id="description-input" name="description-input" rows="5"></textarea>
		</div>
		<datalist class="form-outline mb-3 categories-container">
			<?php foreach ($templateParams["categories"] as $category) : ?>
				<div class="category">
					<input type="checkbox" id="<?php echo $category["CategoryID"]; ?>" name="categoria_<?php echo $category["CategoryID"]; ?>" />
					<label for="<?php echo $category["CategoryID"]; ?>"><?php echo $category["Name"]; ?></label>
				</div>
			<?php endforeach; ?>
		</datalist>
		<button type="button" class="btn btn-info float-start" data-bs-toggle="modal" data-bs-target=".preview">Anteprima</button>
		<button type="submit" name="submit" class="btn btn-primary float-end">Pubblica</button>
	</form>
	<div class="preview modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
		<div id="preview" class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Anteprima</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="image-preview"></div>
					<p id="description-preview"></p>
				</div>
			</div>
		</div>
	</div>
</div>