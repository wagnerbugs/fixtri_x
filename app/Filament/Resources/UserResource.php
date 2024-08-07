<?php

namespace App\Filament\Resources;

use Exception;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Usuários';

    protected static ?string $navigationGroup = 'CLIENTES';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Fieldset::make('Dados básicos')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nome')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('E-mail')
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                            ]),
                        Forms\Components\Fieldset::make('Dados de acesso')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->revealable()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state)),

                                Forms\Components\Select::make('roles')
                                    ->label('Tipo de usuário')
                                    ->relationship('roles', 'name', fn (Builder $query) => auth()->user()->hasRole('Root') ? null : $query->where('name', '!=', 'Root'))
                                    ->multiple()
                                    ->required()
                                    ->preload(),
                            ])

                    ]),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Fieldset::make()
                            ->relationship('profile')
                            ->schema([
                                Document::make('document')
                                    ->label('CPF')
                                    ->cpf(),

                                Forms\Components\TextInput::make('zipcode')
                                    ->label('CEP')
                                    ->mask('99999-999')
                                    ->suffixAction(
                                        fn ($state, $set) => Forms\Components\Actions\Action::make('Buscar CEP')
                                            ->icon('heroicon-m-globe-alt')
                                            ->action(
                                                function () use ($state, $set) {
                                                    $state = preg_replace('/[^0-9]/', '', $state);
                                                    if (strlen($state) != 8) {
                                                        Notification::make()
                                                            ->danger()
                                                            ->title('Digite um cep valido')
                                                            ->send();
                                                    }

                                                    try {
                                                        $response = Http::get('https://brasilapi.com.br/api/cep/v2/' . $state);
                                                        $data = $response->json();

                                                        $set('street', $data['street']);
                                                        $set('neighborhood', $data['neighborhood']);
                                                        $set('city', $data['city']);
                                                        $set('state', $data['state']);
                                                        if (isset($data['location']['coordinates']['longitude'])) {
                                                            $set('longitude', $data['location']['coordinates']['longitude']);
                                                            $set('latitude', $data['location']['coordinates']['latitude']);
                                                        }
                                                    } catch (Exception $e) {
                                                        Notification::make()
                                                            ->danger()
                                                            ->title($e->getMessage())
                                                            ->send();
                                                    }
                                                }
                                            )
                                    ),
                                Forms\Components\Fieldset::make('Endereço')
                                    ->columnSpan(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('street')
                                            ->label('Rua, Via, Avenida...'),

                                        Forms\Components\TextInput::make('number')
                                            ->label('Número'),

                                        Forms\Components\TextInput::make('complement')
                                            ->label('Complemento'),

                                        Forms\Components\TextInput::make('neighborhood')
                                            ->label('Bairro'),

                                        Forms\Components\TextInput::make('city')
                                            ->label('Cidade')
                                            ->disabled()
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('state')
                                            ->label('UF')
                                            ->disabled()
                                            ->dehydrated(),
                                    ]),
                            ]),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('E-mail Verificado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = User::find(auth()->user()->id);

        if ($user->hasRole('Root')) {
            return parent::getEloquentQuery();
        } else {
            return parent::getEloquentQuery()->whereHas(
                'roles',
                fn (Builder $query) => $query->where('id', '>=', $user->roles()->first()->id)
            );
        }
    }
}
