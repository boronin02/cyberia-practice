<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\TagResource\Pages\CreateTag;
use App\Filament\Resources\TagResource\Pages\EditTag;
use App\Filament\Resources\TagResource\Pages\ListTags;
use App\Models\Tag;
use App\Support\Filament\Enums\ActionType;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasTranslation;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class TagResource extends Resource
{
    use HasActions, HasNavigationConfig, HasTranslation;

    protected static ?string $model = Tag::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/tag';
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
                                    ->unique(ignoreRecord: true)
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
                                    ->content(fn(Tag $record) => $record->created_at->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->content(fn(Tag $record) => $record->updated_at->diffForHumans()),
                            ]),
                    ]),
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(self::transFor('label.empty_table'))
            ->columns(
                self::trans([
                    TextColumn::make('name')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ], doSnake: true)
            )
            ->actions(self::getBaseActions(
                ActionType::Table,
                list: ['edit', 'delete'],
                callbacks: [
                    'delete' => [
                        'disabled' => static function (Tag $record) {
                            return $record->posts_exists;
                        },
                    ],
                ]
            ))
            ->bulkActions(self::getBaseActions(ActionType::TableBulk, ['delete_bulk']));
    }

    public static function getEloquentQuery(): Builder
    {
        /** @var Builder|Tag $query */
        $query = parent::getEloquentQuery();

        return $query
            ->withExists('posts');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
