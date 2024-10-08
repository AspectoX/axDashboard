<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CategoryResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class CreateCategory extends CreateRecord
{
    use HasHeadingIcon;

    protected static string $resource = CategoryResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Category create',
            icon: 'icon-ballot',
        );
    }
}
