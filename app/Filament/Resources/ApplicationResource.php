<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $slug = 'applications';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_id')
                    ->required()
                    ->integer(),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('status')
                    ->required(),

                TextInput::make('application_message'),

                TextInput::make('cv'),

                TextInput::make('contact_email')
                    ->required(),

                TextInput::make('contact_phone')
                    ->required(),

                TextInput::make('language_proficiency')
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?Application $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Application $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('slug')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_id'),

                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status'),

                TextColumn::make('application_message'),

                TextColumn::make('cv'),

                TextColumn::make('contact_email'),

                TextColumn::make('contact_phone'),

                TextColumn::make('language_proficiency'),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['slug', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
