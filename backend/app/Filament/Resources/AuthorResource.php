<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    use HasNavigationConfig, HasResourceTranslation;

    protected static ?string $model = Author::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([])
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->label(__('filament/author.fields.first_name')),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->label(__('filament/author.fields.last_name')),
                        Forms\Components\Select::make('positions')
                            ->relationship(titleAttribute: 'name')
                            ->preload()
                            ->multiple()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label(__('filament/position.fields.name')),
                            ])
                            ->label(__('filament/author.fields.positions')),
                    ])
                    ->columnSpan(3),
                Forms\Components\Section::make([])
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->avatar()
                            ->imageEditor()
                            ->required()
                            ->directory('authors')
                            ->label(__('filament/author.fields.image')),
                    ])
                    ->columnSpan(1),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->label(__('filament/author.fields.first_name')),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->label(__('filament/author.fields.last_name')),
                Tables\Columns\TextColumn::make('positions.name')
                    ->badge()
                    ->label(__('filament/author.fields.positions')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/author.fields.deleted_at')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/author.fields.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/author.fields.updated_at')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('positions')
                    ->relationship('positions', 'name')
                    ->label(__('filament/author.fields.positions')),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading(__('filament/author.actions.edit.title')),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament/author.actions.delete.title')),
                    Tables\Actions\ForceDeleteAction::make()
                        ->modalHeading(__('filament/author.actions.force-delete.title')),
                    Tables\Actions\RestoreAction::make()
                        ->modalHeading(__('filament/author.actions.restore.title')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament/author.actions.delete-bulk.title')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('filament/author.actions.force-delete-bulk.title')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('filament/author.actions.restore-bulk.title')),
                ]),
            ])
            ->emptyStateHeading(__('filament/author.empty.heading'));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAuthors::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.blog');
    }

    public static function getTranslateModelName(): string
    {
        return 'author';
    }
}
