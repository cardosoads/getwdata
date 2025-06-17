<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceivedDataResource\Pages;
use App\Models\ReceivedData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ReceivedDataResource extends Resource
{
    protected static ?string $model = ReceivedData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campos de formulário (se necessário)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('payload')
                    ->label('Payload')
                    ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                    ->wrap()
                    ->limit(300),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filtros adicionais
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Sobrescreve a query para filtrar apenas registros
     * cujo user_identifier bata com Auth::user()->identifier.
     */
    public static function getEloquentQuery(): Builder
    {
        $userIdentifier = Auth::user()?->identifier;

        return parent::getEloquentQuery()
            ->where('user_identifier', $userIdentifier);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListReceivedData::route('/'),
//            'create' => Pages\CreateReceivedData::route('/create'),
            'edit'   => Pages\EditReceivedData::route('/{record}/edit'),
        ];
    }
}
