<?php

namespace App\Filament\Resources\RegistrationPeriods;

use App\Filament\Resources\RegistrationPeriods\Pages\CreateRegistrationPeriod;
use App\Filament\Resources\RegistrationPeriods\Pages\EditRegistrationPeriod;
use App\Filament\Resources\RegistrationPeriods\Pages\ListRegistrationPeriods;
use App\Filament\Resources\RegistrationPeriods\Schemas\RegistrationPeriodForm;
use App\Filament\Resources\RegistrationPeriods\Tables\RegistrationPeriodsTable;
use App\Models\RegistrationPeriod;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistrationPeriodResource extends Resource
{
    protected static ?string $model = RegistrationPeriod::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Periode Pendaftaran';

    protected static ?string $modelLabel = 'Periode Pendaftaran';

    protected static ?string $pluralModelLabel = 'Periode Pendaftaran';

    protected static string|\UnitEnum|null $navigationGroup = 'Pendaftaran';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canViewAny(): bool
    {
    return auth()->user()?->is_active === true
        && auth()->user()?->isAdmin() === true;
    }

    public static function form(Schema $schema): Schema
    {
        return RegistrationPeriodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationPeriodsTable::configure($table);
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
            'index' => ListRegistrationPeriods::route('/'),
            'create' => CreateRegistrationPeriod::route('/create'),
            'edit' => EditRegistrationPeriod::route('/{record}/edit'),
        ];
    }
}
