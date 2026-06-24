<?php

namespace App\Filament\Resources;

use App\Enums\Media\MediaCollectionType;
use App\Filament\Concerns\HasNavigationConfig;
use App\Filament\Resources\BannerResource\Pages\CreateBanner;
use App\Filament\Resources\BannerResource\Pages\EditBanner;
use App\Filament\Resources\BannerResource\Pages\ListBanners;
use App\Models\Banner;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasTranslation;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

final class BannerResource extends Resource
{
    use HasActions, HasNavigationConfig, HasTranslation;

    protected static ?string $model = Banner::class;

    public static function getTranslateModelName(): string
    {
        return 'filament/resources/banner';
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
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->maxLength(65535),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Section::make()
                            ->schema([
                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::BannerDesktop->value)
                                    ->collection(MediaCollectionType::BannerDesktop->value)
                                    ->image()
                                    ->imageEditor()
                                    ->required(),

                                SpatieMediaLibraryFileUpload::make(MediaCollectionType::BannerMobile->value)
                                    ->collection(MediaCollectionType::BannerMobile->value)
                                    ->image()
                                    ->imageEditor()
                                    ->required(),
                            ]),

                        Section::make()
                            ->visibleOn('edit')
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(fn(Banner $record) => $record->created_at->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->content(fn(Banner $record) => $record->updated_at->diffForHumans()),
                            ]),
                    ]),
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->contentGrid(['md' => 2, 'xl' => 3])
            ->paginated([9, 18, 27])
            ->columns([
                Stack::make([
                    SpatieMediaLibraryImageColumn::make(MediaCollectionType::BannerDesktop->value)
                        ->collection(MediaCollectionType::BannerDesktop->value)
                        ->height('100%')
                        ->width('100%'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
