<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearchProjectResource\Pages;
use App\Filament\Resources\ResearchProjectResource\RelationManagers;
use App\Models\ResearchProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;


class ResearchProjectResource extends Resource
{
    protected static ?string $model = ResearchProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form                                        
    {
        $hod = auth()->user()->isHod();
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->hidden($hod),

                Select::make('department_id')
                    ->label('Department')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->required()
                    ->hidden($hod),    

                TextInput::make('project_name')
                    ->label('Name of the Scheme/Project/Endowments/Chairs')
                    ->required(),

                TextInput::make('principal_investigator')
                    ->label('Name of the Principal Investigator/Co Investigator (If applicable)')
                    ->nullable(),

                TextInput::make('funding_agency')
                    ->label('Name of the funding agency')
                    ->nullable(),
                 
                Select::make('type')
                ->label('Type')
                ->options(['Government' => 'Government',
                 'Non-Government' => 'Non-Government',])
                ->required(),
                 
                
                TextInput::make('year_of_award')
                ->label('Year of Award')
                ->nullable(),
                
                TextInput::make('funds_provided')
                ->label('Funds Provided (INR in lakhs)')
                ->required(),
                
                TextInput::make('duration')
                ->label('Duration of the Projects')
                ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        $hod = auth()->user()->isHod();
        return $table
            ->columns([
                TextColumn::make('project_name')->label('Name of the Scheme/Project/Endowments/Chairs')->searchable()->sortable(),
                TextColumn::make('principal_investigator')->label('Name of the Principal Investigator/Co Investigator (If applicable)'),
                TextColumn::make('funding_agency')->label('Name of the funding agency'),
                TextColumn::make('user.name')->label('User')->hidden($hod),
                TextColumn::make('department.name')->label('Department'),
                TextColumn::make('type')->label('Type'),
                TextColumn::make('year_of_award')->label('Year of Award'),
                TextColumn::make('funds_provided')->label('Funds Provided (INR in lakhs)'),
                TextColumn::make('duration')->label('Duration of the Projects'),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Department')
                    ->hidden($hod)
                    ->multiple()
                    ->preload()
                    ->placeholder('Select Department'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\createResearchProject::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()
            ->where('user_id', $user->id);
    }
}
