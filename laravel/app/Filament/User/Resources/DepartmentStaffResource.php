<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\DepartmentStaffResource\Pages;
use App\Filament\User\Resources\DepartmentStaffResource\RelationManagers;
use App\Models\DepartmentStaff;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class DepartmentStaffResource extends Resource
{
    protected static ?string $model = DepartmentStaff::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('designation')->nullable(),
                Grid::make(4)->schema([
                    TextInput::make('sc_reg_m')->numeric()->default(0),
                    TextInput::make('sc_reg_f')->numeric()->default(0),
                    TextInput::make('sc_cont_m')->numeric()->default(0),
                    TextInput::make('sc_cont_f')->numeric()->default(0),

                    TextInput::make('st_reg_m')->numeric()->default(0),
                    TextInput::make('st_reg_f')->numeric()->default(0),
                    TextInput::make('st_cont_m')->numeric()->default(0),
                    TextInput::make('st_cont_f')->numeric()->default(0),

                    TextInput::make('obc_reg_m')->numeric()->default(0),
                    TextInput::make('obc_reg_f')->numeric()->default(0),
                    TextInput::make('obc_cont_m')->numeric()->default(0),
                    TextInput::make('obc_cont_f')->numeric()->default(0),

                    TextInput::make('gen_reg_m')->numeric()->default(0),
                    TextInput::make('gen_reg_f')->numeric()->default(0),
                    TextInput::make('gen_cont_m')->numeric()->default(0),
                    TextInput::make('gen_cont_f')->numeric()->default(0),
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
            'index' => Pages\CreateDepartmentStaff::route('/'),
            'edit' => Pages\EditDepartmentStaff::route('/{record}/edit'),
        ];
    }
}
