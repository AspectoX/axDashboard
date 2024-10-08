<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Source;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SourceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SourceResource\RelationManagers;

class SourceResource extends Resource
{
    protected static ?string $model = Source::class;
    protected static ?string $navigationGroup = "Articles";
    protected static ?string $navigationIcon = 'icon-pen-nib';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur:true)
                    ->afterStateUpdated(function (
                        string $operation,
                        string $state,
                        Forms\Set $set,
                        ){
                        if($operation === 'edit'){
                            return;
                        }
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(150),
                TextInput::make('slug')
                    ->required()
                    //->disabled()
                    ->maxLength(150),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->preserveFilenames()
                    ->image()
                    ->disk('public')
                    ->directory("/images/sources")
                    ->maxSize(49152)
	                ->maxFiles(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->description(fn (Source $record): string => $record->description)
                    ->searchable(),
                ImageColumn::make('images')
                    ->circular(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y'),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->tooltip('View')
                    ->color('btn-blue'),
                EditAction::make()
                    ->tooltip('Edit')
                    ->color('btn-green'),
                DeleteAction::make()
                    ->tooltip('Delete')
                    ->color('btn-red'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSources::route('/'),
            'create' => Pages\CreateSource::route('/create'),
            'edit' => Pages\EditSource::route('/{record}/edit'),
        ];
    }
}
