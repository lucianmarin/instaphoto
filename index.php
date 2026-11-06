<?php
    include dirname(__FILE__) . '/include/context.php';

    $photos = array();
    $dates = array();

    $scanned = scandir($storage);
    if ($scanned === false) {
        $scanned = array();
    }
    $files = array_diff($scanned, array('.', '..'));

    foreach ($files as $file) {
        $date = intval(substr($file, 0, -5));
        $dates[$date] = filemtime($storage . $file);
        $photos[$date] = $file;
    }

    if (isset($_GET['p'])) {
        $page = abs((int)$_GET['p']);
        if ($page < 1) {
            $page = 1;
        }
    } else {
        $page = 1;
    }
    $limit = 10;
    $offset = $limit * ($page - 1);
    $count = count($photos);
    $pages = $count ? ceil($count / $limit) : 1;

    krsort($photos);
    arsort($dates);

    $lastDate = $dates ? reset($dates) : time();
    $lastFile = $dates ? key($dates) : null;
    $photos = array_slice($photos, $offset, $limit, true);
?>

<?php include dirname(__FILE__) . '/include/header.php'; ?>
<?php include dirname(__FILE__) . '/include/menu.php'; ?>

<div class="photos">
	<div class="center">
	    <?php foreach ($photos as $key => $photo): ?>
	        <div class="photo">
	            <div class="meta">
	                <a><?= date('l', $key) ?></a>
	                <span>&frasl;</span>
	                <b><?= date('M j, Y', $key) ?></b>
	                <span>&frasl;</span>
	                <?php if($auth): ?>
		                <a href="/delete.php?id=<?= (int)$key ?>">delete</a>
		            <?php else: ?>
		                <b><?= date('H:i', $key) ?></b>
		            <?php endif; ?>
	            </div>
	            <img src="/uploads/<?= htmlspecialchars($photo, ENT_QUOTES) ?>" width="320" height="320" />
	        </div>
	    <?php endforeach; ?>
	</div>
</div>

<?php include dirname(__FILE__) . '/include/footer.php'; ?>
