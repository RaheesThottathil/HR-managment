<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Site Name')
                    ->required(),
                TextInput::make('client_name')
                    ->label('Client Name'),
               
                TextInput::make('location')
                    ->label('Location')
                    ->required(),
                DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                TextInput::make('number_of_employees')
                    ->label('Number of Employees')
                    ->required(),
                Select::make('shift')
                    ->label('Shift')
                    ->options(['morning' => 'Morning', 'lunch' => 'Lunch', 'evening' => 'Evening', 'night' => 'Night'])
                    ->required(),
                TimePicker::make('reporting_time')
                    ->label('Reporting Time'),
                Toggle::make('status')
                    ->label('Status')
                    ->required()
                    ->default(true),
            ]);
    }
}
