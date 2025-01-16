<?php

namespace TomatoPHP\FilamentMediaManager\Resources\FolderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use TomatoPHP\FilamentMediaManager\Resources\FolderResource;

class EditFolder extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = FolderResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Edit folder',
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
