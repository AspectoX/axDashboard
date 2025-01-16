<?php

namespace TomatoPHP\FilamentMediaManager\Resources\FolderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use TomatoPHP\FilamentMediaManager\Resources\FolderResource;

class CreateFolder extends CreateRecord
{
    use HasHeadingIcon;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Create folder',
            icon: 'icon-photo-video',
        );
    }

    protected static string $resource = FolderResource::class;
}
