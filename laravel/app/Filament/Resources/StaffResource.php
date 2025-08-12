<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\staff;
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

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Faculty & Staff';  
    protected static ?int $navigationSort = 4;

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

                    TextInput::make('sc_reg_m')
                    ->label('sc reg m')
                    ->nullable(),

                    TextInput::make('sc_reg_f')
                    ->label('sc reg f')
                    ->nullable(),

                    TextInput::make('sc_cont_m')
                    ->label('sc cont m')
                    ->nullable(),

                    TextInput::make('sc_cont_f')
                    ->label('sc cont f')
                    ->nullable(),

                    TextInput::make('st_reg_m')
                    ->label('st reg m')
                    ->nullable(),

                    TextInput::make('st_reg_f')
                    ->label('st reg f')
                    ->nullable(),
                    
                    TextInput::make('st_cont_m')
                    ->label('st_cont_m')
                    ->nullable(),

                    TextInput::make('st_cont_f')
                    ->label('st_cont_f')
                    ->nullable(),

                    TextInput::make('obc_reg_m')
                    ->label('obc_reg_m')
                    ->nullable(),

                    TextInput::make('obc_reg_f')
                    ->label('obc_reg_f')
                    ->nullable(),

                    TextInput::make('obc_cont_m')
                    ->label('obc_cont_m')
                    ->nullable(),

                    TextInput::make('obc_cont_m')
                    ->label('obc_cont_m')
                    ->nullable(),

                    TextInput::make('gen_reg_m')
                    ->label('gen_reg_m')
                    ->nullable(),

                    TextInput::make('gen_reg_f')
                    ->label('gen_gen_f')
                    ->nullable(),

                    TextInput::make('gen_cont_m')
                    ->label('gen_cont_m')
                    ->nullable(),

                    TextInput::make('gen_cont_f')
                    ->label('gen_cont_f')
                    ->nullable(),



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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
