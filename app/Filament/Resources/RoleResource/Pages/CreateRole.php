<?php

namespace BezhanSalleh\FilamentShield\Resources\RoleResource\Pages;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\CreateRecord;
use BezhanSalleh\FilamentShield\Support\Utils;
use App\Filament\Pages\Concerns\HasHeadingIcon;
use BezhanSalleh\FilamentShield\Resources\RoleResource;

class CreateRole extends CreateRecord
{
    use HasHeadingIcon;

    protected static string $resource = RoleResource::class;

    public Collection $permissions;

    public function getHeading(): string
    {
        return $this->getHeadingWithIcon(
            heading: 'Create Role',
            icon: 'icon-shield-check',
        );
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function afterCreate(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                /** @phpstan-ignore-next-line */
                'name' => $permission,
                'guard_name' => $this->data['guard_name'],
            ]));
        });

        $this->record->syncPermissions($permissionModels);
    }
}
