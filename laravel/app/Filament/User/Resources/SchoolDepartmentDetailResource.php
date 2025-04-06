<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SchoolDepartmentDetailResource\Pages;
use App\Filament\User\Resources\SchoolDepartmentDetailResource\Pages\CreateSchoolDepartmentDetail;
use App\Models\SchoolDepartmentDetail;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                TextInput::make('school_name')->required(),
                TextInput::make('year_of_establishment')->numeric(),
                TextInput::make('year_of_first_intake')->numeric(),
                TextInput::make('head_of_department'),
                TextInput::make('department_phone'),
                TextInput::make('residence_phone'),
                TextInput::make('email')->email(),
                TextInput::make('department_fax'),
                Textarea::make('brief_introduction')
                        ->label('Brief Introduction (max 150 words)')
                        ->maxLength(150)
                        ->autosize(),
                TextInput::make('number_of_visiting_fellows')->numeric(),
                TextInput::make('student_intake_capacity')->numeric(),
                TextInput::make('number_of_patents_received')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => CreateSchoolDepartmentDetail::route('/'),
            'edit' => Pages\EditSchoolDepartmentDetail::route('/{record}/edit'),
        ];
    }
}
