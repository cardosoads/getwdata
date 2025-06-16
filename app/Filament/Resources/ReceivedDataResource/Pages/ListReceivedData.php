<?php

namespace App\Filament\Resources\ReceivedDataResource\Pages;

use App\Filament\Resources\ReceivedDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReceivedData extends ListRecords
{
    protected static string $resource = ReceivedDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
