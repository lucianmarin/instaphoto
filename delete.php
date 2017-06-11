<?php
    include 'include/context.php';

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

    if ($auth and $id) {
        $file =  $storage . $id . '.jpeg';
        unlink($file);
    }

    redirect();
?>
