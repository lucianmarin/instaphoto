<div class="center">
	<div class="pages">
	    <?php foreach (range(1, $pages) as $number): ?>
	        <?php if ($number == $page): ?>
	            <a class="right selected" href="/?p=<?= $number ?>"><?= $number ?></a>
	        <?php else: ?>
	            <a class="right" href="/?p=<?= $number ?>"><?= $number ?></a>
	        <?php endif; ?>
	    <?php endforeach; ?>
	</div>
	<h4>lucian marin</h4>
	<h1>
		<a class="left" href="/">photography</a>
	</h1>
	<?php if ($auth): ?>
		<form action="/upload.php" method="post" enctype="multipart/form-data">
			<div class="picture"></div>
		    <label for="imageUpload">Choose a photo...</label>
		    <input type="file" name="imageUpload" id="imageUpload" onchange="picture(this)" required>
		    <input type="submit" value="Upload" name="submit">
		</form>
	<?php else: ?>
		<form>
			<div class="picture"></div>
			<div class="last">Updated <?= ago($lastDate) ?> ago</div>
			<div class="count"><?= $count ?> photos</div>
		</form>
	<?php endif; ?>
</div>
