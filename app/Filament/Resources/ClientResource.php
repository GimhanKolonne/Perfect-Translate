<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $slug = 'clients';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')
                    ->required(),

                TextInput::make('contact_name')
                    ->required(),

                TextInput::make('contact_phone')
                    ->required(),

                TextInput::make('company_address')
                    ->required(),

                TextInput::make('country')
                    ->required(),

                TextInput::make('website')
                    ->required(),

                TextInput::make('industry')
                    ->required(),

                TextInput::make('bio')
                    ->required(),

                TextInput::make('slug')
                    ->required(),

                TextInput::make('user_id')
                    ->required(),
                TextInput::make('verification_status')->required(),
                FileUpload::make('document_path')
                    ->label('Documents')
                    ->directory('documents')
                    ->acceptedFileTypes(['application/pdf'])
                    ->multiple() // Allow multiple file uploads
                    ->maxFiles(5) // Set a limit on the number of files
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name'),

                TextColumn::make('contact_name'),

                TextColumn::make('contact_phone'),

                TextColumn::make('company_address'),

                TextColumn::make('country'),

                TextColumn::make('website'),

                TextColumn::make('industry'),

                TextColumn::make('bio'),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user_id'),
                ViewColumn::make('document_path')->label('Documents')->view('filament.resources.client-resource.pages.document'),
                TextColumn::make('verification_status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                VerifyClientAction::make(),
                RemoveClientVerifyAction::make(),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['slug'];
    }
}
