#!/usr/bin/env php
<?php
$fileToParse = $argv[1] ?? null;
assert(!empty($fileToParse), 'File to parse must be specified');

$projectRoot = realpath(__DIR__ . '/..');

$fileToParse = "$projectRoot/$fileToParse";
assert(file_exists($fileToParse), 'File to parse not found');

require_once "$projectRoot/vendor/autoload.php";

$counter = new \App\Counter(
    new \App\JsonDataProvider($fileToParse),
    ['PHP', 'JavaScript', 'Java', 'Python']
);

echo json_encode($counter->count(), JSON_PRETTY_PRINT);

return 0;