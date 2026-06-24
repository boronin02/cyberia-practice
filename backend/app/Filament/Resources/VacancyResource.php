<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacancyResource\Pages;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Vacancy;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VacancyResource extends Resource
{
    use HasResourceTranslation;

    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_first')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->label(__('filament/vacancy.fields.name_first')),
                Forms\Components\TextInput::make('name_second')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->label(__('filament/vacancy.fields.name_second')),
                Forms\Components\TextInput::make('name_third')
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->label(__('filament/vacancy.fields.name_third')),
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-globe-alt')
                    ->columnSpan('full')
                    ->label(__('filament/vacancy.fields.link')),
                Forms\Components\Repeater::make('terms')
                    ->schema([
                        Forms\Components\TextInput::make('text')
                            ->required()
                            ->maxLength(255)
                            ->label(__('filament/vacancy.fields.text_terms')),
                    ])
                    ->columnSpan('full')
                    ->reorderableWithButtons()
                    ->defaultItems(3)
                    ->minItems(3)
                    ->addActionLabel(__('filament/vacancy.actions.add-terms.title'))
                    ->label(__('filament/vacancy.fields.terms')),
            ])
            ->columns(6);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(['name_first', 'name_second', 'name_third'])
                    ->label(__('filament/vacancy.fields.name')),
                Tables\Columns\ToggleColumn::make('show_on_home')
                    ->sortable()
                    ->alignment('end')
                    ->afterStateUpdated(function (Vacancy $record, bool $state) {
                        if ($state === true && Vacancy::where('show_on_home', true)->count() > 2) {
                            Notification::make()
                                ->title(__('filament/vacancy.errors.max_show_on_home'))
                                ->danger()
                                ->send();

                            $record->update(['show_on_home' => false]);
                        }
                    })
                    ->rules([
                        function () {
                            return function (string $attribute, $value, Closure $fail) {

                            };
                        },
                    ])
                    ->label(__('filament/vacancy.fields.show_on_home')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/vacancy.fields.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/vacancy.fields.updated_at')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/vacancy.fields.deleted_at')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('browse_link')
                        ->url(fn(Vacancy $record): string => $record->link)
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-globe-alt')
                        ->label(__('filament/vacancy.actions.browse_link.title')),
                    Tables\Actions\EditAction::make()
                        ->modalHeading(__('filament/vacancy.actions.edit.title')),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament/vacancy.actions.delete.title')),
                    Tables\Actions\ForceDeleteAction::make()
                        ->modalHeading(__('filament/vacancy.actions.force-delete.title')),
                    Tables\Actions\RestoreAction::make()
                        ->modalHeading(__('filament/vacancy.actions.restore.title')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament/vacancy.actions.delete-bulk.title')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('filament/vacancy.actions.force-delete-bulk.title')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('filament/vacancy.actions.restore-bulk.title')),
                ]),
            ])
            ->emptyStateHeading(__('filament/vacancy.empty.heading'));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVacancies::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTranslateModelName(): string
    {
        return 'vacancy';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.vacancies');
    }
}
