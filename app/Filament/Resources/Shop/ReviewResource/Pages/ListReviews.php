<?php

namespace App\Filament\Resources\Shop\ReviewResource\Pages;

use App\Filament\Resources\Shop\ReviewResource;
use Closure;
use Filament\Resources\Pages\ListRecords;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return null;
    }
}
