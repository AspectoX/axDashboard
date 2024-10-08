<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CategoryResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class ListCategories extends ListRecords
{
    use HasHeadingIcon;

    protected static string $resource = CategoryResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Categories',
            icon: 'icon-ballot',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
