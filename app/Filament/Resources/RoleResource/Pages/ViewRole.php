<?php

namespace BezhanSalleh\FilamentShield\Resources\RoleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use BezhanSalleh\FilamentShield\Resources\RoleResource;


class ViewRole extends ViewRecord
{
    use HasHeadingIcon;

    protected static string $resource = RoleResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'View Role',
            icon: 'icon-shield-check',
        );
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
