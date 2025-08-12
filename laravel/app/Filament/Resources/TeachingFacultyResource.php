<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeachingFacultyResource\Pages;
use App\Filament\Resources\TeachingFacultyResource\RelationManagers;
use App\Models\TeachingFaculty;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class TeachingFacultyResource extends Resource
{
    protected static ?string $model = TeachingFaculty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Faculty & Staff';
    protected static ?int $navigationSort = 2;

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

                TextInput::make('name')
                    ->required(),

                

                    TextInput::make('designation')
                    ->label('Designation')
                    ->nullable(),

                TextInput::make('degree_university_institution')
                    ->label('Degree & University/Institution from which awarded(PG & Research Degree Only)')
                    ->nullable(),

                TextInput::make('subject_specialization')
                    ->label('Subject Specialization')
                    ->nullable(),
            ]);
                
    }
        

    public static function table(Table $table): Table
    {
        $hod = auth()->user()->isHod();
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('designation')->label('Designation'),
                TextColumn::make('degree_university_institution')->label('Degree & University/Institution from which awarded(PG & Research Degree Only)'),
                TextColumn::make('subject_specialization'),
                TextColumn::make('user.name')->label('User')->hidden($hod),
                TextColumn::make('department.name')->label('Department')->hidden($hod),
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
            'index' => Pages\ManageTeachingFaculty::route('/'),
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