<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolDepartmentDetailResource\Pages;
use App\Models\SchoolDepartmentDetail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolDepartmentDetailResource extends Resource
{
    protected static ?string $model = SchoolDepartmentDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'School & Department Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('school_name')->required(),
                TextInput::make('year_of_establishment')->numeric(),
                TextInput::make('year_of_first_intake')->numeric(),
                TextInput::make('head_of_department'),
                TextInput::make('department_phone'),
                TextInput::make('residence_phone'),
                TextInput::make('email')->email(),
                TextInput::make('department_fax'),
                Textarea::make('brief_introduction')->label('Brief Introduction (max 150 words)')->maxLength(150),
                TextInput::make('number_of_visiting_fellows')->numeric(),
                TextInput::make('student_intake_capacity')->numeric(),
                TextInput::make('number_of_patents_received')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_name')->searchable(),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('year_of_establishment'),
                TextColumn::make('head_of_department'),
                TextColumn::make('email'),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSchoolDepartmentDetails::route('/'),
        ];
    }
}
