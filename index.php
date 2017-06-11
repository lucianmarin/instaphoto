<?php
	include 'include/context.php';

    $files = array_diff(scandir($storage), array('.', '..'));

    foreach ($files as $file) {
        $date = intval(substr($file, 0, -5));
        $dates[$date] = filemtime($storage . $file);
        $photos[$date] = $file;
    }

    if (isset($_GET['p']) and abs($_GET['p'])) {
        $page = abs($_GET['p']);
    } else {
        $page = 1;
    }
    $limit = 10;
    $offset = $limit * ($page - 1);
    $count = count($photos);
    $pages = ceil($count / $limit);

    krsort($photos);
	arsort($dates);

	$lastDate = reset($dates);
	$lastFile = key($dates);
    $photos = array_slice($photos, $offset, $limit, true);
?>

<? include 'include/header.php'; ?>
<? include 'include/menu.php'; ?>

<div class="photos">
	<div class="center">
	    <? foreach ($photos as $key => $photo): ?>
	        <div class="photo">
	            <div class="meta">
	                <a><?= date('l', $key) ?></a>
	                <span>&frasl;</span>
	                <b><?= date('M j, Y', $key) ?></b>
	                <span>&frasl;</span>
	                <? if($auth): ?>
		                <a href="/delete.php?id=<?= $key ?>">delete</a>
		            <? else: ?>
		                <b><?= date('H:m', $key) ?></b>
		            <? endif; ?>
	            </div>
	            <img src="/uploads/<?= $photo ?>" width="320" height="320" />
	        </div>
	    <? endforeach; ?>
	</div>
</div>

<? include 'include/footer.php'; ?>
