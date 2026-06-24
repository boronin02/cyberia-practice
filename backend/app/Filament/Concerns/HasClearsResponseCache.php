<?php

namespace App\Filament\Concerns;

use Spatie\ResponseCache\Facades\ResponseCache;

trait HasClearsResponseCache
{
    public function reorderTable(array $order): void
    {
        parent::reorderTable($order);

        ResponseCache::clear();
    }
}
