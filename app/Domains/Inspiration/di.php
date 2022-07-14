<?php

use App\Domains\Inspiration\Adapters\Contract\InspireRepositoryContract;
use App\Domains\Inspiration\Adapters\Repository\InspireRepositoryCURL;
use App\Domains\Inspiration\Services\Contract\GetInspirationalQuoteContract;
use App\Domains\Inspiration\Services\GetInspirationalQuote;

return [
    GetInspirationalQuoteContract::class => DI\autowire(GetInspirationalQuote::class),
    InspireRepositoryContract::class => DI\autowire(InspireRepositoryCURL::class),
];
