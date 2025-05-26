<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniversityResource\Pages;
use App\Models\University;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class UniversityResource extends Resource
{
    protected static ?string $model = University::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Университеты';

    protected static ?string $modelLabel = 'Университет';

    protected static ?string $pluralModelLabel = 'Университеты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
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

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('logo')
                    ->label('Логотип')
                    ->image()
                    ->directory('universities')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('address')
                    ->label('Адрес')
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('Телефон')
                    ->tel()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),

                Forms\Components\TextInput::make('website')
                    ->label('Веб-сайт')
                    ->url()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Активно')
                    ->default(true),

                Forms\Components\Select::make('faculties')
                    ->label('Факультеты')
                    ->multiple()
                    ->relationship('faculties', 'name')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('logo')
                    ->label('Логотип'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Адрес')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('website')
                    ->label('Веб-сайт')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активно')
                    ->boolean(),

                Tables\Columns\TextColumn::make('faculties_count')
                    ->label('Количество факультетов')
                    ->counts('faculties')
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
                Tables\Filters\SelectFilter::make('faculties')
                    ->relationship('faculties', 'name')
                    ->multiple()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активно'),
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
            'index' => Pages\ListUniversities::route('/'),
            'create' => Pages\CreateUniversity::route('/create'),
            'edit' => Pages\EditUniversity::route('/{record}/edit'),
        ];
    }
} 