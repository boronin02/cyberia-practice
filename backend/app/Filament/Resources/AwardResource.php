<?php

namespace App\Filament\Resources;

use App\Enums\Media\MediaCollectionType;
use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\AwardResource\Pages\CreateAward;
use App\Filament\Resources\AwardResource\Pages\EditAward;
use App\Filament\Resources\AwardResource\Pages\ListAwards;
use App\Models\Award;
use App\Rules\SquareImageRule;
use App\Support\Filament\Enums\ActionType;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasTranslation;
use Exception;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class AwardResource extends Resource
{
    use HasActions, HasNavigationConfig, HasTranslation;

    protected static ?string $model = Award::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/award';
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
                                TextInput::make('title')
                                    ->maxLength(255)
                                    ->required(),
                                Textarea::make('description')
                                    ->maxLength(1024)
                                    ->autosize(),

                                Select::make('project_id')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('project', 'title'),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Section::make()
                            ->schema([
                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::AwardImage->value)
                                    ->collection(MediaCollectionType::AwardImage->value)
                                    ->image()
                                    ->imageEditor()
                                    ->required(),

                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::AwardIcon->value)
                                    ->collection(MediaCollectionType::AwardIcon->value)
                                    ->image()
                                    ->imageEditor()
                                    ->required()
                                    ->imageCropAspectRatio('1:1')
                                    ->rule(new SquareImageRule),
                            ]),

                        Section::make()
                            ->visibleOn('edit')
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(Award $record) => $record->created_at->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->content(fn(Award $record) => $record->updated_at->diffForHumans()),
                            ]),
                    ]),
            ]));
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(self::transFor('label.empty_table'))
            ->reorderable('order')
            ->columns(
                self::trans([
                    TextColumn::make('title')
                        ->searchable(),
                    TextColumn::make('project.title'),
                ], doSnake: true)
            )
            ->filters(
                self::trans([
                    SelectFilter::make('project.title')
                        ->name('project_id')
                        ->relationship('project', 'title')
                        ->preload()
                        ->searchable(),
                ], doSnake: true)
            )
            ->actions(self::getBaseActions(ActionType::Table, ['edit', 'delete']))
            ->bulkActions(self::getBaseActions(ActionType::TableBulk, ['delete_bulk']));
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAwards::route('/'),
            'create' => CreateAward::route('/create'),
            'edit' => EditAward::route('/{record}/edit'),
        ];
    }
}
