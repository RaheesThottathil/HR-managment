<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->components([
                        TextEntry::make('user.name')
                            ->label('Name'),
                        TextEntry::make('user.email')
                            ->label('Email'),
                        TextEntry::make('employee_code')
                            ->label('Employee Code'),
                        TextEntry::make('phone')
                        ->label('Phone Number')
                            ->placeholder('-'),
                TextEntry::make('address')
                ->label('Address')
                    ->placeholder('-'),
                TextEntry::make('aadhar_no')
                ->label('Aadhar Number'),
                TextEntry::make('joining_date')
                ->label('Joining Date')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('status')
                ->label('Status')
                    ->boolean(),
                    ])->columns(2)->columnSpanFull(),
            ]);
    }
}
