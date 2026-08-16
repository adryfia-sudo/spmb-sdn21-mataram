<?php

namespace App\Filament\Resources\RegistrationProofTemplates;

use App\Filament\Resources\RegistrationProofTemplates\Pages\CreateRegistrationProofTemplate;
use App\Filament\Resources\RegistrationProofTemplates\Pages\EditRegistrationProofTemplate;
use App\Filament\Resources\RegistrationProofTemplates\Pages\ListRegistrationProofTemplates;
use App\Filament\Resources\RegistrationProofTemplates\Schemas\RegistrationProofTemplateForm;
use App\Filament\Resources\RegistrationProofTemplates\Tables\RegistrationProofTemplatesTable;
use App\Models\RegistrationProofTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistrationProofTemplateResource extends Resource
{
    protected static ?string $model = RegistrationProofTemplate::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel =
        'Template Bukti Pendaftaran';

    protected static ?string $modelLabel =
        'Template Bukti Pendaftaran';

    protected static ?string $pluralModelLabel =
        'Template Bukti Pendaftaran';

    protected static string|\UnitEnum|null $navigationGroup =
        'Pengaturan';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RegistrationProofTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationProofTemplatesTable::configure($table);
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
            'index' => ListRegistrationProofTemplates::route('/'),
            'create' => CreateRegistrationProofTemplate::route('/create'),
            'edit' => EditRegistrationProofTemplate::route('/{record}/edit'),
        ];
    }
}
