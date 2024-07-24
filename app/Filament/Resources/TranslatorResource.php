<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslatorResource\Pages;
use App\Models\Translator;
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
class TranslatorResource extends Resource
{
    protected static ?string $model = Translator::class;
    protected static ?string $slug = 'translators';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('type_of_translator')->required(),
                TextInput::make('language_pairs')->required(),
                TextInput::make('years_of_experience')->required(),
                TextInput::make('rate_per_word')->required(),
                TextInput::make('rate_per_hour')->required(),
                TextInput::make('availability')->required(),
                TextInput::make('bio')->required(),
                TextInput::make('slug')->required(),
                TextInput::make('status')->required(),
                TextInput::make('user_id')->required(),
                TextInput::make('verification_status')->required(),
                FileUpload::make('certificate_path')->label('Certificate')
                    ->directory('certificates')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_of_translator'),
                TextColumn::make('language_pairs'),
                TextColumn::make('years_of_experience'),
                TextColumn::make('rate_per_word'),
                TextColumn::make('rate_per_hour'),
                TextColumn::make('availability'),
                TextColumn::make('bio'),
                TextColumn::make('slug')->searchable()->sortable(),
                TextColumn::make('status'),
                TextColumn::make('user_id'),
                ViewColumn::make('certificate_path')->label('Certificate')->view('filament.resources.translator-resource.pages.certificate'),
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
            'index' => Pages\ListTranslators::route('/'),
            'create' => Pages\CreateTranslator::route('/create'),
            'edit' => Pages\EditTranslator::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['slug'];
    }
}
