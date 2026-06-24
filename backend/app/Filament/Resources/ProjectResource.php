<?php

namespace App\Filament\Resources;

use App\Enums\ContentBuilder\ContentBuilderBlockEnum;
use App\Enums\Media\MediaCollectionType;
use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Author;
use App\Models\Project;
use App\Support\Filament\Enums\ActionType;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasTranslation;
use App\Support\Helpers\RegexHelper;
use DB;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

final class ProjectResource extends Resource
{
    use HasActions, HasNavigationConfig, HasTranslation;

    protected static ?string $model = Project::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/project';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema(
                self::trans([
                    Group::make()
                        ->columnSpan(['lg' => 2])
                        ->schema([
                            Tabs::make()
                                ->tabs([
                                    Tab::make(self::transFor('sections.information'))
                                        ->schema([
                                            Group::make()
                                                ->columns(2)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->maxLength(255)
                                                        ->required(),
                                                    TextInput::make('slug')
                                                        ->maxLength(255)
                                                        ->required()
                                                        ->unique(ignoreRecord: true)
                                                        ->regex('/^[a-z0-9-]+$/'),
                                                ]),

                                            Select::make('project_category_id')
                                                ->relationship('projectCategory', 'name')
                                                ->searchable()
                                                ->preload(),

                                            Textarea::make('description')
                                                ->maxLength(65000)
                                                ->required(),
                                            TextInput::make('price')
                                                ->numeric()
                                                ->prefix('₽')
                                                ->required(),
                                            TextInput::make('time')
                                                ->prefixIcon('heroicon-o-clock')
                                                ->maxLength(255)
                                                ->required(),
                                            TextInput::make('link')
                                                ->prefixIcon('heroicon-o-globe-alt')
                                                ->maxLength(255)
                                                ->url()
                                                ->required(),
                                            TextInput::make('order')
                                                ->required()
                                                ->numeric()
                                                ->default(fn() => (Project::query()->orderByDesc('order')->first()?->order ?? 0) + 1)
                                                ->afterStateUpdated(function ($record, $state, $set) {
                                                    if ($record) {
                                                        $newOrder = (int)$state;
                                                        static::reorderColumn($record, $newOrder, 'order');
                                                        $set('order', $newOrder);
                                                    }
                                                })
                                                ->live(onBlur: true),
                                            TextInput::make('home_order')
                                                ->requiredIf('show_on_home', 'true')
                                                ->numeric()
                                                ->disabled(fn(Get $get) => !$get('show_on_home'))
                                                ->afterStateUpdated(function ($record, $state, $set) {
                                                    if ($record && $state !== null) {
                                                        $newOrder = (int)$state;
                                                        static::reorderColumn($record, $newOrder, 'home_order');
                                                        $set('home_order', $newOrder);
                                                    }
                                                })
                                                ->live(onBlur: true),

                                        ]),
                                    Tab::make(self::transFor('sections.content'))
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
                                                ->addBetweenAction(fn(Forms\Components\Actions\Action $action) => $action->icon('heroicon-o-plus')
                                                    ->iconButton()
                                                    ->label('')
                                                    ->outlined()
                                                )
                                                ->blocks([
                                                    Block::make(ContentBuilderBlockEnum::PARAGRAPH)
                                                        ->label(__('filament/project.builder.block.paragraph.label'))
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
                                                        ->label(__('filament/project.builder.block.image.label'))
                                                        ->schema([
                                                            Forms\Components\FileUpload::make('image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->required()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->helperText(new HtmlString('Ширина от <strong>750px</strong>. Высота не имеет значение.')),
                                                        ]),
                                                    Block::make(ContentBuilderBlockEnum::IMAGE_TEXT)
                                                        ->label(__('filament/project.builder.block.image.label'))
                                                        ->schema([
                                                            Forms\Components\FileUpload::make('image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->required()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->helperText(new HtmlString('Ширина от <strong>400px</strong>. Высота не имеет значение. Изображение будет обрезано по низу блока')),
                                                            Forms\Components\ColorPicker::make('background_color')
                                                                ->rgba()
                                                                ->regex(RegexHelper::rgba()),
                                                            RichEditor::make('text')
                                                                ->label(__('filament/project.builder.block.review.text'))
                                                                ->enableToolbarButtons([
                                                                    'h1',
                                                                ])
                                                                ->disableToolbarButtons([
                                                                    'attachFiles',
                                                                ])
                                                                ->required(),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::QUOTE)
                                                        ->label(__('filament/project.builder.block.quote.label'))
                                                        ->schema([
                                                            Forms\Components\Select::make('author_id')
                                                                ->options(Author::all()->pluck('full_name', 'id'))
                                                                ->required()
                                                                ->label(__('filament/project.builder.block.quote.author')),
                                                            RichEditor::make('quote_content')
                                                                ->label(__('filament/project.builder.block.quote.content'))
                                                                ->disableToolbarButtons([
                                                                    'attachFiles',
                                                                ])
                                                                ->required(),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::QUOTE_ANOTHER_AUTHOR)
                                                        ->label(__('filament/project.builder.block.quote.label'))
                                                        ->schema([
                                                            Forms\Components\TextInput::make('name')
                                                                ->required()
                                                                ->maxLength(250),
                                                            Forms\Components\TextInput::make('position')
                                                                ->required()
                                                                ->maxLength(250),
                                                            RichEditor::make('quote_content')
                                                                ->disableToolbarButtons([
                                                                    'attachFiles',
                                                                ])
                                                                ->required(),
                                                            Forms\Components\FileUpload::make('avatar')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->imageCropAspectRatio('1:1')
                                                                ->helperText(new HtmlString('Соотношение сторон <strong>1:1</strong>. Ширина от <strong>44px</strong>.')),
                                                            Forms\Components\FileUpload::make('background_image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->helperText(new HtmlString('Ширина от <strong>1300px</strong>. Высота по содержимому.')),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::REVIEW)
                                                        ->label(__('filament/project.builder.block.review.label'))
                                                        ->schema([
                                                            RichEditor::make('text')
                                                                ->label(__('filament/project.builder.block.review.text'))
                                                                ->disableToolbarButtons([
                                                                    'attachFiles',
                                                                ])
                                                                ->required(),
                                                            Forms\Components\TextInput::make('name')
                                                                ->label(__('filament/project.builder.block.name.name'))
                                                                ->required()
                                                                ->maxLength(250),
                                                            Forms\Components\TextInput::make('position')
                                                                ->label(__('filament/project.builder.block.name.position'))
                                                                ->required()
                                                                ->maxLength(250),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::HTML)
                                                        ->label(__('filament/project.builder.block.html.label'))
                                                        ->schema([
                                                            Textarea::make('content')
                                                                ->required()
                                                                ->rows(20)
                                                                ->label(__('filament/project.builder.block.html.label')),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::PROBLEMS_AND_GOALS)
                                                        ->schema([
                                                            Forms\Components\FileUpload::make('image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->required()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->helperText(new HtmlString('Ширина от <strong>200px</strong>.')),
                                                            Forms\Components\FileUpload::make('background_image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->helperText(new HtmlString('Ширина от <strong>1300px</strong>. Высота по содержимому.')),
                                                            Forms\Components\ColorPicker::make('color')
                                                                ->rgba()
                                                                ->regex(RegexHelper::rgba())
                                                                ->required(),
                                                            RichEditor::make('text')
                                                                ->enableToolbarButtons([
                                                                    'h1',
                                                                ])
                                                                ->disableToolbarButtons([
                                                                    'attachFiles',
                                                                ])
                                                                ->required(),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::STAGES_OF_WORK)
                                                        ->schema([
                                                            Forms\Components\Repeater::make('stages_of_work')
                                                                ->defaultItems(6)
                                                                ->minItems(6)
                                                                ->maxItems(6)
                                                                ->collapsible()
                                                                ->deletable(false)
                                                                ->schema([
                                                                    Textarea::make('title')
                                                                        ->maxLength(255)
                                                                        ->required(),
                                                                    Group::make()
                                                                        ->columns(2)
                                                                        ->schema([
                                                                            Forms\Components\ColorPicker::make('title_color')
                                                                                ->rgba()
                                                                                ->regex(RegexHelper::rgba())
                                                                                ->required(),
                                                                            Forms\Components\ColorPicker::make('background_color')
                                                                                ->rgba()
                                                                                ->regex(RegexHelper::rgba())
                                                                                ->required(),
                                                                        ]),
                                                                    RichEditor::make('text')
                                                                        ->enableToolbarButtons([
                                                                            'h1',
                                                                        ])
                                                                        ->disableToolbarButtons([
                                                                            'attachFiles',
                                                                        ])
                                                                        ->required(),
                                                                ]),
                                                        ]),

                                                    Block::make(ContentBuilderBlockEnum::LITERACY)
                                                        ->schema([
                                                            Forms\Components\FileUpload::make('background_image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->imageCropAspectRatio('2:1')
                                                                ->helperText(new HtmlString('Соотношение сторон <strong>2:1</strong>. Ширина от <strong>1300px</strong>. Высота от <strong>660px</strong>.')),
                                                            Forms\Components\FileUpload::make('document_image')
                                                                ->image()
                                                                ->imageEditor()
                                                                ->directory('projects')
                                                                ->label('')
                                                                ->required()
                                                                ->helperText(new HtmlString('Любое изображение, будет вписано внутрь блока.')),
                                                        ]),
                                                ]),
                                        ]),
                                ]),
                        ]),

                    Group::make()
                        ->schema([
                            Section::make(self::transFor('sections.marks'))
                                ->schema([
                                    Toggle::make('is_big'),
                                    Toggle::make('show_on_home')
                                        ->live(),
                                ]),

                            Section::make(self::transFor('sections.images'))
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('image')
                                        ->collection(MediaCollectionType::ProjectImage->value)
                                        ->required()
                                        ->image()
                                        ->imageEditor(),
                                    SpatieMediaLibraryFileUpload::make('image_mobile')
                                        ->collection(MediaCollectionType::ProjectImageMobile->value)
                                        ->required()
                                        ->image()
                                        ->imageEditor(),
                                    SpatieMediaLibraryFileUpload::make('project_video_cover')
                                        ->collection(MediaCollectionType::ProjectVideoCover->value)
                                        ->acceptedFileTypes(MediaCollectionType::ProjectVideoCover->allowedMimeTypes()),
                                ]),
                        ]),
                ])
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                self::trans([
                    TextColumn::make('title')
                        ->searchable()
                        ->limit(60),
                    ToggleColumn::make('show_on_home'),
                    ToggleColumn::make('is_big'),
                    TextInputColumn::make('order')
                        ->rules(['required', 'min:0', 'numeric'])
                        ->sortable()
                        ->updateStateUsing(function ($state, $record) {
                            static::reorderColumn($record, (int)$state, 'order');

                            return $state;
                        }),
                    TextInputColumn::make('home_order')
                        ->rules(['required', 'min:0', 'numeric'])
                        ->sortable()
                        ->disabled(fn(Project $record) => !$record->show_on_home)
                        ->updateStateUsing(function ($state, $record) {
                            static::reorderColumn($record, (int)$state, 'home_order');

                            return $state;
                        }),
                    IconColumn::make('is_case')
                        ->boolean(),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('deleted_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
            )
            ->filters([
                TrashedFilter::make(),
            ])
            ->defaultSort('home_order')
            ->actions(self::getBaseActions(ActionType::Table, list: ['edit', 'delete', 'force_delete', 'restore'], isGroup: true))
            ->bulkActions(
                self::getBaseActions(
                    ActionType::TableBulk,
                    list: ['delete_bulk', 'force_delete_bulk', 'restore_bulk'],
                    isGroup: true
                )
            );
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static function reorderColumn($record, int $newOrder, string $columnName): void
    {
        $oldOrder = $record->getOriginal($columnName) ?? 999999;

        if ($oldOrder === $newOrder) {
            return;
        }

        DB::transaction(function () use ($record, $newOrder, $oldOrder, $columnName) {
            $model = get_class($record);
            $modelKeyName = $record->getKeyName();
            $wrappedModelKeyName = $record->getConnection()->getQueryGrammar()->wrap($modelKeyName);

            $existingRecord = $model::where('id', '!=', $record->id)
                ->where($columnName, $newOrder)
                ->first();

            if ($existingRecord) {
                if ($oldOrder < $newOrder) {
                    $affectedRecords = $model::where('id', '!=', $record->id)
                        ->where($columnName, '>', $oldOrder)
                        ->where($columnName, '<=', $newOrder)
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->{$modelKeyName} => $item->{$columnName}]);

                    $cases = $affectedRecords
                        ->map(function ($currentOrder, $recordKey) use ($wrappedModelKeyName) {
                            return 'when ' . $wrappedModelKeyName . ' = ' . DB::getPdo()->quote($recordKey) . ' then ' . ($currentOrder - 1);
                        })
                        ->implode(' ');

                    if ($cases) {
                        $model::whereIn($modelKeyName, $affectedRecords->keys())
                            ->update([
                                $columnName => DB::raw('case ' . $cases . ' end'),
                            ]);
                    }
                } else {
                    $affectedRecords = $model::where('id', '!=', $record->id)
                        ->where($columnName, '>=', $newOrder)
                        ->where($columnName, '<', $oldOrder)
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->{$modelKeyName} => $item->{$columnName}]);

                    $cases = $affectedRecords
                        ->map(function ($currentOrder, $recordKey) use ($wrappedModelKeyName) {
                            return 'when ' . $wrappedModelKeyName . ' = ' . DB::getPdo()->quote($recordKey) . ' then ' . ($currentOrder + 1);
                        })
                        ->implode(' ');

                    if ($cases) {
                        $model::whereIn($modelKeyName, $affectedRecords->keys())
                            ->update([
                                $columnName => DB::raw('case ' . $cases . ' end'),
                            ]);
                    }
                }
            } else {
                if ($newOrder < $oldOrder) {
                    $affectedRecords = $model::where('id', '!=', $record->id)
                        ->where($columnName, '>=', $newOrder)
                        ->where($columnName, '<', $oldOrder)
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->{$modelKeyName} => $item->{$columnName}]);

                    $cases = $affectedRecords
                        ->map(function ($currentOrder, $recordKey) use ($wrappedModelKeyName) {
                            return 'when ' . $wrappedModelKeyName . ' = ' . DB::getPdo()->quote($recordKey) . ' then ' . ($currentOrder + 1);
                        })
                        ->implode(' ');

                    if ($cases) {
                        $model::whereIn($modelKeyName, $affectedRecords->keys())
                            ->update([
                                $columnName => DB::raw('case ' . $cases . ' end'),
                            ]);
                    }
                } else {
                    $affectedRecords = $model::where('id', '!=', $record->id)
                        ->where($columnName, '>', $oldOrder)
                        ->where($columnName, '<=', $newOrder)
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->{$modelKeyName} => $item->{$columnName}]);

                    $cases = $affectedRecords
                        ->map(function ($currentOrder, $recordKey) use ($wrappedModelKeyName) {
                            return 'when ' . $wrappedModelKeyName . ' = ' . DB::getPdo()->quote($recordKey) . ' then ' . ($currentOrder - 1);
                        })
                        ->implode(' ');

                    if ($cases) {
                        $model::whereIn($modelKeyName, $affectedRecords->keys())
                            ->update([
                                $columnName => DB::raw('case ' . $cases . ' end'),
                            ]);
                    }
                }
            }

            $record->update([$columnName => $newOrder]);
        });
    }
}
