<?php

$content = file_get_contents($_FILES['file']['tmp_name']);


echo preg_replace("/({$_POST['search']})/is", "<b>$1</b>", $content);