<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CategoryResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditCategory extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = CategoryResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Category edit',
            icon: 'icon-ballot',
        );
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
