<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolDetailsResource\Pages;
use App\Filament\Resources\SchoolDetailsResource\RelationManagers;
use App\Models\SchoolDetails;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SchoolDetailsResource extends Resource
{
    protected static ?string $model = SchoolDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Introduction';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('users', 'name')
                    ->default(auth()->user()->id)
                    ->required(), 

                
                    Select::make('name_of_department')
                    ->label('Name of Department')
                    ->relationship('department', 'name_of_department') // relation name + column to show
                    ->default(auth()->user()->id)
                    ->required(), 


                    TextInput::make('name_of_school')
                    ->required(),
                   

                    TextInput::make('year_of_establishment')
                        ->numeric()
                        ->minValue(1900)
                        ->maxValue(now()->year)
                        ->nullable(),
    
                    TextInput::make('year_of_first_intake')
                        ->numeric()
                        ->minValue(1900)
                        ->maxValue(now()->year)
                        ->nullable(),
    
                    TextInput::make('head_of_department')
                        ->nullable(),
    
                    TextInput::make('department_phone')
                        ->tel()
                        ->nullable(),
    
                    TextInput::make('residence_phone')
                        ->tel()
                        ->nullable(),
    
                    TextInput::make('email')
                        ->email()
                        ->nullable(),
    
                    TextInput::make('department_fax')
                        ->nullable(),
    
                    TextInput::make('number_of_visiting_fellows')
                        ->numeric()
                        ->nullable(),
    
                    Textarea::make('brief_introduction')
                        ->columnSpanFull()
                        ->rows(4)
                        ->autosize()
                        ->nullable(),
    
    
                    TextInput::make('student_intake_capacity')
                        ->numeric()
                        ->nullable(),
    
                    TextInput::make('number_of_patents_received')
                        ->numeric()
                        ->nullable(),
                ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('name_of_department'),
                TextColumn::make('head_of_department'),
                TextColumn::make('year_of_establishment'),
                TextColumn::make('email')->copyable(),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ManageSchoolDetails::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()
            ->where('id', $user->department_id);
    }
}
