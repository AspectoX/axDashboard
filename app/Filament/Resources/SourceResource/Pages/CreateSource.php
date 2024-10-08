<?php

namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions;
use App\Models\Source;
use Filament\Notifications\Notification;
use App\Filament\Resources\SourceResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;


class CreateSource extends CreateRecord
{
    use HasHeadingIcon;

    protected static string $resource = SourceResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Source create',
            icon: 'icon-pen-nib',
        );
    }

    public function toDatabase(Source $notifiable): array
    {
        return Notification::make()
            ->title('Saved successfully')
            ->getDatabaseMessage();
    }
}
