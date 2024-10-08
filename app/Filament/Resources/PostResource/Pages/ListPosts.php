<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class ListPosts extends ListRecords
{
    use HasHeadingIcon;

    protected static string $resource = PostResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Posts',
            icon: 'icon-newspaper',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
