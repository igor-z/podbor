<?php

namespace App;

use Generator;

interface DataProviderInterface
{
    public function getData(): Generator;
}