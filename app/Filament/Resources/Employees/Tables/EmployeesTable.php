<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Enums\FiltersLayout;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('employee_code')
            ->searchable(),
            TextColumn::make('user.name')
            ->label('Name')
            ->searchable()
            ->sortable(),
            TextColumn::make('user.email')
            ->label('Email')
            ->searchable()
            ->sortable(),
            TextColumn::make('phone')
            ->label('Phone Number')
            ->searchable(),
            TextColumn::make('address')
            ->searchable(),
            // TextColumn::make('aadhar_no')
            // ->label('Aadhar Number')
            // ->searchable(),
            IconColumn::make('status')
            ->label('Status')
            ->boolean(),
        ])
            ->filters([
                Filter::make('employee_code')
                ->form([
                    TextInput::make('employee_code')
                    ->label('Employee Code'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                return $query->when(
                    $data['employee_code'],
                fn(Builder $query, $employee_code): Builder => $query->where('employee_code', $employee_code),
                );
            }),
            Filter::make('name')
            ->form([
                TextInput::make('name')
                ->label('Name'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query
                ->when(
                $data['name'],
            fn(Builder $query, $name) =>
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$name}%"))
            );
        }),
            Filter::make('phone')
            ->form([
                TextInput::make('phone')
                ->label('Phone Number'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query
                ->when(
                $data['phone'],
            fn(Builder $query, $phone) =>
            $query->where('phone', 'like', "%{$phone}%")
            );
        }),
            Filter::make('status')
            ->form([
                Select::make('status')
                ->label('Status')
                ->options([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ]),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query
                ->when(
                $data['status'] !== null,
            fn(Builder $query) =>
            $query->where('status', $data['status'])
            );
        }),
        ])
            ->filtersFormColumns(3)
            ->defaultSort('created_at', 'desc')
            ->recordActions([
            ViewAction::make()
            ->label(''),
            EditAction::make()
            ->label(''),
            DeleteAction::make()
            ->label(''),
        ])
            ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]) ->filtersFormColumns(5)
            ->filtersLayout(FiltersLayout::AboveContent);
    }
}
