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
			<svg class="picture" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect width="80" height="80" fill="#ffa500" />
				<rect x="36" y="24" width="8" height="32" fill="#000000" />
				<rect x="24" y="36" width="32" height="8" fill="#000000" />
			</svg>
		    <label for="imageUpload">Choose a photo...</label>
		    <input type="file" name="imageUpload" id="imageUpload" onchange="picture(this)" required>
		    <input type="submit" value="Upload" name="submit">
		</form>
	<?php else: ?>
		<form>
			<svg class="picture" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect width="80" height="80" fill="#ffa500" />
				<rect x="36" y="24" width="8" height="32" fill="#000000" />
				<rect x="24" y="36" width="32" height="8" fill="#000000" />
			</svg>
			<div class="last">Updated <?= ago($lastDate) ?> ago</div>
			<div class="count"><?= $count ?> photos</div>
		</form>
	<?php endif; ?>
</div>
