<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class ApiTokens extends Page
{
    use HasHeadingIcon;

    protected static ?string $navigationIcon = 'icon-key';

    protected static string $view = 'filament.pages.api-tokens';

    protected static ?string $navigationLabel = 'API Tokens';

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'API Tokens',
            icon: 'icon-key',
        );
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }
}
