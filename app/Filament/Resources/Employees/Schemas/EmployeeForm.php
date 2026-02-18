<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use App\Models\User;
use App\Models\Employee;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('user.name')
            ->label('Name')
            ->required()
            ,
            TextInput::make('user.email')
            ->label('Email')
            ->unique(User::class, 'email', ignoreRecord: true)
            ->required(),
            TextInput::make('user.password')
            ->label('Password')
            ->revealable()
            ->password()
            ->required(fn(string $operation): bool => $operation === 'create')
            ->helperText(fn(string $operation): ?string => $operation === 'edit' ? 'Leave blank if you do not want to change the password.' : null)
            ->dehydrated(fn(?string $state) => filled($state)),
            TextInput::make('employee_code')
            ->label('Employee Code')
            ->unique(Employee::class, 'employee_code', ignoreRecord: true)
            ->required()
            ->default(fn() => (int)(Employee::max('employee_code') ?? 100) + 1)
            ->disabled()
            // (fn(string $operation): bool => $operation === 'edit')
            ->dehydrated(),
            TextInput::make('phone')
            ->label('Phone Number')
            ->required()
            ->unique(Employee::class, 'phone', ignoreRecord: true)
            ->numeric()
            ->minLength(10)
            ->maxLength(12)
            ->tel(),
            Textarea::make('address'),
            TextInput::make('aadhar_no')
            ->label('Aadhar Number')
            ->required(),
            DatePicker::make('joining_date')
            ->default(now())
            ->native(false)
            ->label('Joining Date'),
            Toggle::make('status')
            ->label('Status')
            ->default(true)
            ->required(),
        ]);
    }
}
