<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Category Information')
                    ->schema([
                        Group::make()->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('slug')
                                ->unique(ignoreRecord: true)
                                ->required(),

                            Select::make('parent_id')
                                ->label('Parent Category')
                                ->relationship('parent', 'name')
                                ->nullable(),

                        ])->columnSpan(3),

                        Group::make([
                            FileUpload::make('image')
                                ->label('Image')
                                ->disk('public')
                                ->directory('category')
                                ->image()
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->nullable(),

                            Select::make('status')
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                ])
                                ->default('inactive')
                                ->required(),
                        ])->columnSpan(1),
                    ])->columns(4),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ImageColumn::make('image')->label('Image')->disk('public')->square(),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => fn($state): bool => $state === 'active',
                        'danger' => fn($state): bool => $state === 'inactive',
                    ])
                    ->formatStateUsing(fn($state): string => ucfirst($state)), // Converts 'active' to 'Active'
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('created_at')->date(),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
