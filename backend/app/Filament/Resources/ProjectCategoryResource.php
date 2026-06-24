<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\ProjectCategoryResource\Pages\CreateProjectCategory;
use App\Filament\Resources\ProjectCategoryResource\Pages\EditProjectCategory;
use App\Filament\Resources\ProjectCategoryResource\Pages\ListProjectCategories;
use App\Filament\Resources\ProjectCategoryResource\RelationManagers\ProjectsRelationManager;
use App\Models\ProjectCategory;
use App\Support\Filament\HasTranslation;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ProjectCategoryResource extends Resource
{
    use HasNavigationConfig, HasTranslation;

    protected static ?string $model = ProjectCategory::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/project-category';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema(self::trans([
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->maxLength(255)
                                    ->required(),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Section::make()
                            ->visibleOn('edit')
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(ProjectCategory $record) => $record->created_at->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->content(fn(ProjectCategory $record) => $record->updated_at->diffForHumans()),
                            ]),
                    ]),
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns(self::trans([
                TextColumn::make('name')
                    ->searchable(),
            ]));
    }

    public static function getRelations(): array
    {
        return [
            ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectCategories::route('/'),
            'create' => CreateProjectCategory::route('/create'),
            'edit' => EditProjectCategory::route('/{record}/edit'),
        ];
    }
}
