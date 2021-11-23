<?php
namespace App;

use Generator;
use RuntimeException;
use SplFileObject;

class JsonDataProvider implements DataProviderInterface
{
    public function __construct(
        private string $fileName
    ) {}

    public function getData(): Generator
    {
        $file = new SplFileObject($this->fileName);
        $i = 0;
        while (!$file->eof()) {
            $i++;

            $str = trim($file->fgets());
            if (!$str) {
                continue;
            }

            $data = json_decode($str, true);

            if (json_last_error()) {
                throw new RuntimeException("Error parsing line $i: " . json_last_error_msg(), json_last_error());
            }

            yield $data;
        }

        unset($file);
    }
}