<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Traits\HasResourceTranslation;
use App\Models\Feedback;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    use HasResourceTranslation;

    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('filament/feedback.fields.name')),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label(__('filament/feedback.fields.phone')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('filament/feedback.fields.created_at')),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->modalHeading(__('filament/feedback.actions.view.title')),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament/feedback.actions.delete.title')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament/feedback.actions.delete-bulk.title')),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns()
            ->schema([
                TextEntry::make('name')
                    ->label(__('filament/feedback.fields.name')),
                TextEntry::make('phone')
                    ->label(__('filament/feedback.fields.phone')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('filament/feedback.fields.created_at')),
                TextEntry::make('comment')
                    ->columnSpan(2)
                    ->label(__('filament/feedback.fields.comment'))
                    ->visible(fn(Feedback $record) => $record->comment),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeedback::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament/navigation.feedback');
    }

    public static function getTranslateModelName(): string
    {
        return 'feedback';
    }
}
