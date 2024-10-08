<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditPost extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = PostResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Post edit',
            icon: 'icon-newspaper',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
