<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentStaffResource\Pages;
use App\Filament\Resources\DepartmentStaffResource\RelationManagers;
use App\Models\DepartmentStaff;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentStaffResource extends Resource
{
    protected static ?string $model = DepartmentStaff::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // Assuming users table has a 'name'
                    ->required(),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('designation'),
                TextColumn::make('total_reg_m')->label('Total Reg M'),
                TextColumn::make('total_reg_f')->label('Total Reg F'),
                TextColumn::make('total_cont_m')->label('Total Cont M'),
                TextColumn::make('total_cont_f')->label('Total Cont F'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDepartmentStaff::route('/'),
        ];
    }
}
