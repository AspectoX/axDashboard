<?php

namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SourceResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditSource extends EditRecord
{
    protected static string $resource = SourceResource::class;

    use HasHeadingIcon;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Source edit',
            icon: 'icon-pen-nib',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
