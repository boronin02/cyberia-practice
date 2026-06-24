<?php

namespace App\Filament\Resources;

use App\Enums\Contacts\ContactKey;
use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Contact;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactResource extends Resource
{
    use HasResourceTranslation;

    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('value')
                    ->columnSpanFull()
                    ->label(__('filament/contact.fields.value'))
                    ->afterStateUpdated(function (Get $get, Set $set, string|array|null $old, string $state): void {
                        $coordinates = explode(',', $state);
                        $set('location', ['lat' => $coordinates[0] ?? null, 'lng' => $coordinates[1] ?? null]);
                    }),
                Map::make('location')
                    ->label(false)
                    ->columnSpanFull()
                    ->liveLocation()
                    ->afterStateUpdated(function (Get $get, Set $set, string|array|null $old, ?array $state): void {
                        $set('value', $state['lat'] . ',' . $state['lng']);
                    })
                    ->afterStateHydrated(function ($state, $record, Set $set): void {
                        $coordinates = explode(',', $record->value);
                        $set('location', ['lat' => $coordinates[0] ?? null, 'lng' => $coordinates[1] ?? null]);
                    })
                    ->showMarker()
                    ->showZoomControl()
                    ->draggable()
                    ->zoom(15)
                    ->detectRetina()
                    ->showMyLocationButton()
                    ->extraTileControl([])
                    ->visible(fn(Contact $contact): bool => $contact->key === ContactKey::COORDS),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->state(fn(Contact $contact): string => __('filament/contact.labels.' . $contact->key))
                    ->label(__('filament/contact.fields.key')),
                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament/contact.fields.value')),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(
                        fn(Contact $contact): string => __('filament/contact.actions.edit.title') . ' - ' . __('filament/contact.labels.' . $contact->key)
                    ),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContacts::route('/'),
        ];
    }

    public static function getTranslateModelName(): string
    {
        return 'contact';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.contacts');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
