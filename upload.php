<?php
	include 'include/context.php';

    $fn = $_FILES['imageUpload']['tmp_name'];
    $max = 640;

    list($width, $height, $type, $attr) = getimagesize($fn);
    $exif = exif_read_data($fn);

    $src = imagecreatefromstring(file_get_contents($fn));
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
        $target = $storage . strtotime($exif['DateTimeOriginal']) . '.jpeg';
	} else {
		$target = $storage . time() . '.jpeg';
	}

    imagejpeg($dst, $target);

    imagedestroy($src);
    imagedestroy($dst);

    redirect();
?>
