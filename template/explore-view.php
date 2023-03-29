<div class="explore-section">
	<form action="#" method="post" class="d-flex gap-3 align-items-center">
		<?php foreach ($templateParams["categories"] as $category) : ?>
			<button type="submit" id="<?php echo $category["CategoryID"]; ?>"
					name="categoria" value="<?php echo $category["CategoryID"]; ?>"
					class="category btn btn-outline-primary"
			/>
				<?php echo $category["Name"]; ?>
			</button>
		<?php endforeach; ?>
		<button type="submit" id="0" name="categoria" value="0" class="category btn btn-outline-primary" />Tutti</button>
	</form>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="post-section"></div>
	<?php endif ?>
</div>