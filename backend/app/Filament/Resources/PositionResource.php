<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\PositionResource\Pages;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Position;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PositionResource extends Resource
{
    use HasNavigationConfig, HasResourceTranslation;

    protected static ?string $model = Position::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament/position.fields.name')),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('filament/position.fields.name')),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading(__('filament/position.actions.edit.title')),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament/position.actions.delete.title')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament/position.actions.delete-bulk.title')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePositions::route('/'),
        ];
    }

    public static function getTranslateModelName(): string
    {
        return 'position';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }
}
