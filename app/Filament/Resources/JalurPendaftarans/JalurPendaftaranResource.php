<?php

namespace App\Filament\Resources\JalurPendaftarans;

use App\Filament\Resources\JalurPendaftarans\Pages\CreateJalurPendaftaran;
use App\Filament\Resources\JalurPendaftarans\Pages\EditJalurPendaftaran;
use App\Filament\Resources\JalurPendaftarans\Pages\ListJalurPendaftarans;
use App\Filament\Resources\JalurPendaftarans\Schemas\JalurPendaftaranForm;
use App\Filament\Resources\JalurPendaftarans\Tables\JalurPendaftaransTable;
use App\Models\JalurPendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JalurPendaftaranResource extends Resource
{
    protected static ?string $model = JalurPendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JalurPendaftaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JalurPendaftaransTable::configure($table);
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
            'index' => ListJalurPendaftarans::route('/'),
            'create' => CreateJalurPendaftaran::route('/create'),
            'edit' => EditJalurPendaftaran::route('/{record}/edit'),
        ];
    }
}
