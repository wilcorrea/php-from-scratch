<?php

declare(strict_types=1);

use App\Http\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$app = Kernel::bootstrap();

$app->run();
