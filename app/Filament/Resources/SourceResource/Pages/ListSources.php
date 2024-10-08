<?php
namespace App\Filament\Resources\SourceResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Filament\Support\Enums\IconSize;
use Illuminate\Support\Facades\Blade;
use Filament\Support\Enums\IconPosition;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SourceResource;
use App\Filament\Pages\Concerns\HasHeadingIcon;


class ListSources extends ListRecords
{
    protected static string $resource = SourceResource::class;

    use HasHeadingIcon;

    // public function getHeading(): string
    // {
    //     return $this->getHeadingWithIcon(
    //         heading: 'Source',
    //         icon: 'icon-pen-nib',
    //         iconColor: 'success',
    //         iconPosition: IconPosition::Before,
    //         iconSize: IconSize::Small
    //     );
    // }

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(icon:'icon-pen-nib') ;

    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
