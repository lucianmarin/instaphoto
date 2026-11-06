<?php
    include dirname(__FILE__) . '/include/context.php';

	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($auth and $id) {
        $file = $storage . $id . '.jpeg';
        if (is_file($file)) {
            unlink($file);
        }
    }

    redirect();
?>
