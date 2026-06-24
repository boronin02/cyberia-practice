<?php

namespace App\Filament\Resources\ProjectCategoryResource\RelationManagers;

use App\Support\Filament\HasTranslation;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\AssociateAction;
use Filament\Tables\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ProjectsRelationManager extends RelationManager
{
    use HasTranslation;

    protected static string $relationship = 'projects';

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/project-category.rel.project';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(self::trans([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]));
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns(self::trans([
                TextColumn::make('title'),
            ]))
            ->filters([])
            ->headerActions([
                AssociateAction::make()
                    ->modalHeading(self::transFor('label.associate'))
                    ->preloadRecordSelect()
                    ->modalWidth(MaxWidth::ExtraLarge),
            ])
            ->actions([
                DissociateAction::make()
                    ->modalHeading(self::transFor('label.dissociate')),
            ]);
    }
}
