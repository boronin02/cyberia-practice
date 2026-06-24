<?php

namespace App\Filament\Resources;

use App\Enums\ContentBuilder\ContentBuilderBlockEnum;
use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Traits\Forms\Concerns\HasTagsForm;
use App\Filament\Traits\Forms\Contracts\HasTagsForm as HasTagsFormContract;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Author;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

final class PostResource extends Resource implements HasTagsFormContract
{
    use HasNavigationConfig, HasResourceTranslation, HasTagsForm;

    protected static ?string $model = Post::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament/post.sections.information'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label(__('filament/post.fields.title')),
                        RichEditor::make('description')
                            ->label(__('filament/post.fields.description'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                            ])
                            ->maxLength(1024),
                        Forms\Components\TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label(__('filament/post.fields.slug')),
                        Forms\Components\Select::make('authors')
                            ->relationship(titleAttribute: 'full_name')
                            ->options(Author::all()->pluck('full_name', 'id'))
                            ->multiple()
                            ->required()
                            ->label(__('filament/post.fields.authors')),
                        self::getTagsFormComponent(),
                        Forms\Components\Toggle::make('is_published')
                            ->label(__('filament/post.fields.is_published')),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label(__('filament/post.fields.published_at')),
                    ])
                    ->columnSpan(3),
                Forms\Components\Section::make(__('filament/post.sections.marks'))
                    ->schema([
                        Forms\Components\Toggle::make('is_news')
                            ->label(__('filament/post.fields.is_news')),
                        Forms\Components\Toggle::make('is_popular')
                            ->label(__('filament/post.fields.is_popular')),
                    ])
                    ->columnSpan(1),
                Forms\Components\Section::make(__('filament/post.sections.images'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpan(1)
                            ->directory('posts')
                            ->label(__('filament/post.fields.image')),
                        Forms\Components\FileUpload::make('image_preview')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpan(1)
                            ->directory('posts')
                            ->label(__('filament/post.fields.image_preview')),
                    ])
                    ->columns()
                    ->columnSpan('full'),

                Forms\Components\Section::make(__('filament/post.sections.content'))
                    ->schema([
                        Forms\Components\Builder::make('content')
                            ->collapsible()
                            ->cloneable()
                            ->label('')
                            ->addAction(fn(Forms\Components\Actions\Action $action) => $action->icon('heroicon-o-plus')
                                ->iconButton()
                                ->label('')
                                ->outlined()
                            )
                            ->addBetweenAction(fn(Forms\Components\Actions\Action $action
                            ) => $action->icon('heroicon-o-plus')
                                ->iconButton()
                                ->label('')
                                ->outlined()
                            )
                            ->blocks([
                                Block::make(ContentBuilderBlockEnum::PARAGRAPH)
                                    ->label(__('filament/post.builder.block.paragraph.label'))
                                    ->schema([
                                        RichEditor::make('content')
                                            ->label('')
                                            ->enableToolbarButtons([
                                                'h1',
                                            ])
                                            ->disableToolbarButtons([
                                                'attachFiles',
                                            ])
                                            ->required(),
                                    ]),
                                Block::make(ContentBuilderBlockEnum::IMAGE)
                                    ->label(__('filament/post.builder.block.image.label'))
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->image()
                                            ->imageEditor()
                                            ->required()
                                            ->directory('posts')
                                            ->label(''),
                                    ]),

                                Block::make(ContentBuilderBlockEnum::QUOTE)
                                    ->label(__('filament/post.builder.block.quote.label'))
                                    ->schema([
                                        Forms\Components\Select::make('author_id')
                                            ->options(Author::all()->pluck('full_name', 'id'))
                                            ->required()
                                            ->label(__('filament/post.builder.block.quote.author')),
                                        RichEditor::make('quote_content')
                                            ->label(__('filament/post.builder.block.quote.content'))
                                            ->disableToolbarButtons([
                                                'attachFiles',
                                            ])
                                            ->required(),
                                    ]),

                                Block::make(ContentBuilderBlockEnum::HTML)
                                    ->label(__('filament/post.builder.block.html.label'))
                                    ->schema([
                                        Textarea::make('content')
                                            ->required()
                                            ->rows(20)
                                            ->label(__('filament/post.builder.block.html.label')),
                                    ]),
                            ]),
                    ])
                    ->columnSpan('full'),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('filament/post.fields.title')),
                Tables\Columns\TextColumn::make('authors.full_name')
                    ->badge()
                    ->label(__('filament/post.fields.authors')),
                Tables\Columns\TextColumn::make('tags.name')
                    ->badge()
                    ->label(__('filament/post.fields.tags')),
                Tables\Columns\ToggleColumn::make('is_news')
                    ->alignment('center')
                    ->label(__('filament/post.fields.is_news')),
                Tables\Columns\ToggleColumn::make('is_popular')
                    ->alignment('center')
                    ->label(__('filament/post.fields.is_popular')),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->alignment('center')
                    ->label(__('filament/post.fields.is_published')),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(
                        query: fn($query, $direction) => $query
                            ->orderByRaw('CASE WHEN published_at IS NULL THEN 0 ELSE 1 END ASC')
                            ->orderBy('published_at', $direction)
                            ->orderBy('created_at', $direction)
                    )
                    ->label(__('filament/post.fields.published_at')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/post.fields.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/post.fields.updated_at')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('filament/post.fields.deleted_at')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('authors')
                    ->relationship('authors', 'full_name')
                    ->label(__('filament/post.fields.authors')),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label(__('filament/post.fields.is_published')),
                Tables\Filters\TernaryFilter::make('is_news')
                    ->label(__('filament/post.fields.is_news')),
                Tables\Filters\TernaryFilter::make('is_popular')
                    ->label(__('filament/post.fields.is_popular')),
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DateTimePicker::make('from')
                            ->seconds(false)
                            ->label(__('filament/post.filter.published_at.from.label')),
                        Forms\Components\DateTimePicker::make('to')
                            ->seconds(false)
                            ->label(__('filament/post.filter.published_at.to.label')),
                    ])
                    ->indicateUsing(function (array $data) {
                        return array_merge(
                            ($value = $data['from'] ?? null)
                                ? [
                                    'from' => __(
                                        'filament/post.filter.published_at.from.indicator',
                                        ['value' => Carbon::parse($value)->format('d.m.y, H:i')]
                                    ),
                                ]
                                : [],
                            ($value = $data['to'] ?? null)
                                ? [
                                    'to' => __(
                                        'filament/post.filter.published_at.to.indicator',
                                        ['value' => Carbon::parse($value)->format('d.m.y, H:i')]
                                    ),
                                ]
                                : [],
                        );
                    })
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date) => $query->where('published_at', '>=', $date),
                            )
                            ->when(
                                $data['to'],
                                fn(Builder $query, $date) => $query->where('published_at', '<=', $date),
                            );
                    }),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading(__('filament/post.actions.edit.title')),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament/post.actions.delete.title')),
                    Tables\Actions\ForceDeleteAction::make()
                        ->modalHeading(__('filament/post.actions.force-delete.title')),
                    Tables\Actions\RestoreAction::make()
                        ->modalHeading(__('filament/post.actions.restore.title')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament/post.actions.delete-bulk.title')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('filament/post.actions.force-delete-bulk.title')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('filament/post.actions.restore-bulk.title')),
                ]),
            ])
            ->emptyStateHeading(__('filament/post.empty.heading'))
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
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
        return 'post';
    }
}
