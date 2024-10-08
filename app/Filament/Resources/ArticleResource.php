<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationGroup = "Articles";
    protected static ?string $navigationIcon = 'icon-edit';
    protected static ?int $navigationSort = 5;

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ['title','introtext','fulltext'];
    // }

    public static function form(Form $form): Form
    {

        return $form

            ->schema([
                Section::make('Article')->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->required()
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'user_id']),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'category_id']),
                    Select::make('source_id')
                        ->relationship('source', 'name')
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'source_id']),
                    Select::make('author_id')
                        ->relationship('author', 'name')
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'author_id']),
                    Select::make('status')
                        ->options(['Draft','Published','Deleted'])
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'status']),
                    Toggle::make('features')
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'features']),
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
                        ->columnSpan(6)
                        ->extraAttributes(['class' => 'title']),
                    Hidden::make('slug')
                        ->required()
                        ->columnSpan(6)
                        ->extraAttributes(['class' => 'slug']),
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
                        ->nullable()
                        ->columnSpan(6)
                        ->extraAttributes(['class' => 'introtext']),
                    RichEditor::make('fulltext')
                        ->disableToolbarButtons([
                            'h2',
                            'h3',
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('images/photos')
                        ->nullable()
                        ->columnSpan(6)
                        ->extraAttributes(['class' => 'fulltext']),

                    DateTimePicker::make('publish_up')
                        ->columnSpan(2)
                        ->nullable()
                        ->extraAttributes(['class' => 'publish_up']),
                    DateTimePicker::make('publish_down')
                        ->columnSpan(2)
                        ->nullable()
                        ->extraAttributes(['class' => 'publish_down']),
                    TextInput::make('updated_by')
                        ->maxLength(255)
                        ->disabled()
                        ->columnSpan(2)
                        ->nullable()
                        ->extraAttributes(['class' => 'updated_by']),
                ])->columns(4)->columnSpan(2),

                Group::make()->schema([
                    Section::make('Image intro')->schema([
                        Toggle::make('imageintro')
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'imageintro']),
                        TextInput::make('imageintro_title')
                            ->nullable()
                            ->columnSpanFull()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'imageintro_title']),
                        FileUpload::make('imageintro_url')
                            ->image()
                            ->disk('public')
                            ->directory("/images/intro")
                            ->imageEditor()
                            ->nullable()
                            ->columnSpan(1)
                            ->extraAttributes(['class' => 'imageintro_url']),
                        Textarea::make('imageintro_caption')
                            ->nullable()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'imageintro_caption']),
                        TextInput::make('imageintro_credits')
                            ->nullable()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'imageintro_credits']),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                    Section::make('Images')->schema([
                        Toggle::make('image')
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'image']),
                        FileUpload::make('image_url')
                            ->image()
                            ->disk('public')
                            ->directory("/images")
                            ->imageEditor()
                            ->nullable()
                            ->columnSpan(1)
                            ->extraAttributes(['class' => 'image']),
                        Textarea::make('image_caption')
                            ->nullable()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'image_caption']),
                        TextInput::make('image_credits')
                            ->nullable()
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'image_credits']),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                    Section::make('Gallery')->schema([
                        Toggle::make('gallery')
                            ->columnSpan(2)
                            ->extraAttributes(['class' => 'gallery']),
                        FileUpload::make('gallery_url')
                            ->disk('public')
                            ->directory("/images/gallery")
                            ->multiple()
                            ->storeFileNamesIn('gallery_file_names')
                            ->nullable()
                            ->extraAttributes(['class' => 'gallery_url'])
                            ->columnSpan(1),
                        Textarea::make('gallery_caption')
                            ->nullable()
                            ->extraAttributes(['class' => 'gallery_caption'])
                            ->columnSpan(2),
                        TextInput::make('gallery_credits')
                            ->nullable()
                            ->extraAttributes(['class' => 'gallery_credits'])
                            ->columnSpan(2),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                    Section::make('Videos')->schema([
                        Toggle::make('video')
                            ->extraAttributes(['class' => 'video']),
                        FileUpload::make('video_url')
                            ->image()
                            ->nullable()
                            ->extraAttributes(['class' => 'video_url']),
                        Textarea::make('video_caption')
                            ->nullable()
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'video_caption']),
                        TextInput::make('video_credits')
                            ->nullable()
                            ->extraAttributes(['class' => 'video_credits']),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                    Section::make('Audio')->schema([
                        Toggle::make('audio')
                            ->extraAttributes(['class' => 'audio']),
                        FileUpload::make('audio_url')
                            ->image()
                            ->nullable()
                            ->extraAttributes(['class' => 'audio_url']),
                        Textarea::make('audio_caption')
                            ->nullable()
                            ->extraAttributes(['class' => 'audio_caption']),
                        TextInput::make('audio_caption')
                            ->nullable()
                            ->extraAttributes(['class' => 'audio_caption']),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                    Section::make('Metatags')->schema([
                        Textarea::make('meta_decription')
                            ->nullable()
                            ->extraAttributes(['class' => 'meta_decription']),
                        Textarea::make('meta_key')
                            ->nullable()
                            ->extraAttributes(['class' => 'meta_key']),
                        Textarea::make('meta_author')
                            ->nullable()
                            ->extraAttributes(['class' => 'meta_author']),
                        Hidden::make('trash'),
                        Hidden::make('access'),
                        Hidden::make('hits'),
                        Hidden::make('order'),
                        Hidden::make('featured_ordering'),
                    ])->columnSpan(1)->collapsible()->collapsed(),
                ])
            ])->columns(3);
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
                ImageColumn::make('image_url')
                    ->width('70px'),
                TextColumn::make('status')
                    ->badge()
                    ->color(function (string $state): string {
                        return match ($state){
                            'Draft' => 'warning',
                            'Published' => 'success',
                            'Deleted' => 'danger',
                        };
                    })
                    ->width('70px'),
                ToggleColumn::make('features')
                    ->width('70px'),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->width('90px'),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y')
                    ->width('90px'),
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
            'index' => Pages\ListArticle::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
