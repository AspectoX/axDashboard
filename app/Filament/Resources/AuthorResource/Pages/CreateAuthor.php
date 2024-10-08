<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use Filament\Actions;
use App\Filament\Resources\AuthorResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;

    use HasHeadingIcon;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Author create',
            icon: 'icon-user-edit',
        );
    }
}
