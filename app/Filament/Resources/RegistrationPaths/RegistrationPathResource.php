<?php

namespace App\Filament\Resources\RegistrationPaths;

use App\Filament\Resources\RegistrationPaths\Pages\CreateRegistrationPath;
use App\Filament\Resources\RegistrationPaths\Pages\EditRegistrationPath;
use App\Filament\Resources\RegistrationPaths\Pages\ListRegistrationPaths;
use App\Filament\Resources\RegistrationPaths\Schemas\RegistrationPathForm;
use App\Filament\Resources\RegistrationPaths\Tables\RegistrationPathsTable;
use App\Models\RegistrationPath;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RegistrationPathResource extends Resource
{
    protected static ?string $model = RegistrationPath::class;

    protected static ?string $navigationLabel = 'Jalur Pendaftaran';

    protected static ?string $modelLabel = 'Jalur Pendaftaran';

    protected static ?string $pluralModelLabel = 'Jalur Pendaftaran';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RegistrationPathForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationPathsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistrationPaths::route('/'),
            'create' => CreateRegistrationPath::route('/create'),
            'edit' => EditRegistrationPath::route('/{record}/edit'),
        ];
    }
}
