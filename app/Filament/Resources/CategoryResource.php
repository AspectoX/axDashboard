<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\CategoryStatus;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Guava\FilamentIconPicker\Tables\IconColumn;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = "Articles";
    protected static ?string $navigationIcon = 'icon-ballot';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
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
                    Select::make('status')
                        ->options(['Draft','Published','Deleted']),
                    Hidden::make('slug')
                        ->required(),
                        // ->disabled()
                        //->maxLength(150),
                    IconPicker::make('images'),
                    ColorPicker::make('color')
                        ->rgba(),
                    Textarea::make('description')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Category $record): string => $record->description),
                ColorColumn::make('color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                IconColumn::make('images'),
                TextColumn::make('status')
                    ->badge()
                    ->color(function (string $state): string {
                        return match ($state){
                            'Draft' => 'warning',
                            'Published' => 'success',
                            'Deleted' => 'danger',
                        };
                    })
                    ->extraAttributes(['class' => 'status']),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y')
                    ->sortable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
