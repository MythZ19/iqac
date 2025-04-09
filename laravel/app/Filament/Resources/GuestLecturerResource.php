<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestLecturerResource\Pages;
use App\Filament\Resources\GuestLecturerResource\RelationManagers;
use App\Models\GuestLecturer;
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

class GuestLecturerResource extends Resource
{
    protected static ?string $model = GuestLecturer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Faculty & Staff';

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

                TextInput::make('research_degrees')
                    ->label('Research Degrees')
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
                TextColumn::make('research_degrees')->label('Research Degrees'),
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
            'index' => Pages\ManageGuestLecturers::route('/'),
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
