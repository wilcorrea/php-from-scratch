<?php

namespace Helper;

use EndyJasmi\Cuid;
use Exception;

/**
 * @return string
 * @throws Exception
 */
function generateId(): string
{
    if (config('app.generators.id') === 'cuid') {
        return Cuid::cuid();
    }

    if (config('app.generators.id') === 'slug') {
        return Cuid::slug();
    }

    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        random_int(0, 0xffff),
        random_int(0, 0xffff),

        // 16 bits for "time_mid"
        random_int(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        random_int(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        random_int(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0xffff)
    );
}
