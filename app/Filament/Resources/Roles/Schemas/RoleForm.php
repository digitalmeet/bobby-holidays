<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        $modules = collect(config('admin-modules'))
            ->except(['role_permissions', 'admin_access_roles']);

        $tabs = [];

        foreach ($modules as $moduleKey => $module) {
            if (!isset($module['actions']) || !is_array($module['actions'])) {
                continue;
            }

            $permissionOptions = [];
            foreach ($module['actions'] as $action => $label) {
                $permissionName = "{$action}_{$moduleKey}";
                $permissionOptions[$permissionName] = $label;
            }

            $tabs[] = Tab::make($module['label'])
                ->schema([
                    CheckboxList::make('permissions')
                        ->label('')
                        ->relationship('permissions', 'name')
                        ->options($permissionOptions)
                        ->columns(2)
                        ->bulkToggleable(),
                ]);
        }

        return $schema
            ->components([
                Section::make('Role Details')
                    ->compact()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. sales_manager')
                            ->helperText('Use snake_case. This cannot be changed later for system roles.'),
                        TextInput::make('guard_name')
                            ->default('web')
                            ->disabled()
                            ->dehydrated(),
                    ]),

                Section::make('Module Permissions')
                    ->description('Select which permissions this role should have for each module.')
                    ->schema([
                        Tabs::make('Modules')
                            ->columnSpanFull()
                            ->tabs($tabs),
                    ]),
            ]);
    }
}
