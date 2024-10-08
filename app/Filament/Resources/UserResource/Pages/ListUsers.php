<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class ListUsers extends ListRecords
{
    use HasHeadingIcon;

    protected static string $resource = UserResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Users',
            icon: 'icon-users',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
