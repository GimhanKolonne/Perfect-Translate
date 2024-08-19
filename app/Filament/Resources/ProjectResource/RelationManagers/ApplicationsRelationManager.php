<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\Application;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    public function form(Form $form): Form
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
                    ->content(fn(?Application $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Application $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('slug')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
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
            ->headerActions([
                CreateAction::make(),
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
}
