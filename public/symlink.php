<?php

$targetFolder = __DIR__.'/../storage/app/public';
$linkFolder = __DIR__.'/public/storage/';
symlink($targetFolder, $linkFolder);

echo 'Symlink process succesfully';
