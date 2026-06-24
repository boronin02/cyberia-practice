<?php

namespace App\Support\Filament;

use App\Support\Filament\Enums\ActionType;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Actions\ActionGroup as TableActionGroup;
use Filament\Tables\Actions\AttachAction as TableAttachAction;
use Filament\Tables\Actions\BulkActionGroup as TableBulkActionGroup;
use Filament\Tables\Actions\CreateAction as TableCreateAction;
use Filament\Tables\Actions\DeleteAction as TableDeleteAction;
use Filament\Tables\Actions\DeleteBulkAction as TableDeleteBulkAction;
use Filament\Tables\Actions\DetachAction as TableDetachAction;
use Filament\Tables\Actions\DetachBulkAction as TableDetachBulkAction;
use Filament\Tables\Actions\EditAction as TableEditAction;
use Filament\Tables\Actions\ForceDeleteAction as TableForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction as TableRestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction as TableViewAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasActions
{
    public static function getBaseActions(
        ActionType $type = ActionType::Page,
        ?array     $list = null,
        ?array     $callbacks = null,
        bool       $isGroup = false,
    ): array {
        $baseActions = self::getActionsByType($type);

        if (is_null($list)) {
            $list = self::getListActions($type);
        }

        $actions = self::updateActions($baseActions, $list, $callbacks);

        return self::getGroupActions($actions, $type, $isGroup);
    }

    private static function updateActions(
        Collection $actions,
        array      $list,
        ?array     $callbacks,
    ): array {
        $actions = $actions
            ->filter(function ($value, $key) use ($list) {
                return in_array($key, $list, true);
            });

        if (!is_null($callbacks)) {
            $actions = $actions
                ->mapWithKeys(function ($action, $key) use ($callbacks) {
                    $methods = Arr::get($callbacks, $key);

                    if (is_null($methods)) {
                        return [$key => $action];
                    }

                    foreach ($methods as $method => $value) {
                        $action->{$method}($value);
                    }

                    return [$key => $action];
                });
        }

        return $actions
            ->values()
            ->toArray();
    }

    private static function getActionsByType(ActionType $type): Collection
    {
        $actions = match ($type) {
            ActionType::Page => [
                'view' => ViewAction::make()
                    ->modalHeading(__('filament/actions.simple.view')),
                'create' => CreateAction::make()
                    ->modalHeading(__('filament/actions.simple.create')),
                'delete' => DeleteAction::make()
                    ->modalHeading(__('filament/actions.simple.delete')),
                'force_delete' => ForceDeleteAction::make()
                    ->modalHeading(__('filament/actions.simple.force_delete')),
                'restore' => RestoreAction::make()
                    ->modalHeading(__('filament/actions.simple.restore')),
            ],

            ActionType::Table => [
                'view' => TableViewAction::make()
                    ->modalHeading(__('filament/actions.simple.view')),
                'create' => TableCreateAction::make()
                    ->modalHeading(__('filament/actions.simple.create')),
                'edit' => TableEditAction::make()
                    ->modalHeading(__('filament/actions.simple.edit')),
                'delete' => TableDeleteAction::make()
                    ->modalHeading(__('filament/actions.simple.delete')),
                'force_delete' => TableForceDeleteAction::make()
                    ->modalHeading(__('filament/actions.delete_force')),
                'restore' => TableRestoreAction::make()
                    ->modalHeading(__('filament/actions.simple.restore')),
                'attach' => TableAttachAction::make()
                    ->modalHeading(__('filament/actions.simple.attach')),
                'detach' => TableDetachAction::make()
                    ->modalHeading(__('filament/actions.simple.detach')),
            ],

            ActionType::TableBulk => [
                'delete_bulk' => TableDeleteBulkAction::make()
                    ->modalHeading(__('filament/actions.simple.delete_bulk')),
                'force_delete_bulk' => ForceDeleteBulkAction::make()
                    ->modalHeading(__('filament/actions.simple.force_delete_bulk')),
                'restore_bulk' => RestoreBulkAction::make()
                    ->modalHeading(__('filament/actions.simple.restore_bulk')),
                'detach_bulk' => TableDetachBulkAction::make()
                    ->modalHeading(__('filament/actions.simple.detach_bulk')),
            ],
        };

        return collect($actions);
    }

    private static function getListActions(ActionType $type): array
    {
        return match ($type) {
            ActionType::Page => ['create'],
            ActionType::Table => ['edit'],
            ActionType::TableBulk => ['delete_bulk'],
        };
    }

    private static function getGroupActions(
        array      $actions,
        ActionType $type,
        bool       $isGroup,
    ): array {
        if ($isGroup === false) {
            return $actions;
        }

        $groupActions = match ($type) {
            ActionType::Page => ActionGroup::make($actions),
            ActionType::Table => TableActionGroup::make($actions),
            ActionType::TableBulk => TableBulkActionGroup::make($actions),
        };

        return [
            $groupActions,
        ];
    }
}
