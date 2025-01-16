<?php

namespace TomatoPHP\FilamentMediaManager\Resources\MediaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use TomatoPHP\FilamentMediaManager\Resources\MediaResource;

class CreateMedia extends CreateRecord
{
    use HasHeadingIcon;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Create media',
            icon: 'icon-photo-video',
        );
    }

    protected static string $resource = MediaResource::class;
}
