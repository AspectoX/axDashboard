<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class CreatePost extends CreateRecord
{
    use HasHeadingIcon;

    protected static string $resource = PostResource::class;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Post create',
            icon: 'icon-newspaper',
        );
    }
}
