<?php

namespace TomatoPHP\FilamentMediaManager\Resources\MediaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use TomatoPHP\FilamentMediaManager\Resources\MediaResource;

class EditMedia extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = MediaResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Edit media',
            icon: 'icon-photo-video',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
