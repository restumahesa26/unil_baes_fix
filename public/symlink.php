<?php

$targetFolder = __DIR__.'/../laravel/storage/app/public';
$linkFolder = __DIR__.'/public/storage/';
symlink($targetFolder, $linkFolder);

echo 'Symlink process succesfully completed';
