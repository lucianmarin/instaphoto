<?php
	include dirname(__FILE__) . '/include/context.php';

	if (!$auth) {
		redirect();
	}

	if (!isset($_FILES['imageUpload']) || $_FILES['imageUpload']['error'] !== UPLOAD_ERR_OK) {
		redirect();
	}

	$fn = $_FILES['imageUpload']['tmp_name'];
	if (!is_uploaded_file($fn)) {
		redirect();
	}

	$max = 640;

	$imageInfo = getimagesize($fn);
	if ($imageInfo === false) {
		redirect();
	}
	list($width, $height, $type, $attr) = $imageInfo;

	$exif = exif_read_data($fn);
	if (!is_array($exif)) {
		$exif = array();
	}

	$src = imagecreatefromstring(file_get_contents($fn));
	if ($src === false) {
		redirect();
	}
	$dst = imagecreatetruecolor($max, $max);

	if ($width > $height) {
	    $x_point = ($width - $height) / 2;
		imagecopyresampled($dst, $src, 0, 0, $x_point, 0, $max, $max, $height, $height);
    } else {
	    $y_point = ($height - $width) / 2;
		imagecopyresampled($dst, $src, 0, 0, 0, $y_point, $max, $max, $width, $width);
    }

	if (isset($exif['Orientation'])) {
	    $orientation = $exif['Orientation'];
	} else {
		$orientation = 0;
	}

    if ($orientation == 3) {
        $dst = imagerotate($dst, 180, 0);
    }
    if ($orientation == 6) {
        $dst = imagerotate($dst, 270, 0);
    }
    if ($orientation == 8) {
        $dst = imagerotate($dst, 90, 0);
    }

    if (isset($exif['DateTimeOriginal'])) {
        $timestamp = strtotime($exif['DateTimeOriginal']);
        if ($timestamp === false) {
            $timestamp = time();
        }
        $target = $storage . $timestamp . '.jpeg';
	} else {
		$target = $storage . time() . '.jpeg';
	}

    imagejpeg($dst, $target);

    redirect();
?>
