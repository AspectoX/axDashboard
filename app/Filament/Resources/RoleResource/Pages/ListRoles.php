<?php

namespace BezhanSalleh\FilamentShield\Resources\RoleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use BezhanSalleh\FilamentShield\Resources\RoleResource;

class ListRoles extends ListRecords
{
    use HasHeadingIcon;

    protected static string $resource = RoleResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'List Roles',
            icon: 'icon-shield-check',
        );
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
