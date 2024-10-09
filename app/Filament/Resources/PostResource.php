<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationGroup = "Articles";
    protected static ?string $navigationIcon = 'icon-newspaper';
    protected static ?int $navigationSort = 1;

    protected static array $statuses =[
        'Draft' => 'Draft',
        'Published' => 'Published',
        'Deleted' => 'Deleted',
    ];


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->required()
                        ->columnSpan(2),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->columnSpan(2),
                    Select::make('source_id')
                        ->relationship('source', 'name')
                        ->columnSpan(2),
                    Select::make('author_id')
                        ->relationship('author', 'name')
                        ->columnSpan(2),
                    Select::make('status')
                        ->options(self::$statuses)
                        ->columnSpan(2),
                    Toggle::make('features')
                        ->columnSpan(2),

                    TextInput::make('title')
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
                        ->maxLength(150)
                        ->extraAttributes(['class' => 'title']),
                    Hidden::make('slug')
                        ->required(),
                    RichEditor::make('introtext')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])
                        ->nullable(),
                    RichEditor::make('fulltext')
                        ->disableToolbarButtons([
                            'h2',
                            'h3',
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('images/photos')
                        ->nullable(),

                    Toggle::make('image')
                        ->columnSpan(2),
                    FileUpload::make('image_url')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('/images')
                        ->nullable(),
                    Textarea::make('image_caption')
                        ->nullable(),
                    TextInput::make('image_credits')
                        ->nullable(),

                    Toggle::make('gallery'),
                    FileUpload::make('gallery_url')
                        ->disk('public')
                        ->directory('/images/gallery')
                        ->multiple()
                        ->nullable(),
                    Textarea::make('gallery_caption')
                        ->nullable()
                        ->extraAttributes(['class' => 'gallery_caption'])
                        ->columnSpan(2),
                    TextInput::make('gallery_credits')
                        ->nullable()
                        ->extraAttributes(['class' => 'gallery_credits'])
                        ->columnSpan(2),

                    Textarea::make('meta_decription')
                        ->nullable(),
                    Textarea::make('meta_key')
                        ->nullable(),
                    Textarea::make('meta_author')
                        ->nullable(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->words(8)
                    ->width('320px')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->width('50px')
                    ->sortable(),
                TextColumn::make('author.name')
                    ->width('50px')
                    ->sortable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(function (string $state): string {
                        return match ($state){
                            'Draft' => 'warning',
                            'Published' => 'success',
                            'Deleted' => 'danger',
                        };
                    }),
                ImageColumn::make('image_url')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
