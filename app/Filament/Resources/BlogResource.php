<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Blog Information')
                    ->schema([
                        Group::make()->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->unique(ignoreRecord: true)
                                ->required(),
                            Select::make('category_id')
                                ->label('Category')
                                ->options(Category::pluck('name', 'id'))
                                ->searchable()
                                ->required(),

                            Select::make('employee_id')
                                ->label('Author')
                                ->options(User::pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                        ])->columnSpan(3),

                        Group::make([
                            FileUpload::make('image')
                                ->label('Feature Image')
                                ->disk('public')
                                ->directory('blog')
                                ->image()
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->nullable(),

                            Select::make('status')
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                ])
                                ->default('active')
                                ->required(),
                        ])->columnSpan(1),
                    ])->columns(4),

                Section::make('Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO Information')
                    ->schema([
                        TextInput::make('seo_title')
                            ->maxLength(255),

                        Textarea::make('seo_description')
                            ->rows(3),

                        TextInput::make('seo_tags')
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Image')->disk('public')->square(),
                TextColumn::make('title')->sortable()->limit(40)->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
                TextColumn::make('view_count')->label('Views')->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => fn($state): bool => $state === 'active',
                        'danger' => fn($state): bool => $state === 'inactive',
                    ])
                    ->formatStateUsing(fn($state): string => ucfirst($state)),
                TextColumn::make('created_at')->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->can('blog.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => auth()->user()->can('blog.delete')),
                ]),
            ]);
        // ->actions([
        //     Tables\Actions\EditAction::make(),
        // ])
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
