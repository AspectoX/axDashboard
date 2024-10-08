<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AuthorResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditAuthor extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = AuthorResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Author edit',
            icon: 'icon-user-edit',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
