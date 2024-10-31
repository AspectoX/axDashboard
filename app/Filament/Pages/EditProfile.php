<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Pages\Concerns\HasHeadingIcon;

class EditProfile extends Page
{
    use HasHeadingIcon;

    protected static ?string $navigationIcon = 'icon-user-edit';

    protected static string $view = 'filament.pages.edit-profile';

    protected static ?string $navigationLabel = 'Profile';

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Edit Profile',
            icon: 'icon-user-edit',
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
