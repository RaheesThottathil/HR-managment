<?php

namespace App\Filament\Resources\Sites\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;

class SitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('site_name')
            ->label('Site Name')
            ->searchable(),
            TextColumn::make('client_name')
            ->label('Client Name')
            ->searchable(),
            TextColumn::make('location')
            ->label('Location')
            ->searchable(),
            TextColumn::make('date')
            ->date()
            ->sortable(),
            TextColumn::make('number_of_employees')
            ->label('Number of Employees')
            ->searchable(),
            TextColumn::make('shift')
            ->label('Shift')
            ->badge(),
            TextColumn::make('reporting_time')
            ->label('Reporting Time')
            ->time()
            ->sortable(),
            TextColumn::make('status')
            ->label('Status')
            ->searchable(),
        ])
            ->filters([
            Filter::make('site_name')
            ->form([
                TextInput::make('site_name')
                ->label('Site Name'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query->when(
                $data['site_name'],
            fn(Builder $query, $site_name): Builder => $query->where('site_name', $site_name),
            );
        }),
            Filter::make('client_name')
            ->form([
                TextInput::make('client_name')
                ->label('Client Name'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query->when(
                $data['client_name'],
            fn(Builder $query, $client_name): Builder => $query->where('client_name', $client_name),
            );
        }),
            Filter::make('location')
            ->form([
                TextInput::make('location')
                ->label('Location'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query->when(
                $data['location'],
            fn(Builder $query, $location): Builder => $query->where('location', $location),
            );
        }),
            Filter::make('date')
            ->form([
                DatePicker::make('date'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query->when(
                $data['date'],
            fn(Builder $query, $date): Builder => $query->whereDate('date', $date),
            );
        }),
            SelectFilter::make('status')
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ]),
        ])
            ->recordActions([
            ViewAction::make()
            ->label(''),
            EditAction::make()
            ->label(''),
        ])
            ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ])
            ->filtersFormColumns(5)
            ->filtersLayout(FiltersLayout::AboveContent);
    }
}
