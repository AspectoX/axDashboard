<?php

namespace BezhanSalleh\FilamentShield\Resources\RoleResource\Pages;

use Filament\Actions;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\EditRecord;
use BezhanSalleh\FilamentShield\Support\Utils;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use BezhanSalleh\FilamentShield\Resources\RoleResource;

class EditRole extends EditRecord
{
    use HasHeadingIcon;

    protected static string $resource = RoleResource::class;

    public Collection $permissions;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Edit Role',
            icon: 'icon-shield-check',
        );
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->permissions = collect($data)
            ->filter(function ($permission, $key) {
                return ! in_array($key, ['name', 'guard_name', 'select_all']);
            })
            ->values()
            ->flatten()
            ->unique();

        return Arr::only($data, ['name', 'guard_name']);
    }

    protected function afterSave(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                'name' => $permission,
                'guard_name' => $this->data['guard_name'],
            ]));
        });

        $this->record->syncPermissions($permissionModels);
    }
}
