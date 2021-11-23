<?php

namespace App;

use RuntimeException;

class Counter
{
    public function __construct(
        private DataProviderInterface $dataProvider,
        private array $needles
    ) {
    }

    public function count(): array
    {
        $normalizedNeedles = array_combine($this->needles, array_map('mb_strtolower', $this->needles));
        $counters = array_combine($this->needles, array_fill(0, count($this->needles), 0));

        foreach ($this->dataProvider->getData() as $data) {
            if (!is_array($data) || !isset($data['job_description'])) {
                throw new RuntimeException('invalid data format');
            }

            $description = mb_strtolower($data['job_description']);

            foreach ($normalizedNeedles as $needle => $normalizedNeedle) {
                if (preg_match('/\b' . preg_quote($normalizedNeedle, '/') . '\b/', $description)) {
                    $counters[$needle]++;
                }
            }
        }

        return $counters;
    }
}