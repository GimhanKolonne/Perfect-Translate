<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $slug = 'portfolios';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('translator_id')
                    ->required()
                    ->integer(),

                TextInput::make('title')
                    ->required(),

                TextInput::make('role_description')
                    ->required(),

                TextInput::make('overview')
                    ->required(),

                TextInput::make('relevant_skills')
                    ->required(),

                TextInput::make('tags')
                    ->required(),

                FileUpload::make('media')
                    ->label('Media')
                    ->directory('portfolios/media')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                    ->multiple() // Allow multiple file uploads
                    ->maxFiles(5) // Set a limit on the number of files
                    ->columnSpanFull(),

                TextInput::make('detailed_description')
                    ->required(),

                TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('translator_id'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role_description'),

                TextColumn::make('overview'),

                TextColumn::make('relevant_skills'),

                TextColumn::make('tags'),

                ViewColumn::make('media')
                    ->label('Media')
                    ->view('filament.resources.portfolio-resource.pages.media-view'),

                TextColumn::make('detailed_description'),

                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }
}
