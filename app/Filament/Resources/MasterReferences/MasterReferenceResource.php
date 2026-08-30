<?php

namespace App\Filament\Resources\MasterReferences;

use App\Filament\Resources\MasterReferences\Pages\CreateMasterReference;
use App\Filament\Resources\MasterReferences\Pages\EditMasterReference;
use App\Filament\Resources\MasterReferences\Pages\ListMasterReferences;
use App\Filament\Resources\MasterReferences\Schemas\MasterReferenceForm;
use App\Filament\Resources\MasterReferences\Tables\MasterReferencesTable;
use App\Models\MasterReference;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MasterReferenceResource extends Resource
{
    protected static ?string $model = MasterReference::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MasterReferenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MasterReferencesTable::configure($table);
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
            'index' => ListMasterReferences::route('/'),
            'create' => CreateMasterReference::route('/create'),
            'edit' => EditMasterReference::route('/{record}/edit'),
        ];
    }
}
