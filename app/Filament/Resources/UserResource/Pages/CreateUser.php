<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class CreateUser extends CreateRecord
{
    use HasHeadingIcon;

    protected static string $resource = UserResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'User create',
            icon: 'icon-users',
        );
    }
}
