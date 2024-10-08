<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditUser extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = UserResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'User edit',
            icon: 'icon-users',
        );
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
