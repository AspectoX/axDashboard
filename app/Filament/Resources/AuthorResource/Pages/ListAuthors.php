<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AuthorResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class ListAuthors extends ListRecords
{
    use HasHeadingIcon;

    protected static string $resource = AuthorResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Authors',
            icon: 'icon-user-edit',
        );
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
