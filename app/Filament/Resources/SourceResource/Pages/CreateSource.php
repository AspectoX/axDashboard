<?php

namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions;
use App\Models\Source;
use Filament\Notifications\Notification;
use App\Filament\Resources\SourceResource;
use Filament\Resources\Pages\CreateRecord;


class CreateSource extends CreateRecord
{
    protected static string $resource = SourceResource::class;
    public function toDatabase(Source $notifiable): array
    {
        return Notification::make()
            ->title('Saved successfully')
            ->getDatabaseMessage();
    }
}
