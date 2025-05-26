<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Новости';

    protected static ?string $modelLabel = 'Новость';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\RichEditor::make('content')
                    ->label('Содержание')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('news')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_published')
                    ->label('Опубликовано')
                    ->default(false),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Дата публикации')
                    ->nullable(),

                Forms\Components\Select::make('categories')
                    ->label('Категории')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликовано')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликовано'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
} 