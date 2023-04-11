<div class="explore-section">
	<form action="#" method="post" class="d-flex gap-3 align-items-center">
		<?php foreach ($templateParams["categories"] as $category) : ?>
			<button type="submit" id="<?php echo $category["CategoryID"]; ?>" name="category" value="<?php echo $category["CategoryID"]; ?>" class="category btn btn-outline-primary <?php if ($category["CategoryID"] === intval($_SESSION["selectedCategory"])) echo "category-selected"; ?>" />
			<?php echo $category["Name"]; ?>
			</button>
		<?php endforeach; ?>
		<button type="submit" id="0" name="category" value="0"
			class="category btn btn-outline-primary <?php if (intval($_SESSION["selectedCategory"]) === 0) echo "category-selected"; ?>"
		/>
			Tutti
		</button>
	</form>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="post-section"></div>
	<?php endif ?>
</div>