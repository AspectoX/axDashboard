<?php
namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SourceResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;


class ListSources extends ListRecords
{
    protected static string $resource = SourceResource::class;

    use HasHeadingIcon;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Sources',
            icon: 'icon-pen-nib',
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
