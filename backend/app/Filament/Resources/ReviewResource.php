<?php

namespace App\Filament\Resources;

use App\Enums\Media\MediaCollectionType;
use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\ReviewResource\Pages\CreateReview;
use App\Filament\Resources\ReviewResource\Pages\EditReview;
use App\Filament\Resources\ReviewResource\Pages\ListReviews;
use App\Models\Review;
use App\Support\Filament\Enums\ActionType;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasTranslation;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class ReviewResource extends Resource
{
    use HasActions, HasNavigationConfig, HasTranslation;

    protected static ?string $model = Review::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/review';
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
                                TextInput::make('fio')
                                    ->maxLength(255)
                                    ->required(),

                                Select::make('project_id')
                                    ->relationship('project', 'title')
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                TextInput::make('position')
                                    ->maxLength(255),

                                MarkdownEditor::make('content')
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                        'table',
                                    ])
                                    ->maxLength(510)
                                    ->required(),
                            ]),
                    ]),
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Section::make()
                            ->schema([
                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::ReviewImage->value)
                                    ->collection(MediaCollectionType::ReviewImage->value)
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(2048),

                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::ReviewDocument->value)
                                    ->collection(MediaCollectionType::ReviewDocument->value)
                                    ->preserveFilenames()
                                    ->openable()
                                    ->visible()
                                    ->maxSize(10240),
                            ]),

                        Section::make()
                            ->visibleOn('edit')
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(Review $record) => $record->created_at->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->content(fn(Review $record) => $record->updated_at->diffForHumans()),
                            ]),
                    ]),
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns(self::trans([
                TextColumn::make('project.title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fio')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('content')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->sortable(),
            ], doSnake: true))
            ->filters([])
            ->actions(self::getBaseActions(ActionType::Table, ['edit', 'delete']))
            ->bulkActions(self::getBaseActions(ActionType::TableBulk, ['delete_bulk']));
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviews::route('/'),
            'create' => CreateReview::route('/create'),
            'edit' => EditReview::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['project']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['fio', 'project.title'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->project) {
            $details['Project'] = $record->project->title;
        }

        return $details;
    }
}
