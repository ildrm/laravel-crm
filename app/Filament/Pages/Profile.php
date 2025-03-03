<?php

namespace App\Filament\Pages;

use App\Models\UserCredential;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;

class Profile extends Page
{
    protected static string $view = 'filament.pages.profile';
    protected static bool $shouldRegisterNavigation = true;

    public $data;

    public function mount(): void
    {
        $this->data = [
            'first_name' => auth()->user()->first_name,
            'last_name' => auth()->user()->last_name,
            'email' => auth()->user()->email,
            'credentials' => auth()->user()->credentials()->get()->toArray(),


        ];

        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Profile')
                ->tabs([
                    Tabs\Tab::make('Personal Information')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Forms\Components\TextInput::make('first_name')
                                        ->required(),
                                    Forms\Components\TextInput::make('last_name')
                                        ->required(),
                                    Forms\Components\TextInput::make('email')
                                        ->email()
                                        ->required(),
                                ]),
                        ]),

                    Tabs\Tab::make('Credentials')
                        ->schema([
                            Forms\Components\Repeater::make('credentials')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                    Forms\Components\Select::make('auth_type')
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state) {
                                            if ($state === 'basic_auth') {
                                                $set('username', null);
                                                $set('password', null);
                                            } elseif ($state === 'api_key') {
                                                $set('key', null);
                                                $set('value', null);
                                            }
                                        })

                                        ->options([
                                            'no_auth' => 'No Auth',
                                            'basic_auth' => 'Basic Auth',
                                            'bearer_token' => 'Bearer Token',
                                            'jwt_bearer' => 'JWT Bearer',
                                            'digest_auth' => 'Digest Auth',
                                            'oauth1' => 'OAuth 1.0',
                                            'oauth2' => 'OAuth 2.0',
                                            'hawk' => 'Hawk Authentication',
                                            'aws' => 'AWS Signature',
                                            'ntlm' => 'NTLM Authentication',
                                            'api_key' => 'API Key',
                                            'akamai' => 'Akamai EdgeGrid',
                                            'asap' => 'ASAP (Atlassian)',
                                        ])
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state) {
                                            if ($state === 'basic_auth') {
                                                $set('username', null);
                                                $set('password', null);
                                            } elseif ($state === 'api_key') {
                                                $set('key', null);
                                                $set('value', null);
                                            }
                                        })
                                        ->required(),

                                    Forms\Components\Grid::make()
                                        ->schema(fn(Forms\Get $get) => match ($get('auth_type')) {
                                            'no_auth' => [],

                                            'basic_auth' => [
                                                Forms\Components\TextInput::make('username')->required(),
                                                Forms\Components\TextInput::make('password')->password()->required(),
                                            ],

                                            'api_key' => [
                                                Forms\Components\TextInput::make('key')->required(),
                                                Forms\Components\TextInput::make('value')->required(),
                                                Forms\Components\Select::make('add_to')
                                                    ->options(['header' => 'Header', 'query' => 'Query Params'])
                                                    ->required(),
                                            ],

                                            default => [],
                                        })

                                        ->schema(fn(Forms\Get $get) => match ($get('auth_type')) {
                                            'no_auth' => [],

                                            'basic_auth' => [
                                                Forms\Components\TextInput::make('username')->required(),
                                                Forms\Components\TextInput::make('password')->password()->required(),
                                            ],

                                            'bearer_token' => [
                                                Forms\Components\Textarea::make('token')->required(),
                                            ],

                                            'jwt_bearer' => [
                                                Forms\Components\Select::make('algorithm')
                                                    ->options([
                                                        'HS256' => 'HS256',
                                                        'HS384' => 'HS384',
                                                        'HS512' => 'HS512',
                                                        'RS256' => 'RS256',
                                                        'RS384' => 'RS384',
                                                        'RS512' => 'RS512',
                                                        'PS256' => 'PS256',
                                                        'PS384' => 'PS384',
                                                        'PS512' => 'PS512',
                                                        'ES256' => 'ES256',
                                                        'ES512' => 'ES512'
                                                    ])->required(),
                                                Forms\Components\TextInput::make('secret')->required(),
                                                Forms\Components\Checkbox::make('secret_base64_encoded'),
                                                Forms\Components\Textarea::make('payload')->required(),
                                                Forms\Components\TextInput::make('header_prefix'),
                                                Forms\Components\Textarea::make('jwt_headers'),
                                            ],

                                            'digest_auth' => [
                                                Forms\Components\TextInput::make('username')->required(),
                                                Forms\Components\TextInput::make('password')->required(),
                                                Forms\Components\TextInput::make('realm'),
                                                Forms\Components\TextInput::make('nonce'),
                                                Forms\Components\Select::make('algorithm')
                                                    ->options([
                                                        'MD5' => 'MD5',
                                                        'MD5-sess' => 'MD5-sess',
                                                        'SHA-256' => 'SHA-256',
                                                        'SHA-256-sess' => 'SHA-256-sess',
                                                        'SHA-512-256' => 'SHA-512-256',
                                                        'SHA-512-256-sess' => 'SHA-512-256-sess'
                                                    ]),
                                                Forms\Components\TextInput::make('qop'),
                                                Forms\Components\TextInput::make('nonce_count')->numeric(),
                                                Forms\Components\TextInput::make('client_nonce'),
                                                Forms\Components\TextInput::make('opaque'),
                                            ],

                                            'oauth1' => [
                                                Forms\Components\Select::make('signature_method')
                                                    ->options([
                                                        'HMAC-SHA1' => 'HMAC-SHA1',
                                                        'HMAC-SHA256' => 'HMAC-SHA256',
                                                        'HMAC-SHA512' => 'HMAC-SHA512',
                                                        'RSA-SHA1' => 'RSA-SHA1',
                                                        'RSA-SHA256' => 'RSA-SHA256',
                                                        'RSA-SHA512' => 'RSA-SHA512',
                                                        'PLAINTEXT' => 'PLAINTEXT'
                                                    ])->required(),
                                                Forms\Components\TextInput::make('consumer_key')->required(),
                                                Forms\Components\TextInput::make('consumer_secret')->required(),
                                                Forms\Components\TextInput::make('access_token'),
                                                Forms\Components\TextInput::make('token_secret'),
                                                Forms\Components\TextInput::make('callback_url')->url(),
                                                Forms\Components\TextInput::make('verifier'),
                                                Forms\Components\TextInput::make('timestamp'),
                                                Forms\Components\TextInput::make('nonce'),
                                                Forms\Components\TextInput::make('version'),
                                                Forms\Components\TextInput::make('realm'),
                                                Forms\Components\Checkbox::make('include_body_hash'),
                                            ],

                                            'hawk' => [
                                                Forms\Components\TextInput::make('hawk_auth_id')->required(),
                                                Forms\Components\TextInput::make('hawk_auth_key')->required(),
                                                Forms\Components\Select::make('algorithm')
                                                    ->options(['SHA-1' => 'SHA-1', 'SHA-256' => 'SHA-256'])->required(),
                                                Forms\Components\TextInput::make('user'),
                                                Forms\Components\TextInput::make('nonce'),
                                                Forms\Components\TextInput::make('ext'),
                                                Forms\Components\TextInput::make('app'),
                                                Forms\Components\TextInput::make('dlg'),
                                                Forms\Components\TextInput::make('timestamp'),
                                                Forms\Components\Checkbox::make('include_payload_hash'),
                                            ],

                                            'aws' => [
                                                Forms\Components\TextInput::make('access_key')->required(),
                                                Forms\Components\TextInput::make('secret_key')->required(),
                                                Forms\Components\TextInput::make('region')->required(),
                                                Forms\Components\TextInput::make('service_name')->required(),
                                                Forms\Components\TextInput::make('session_token'),
                                            ],

                                            'ntlm' => [
                                                Forms\Components\TextInput::make('username')->required(),
                                                Forms\Components\TextInput::make('password')->required(),
                                                Forms\Components\TextInput::make('domain'),
                                                Forms\Components\TextInput::make('workstation'),
                                            ],

                                            'api_key' => [
                                                Forms\Components\TextInput::make('key')->required(),
                                                Forms\Components\TextInput::make('value')->required(),
                                                Forms\Components\Select::make('add_to')
                                                    ->options(['header' => 'Header', 'query' => 'Query Params'])
                                                    ->required(),
                                            ],

                                            'akamai' => [
                                                Forms\Components\TextInput::make('access_token')->required(),
                                                Forms\Components\TextInput::make('client_token')->required(),
                                                Forms\Components\TextInput::make('client_secret')->required(),
                                                Forms\Components\TextInput::make('nonce'),
                                                Forms\Components\TextInput::make('timestamp'),
                                                Forms\Components\TextInput::make('base_url')->required(),
                                                Forms\Components\TextInput::make('max_body_size')->numeric(),
                                            ],

                                            'asap' => [
                                                Forms\Components\TextInput::make('algorithm')->required(),
                                                Forms\Components\TextInput::make('issuer')->required(),
                                                Forms\Components\TextInput::make('audience')->required(),
                                                Forms\Components\TextInput::make('key_id')->required(),
                                                Forms\Components\Textarea::make('private_key')->required(),
                                                Forms\Components\TextInput::make('subject'),
                                                Forms\Components\Textarea::make('additional_claims'),
                                                Forms\Components\TextInput::make('expiry'),
                                            ],

                                            default => [],
                                        })
                                        ->visible(fn(Forms\Get $get) => filled($get('auth_type')))
                                        ->columns(2)
                                ])
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public function save()
    {
        $data = $this->form->getState();

        if (auth()->check()) {
            if (auth()->check()) {
            if (auth()->check()) {
            if (auth()->check()) {
                if (auth()->check()) {
                if (auth()->check()) {
                    auth()->user()->update([


                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                ]);

                foreach ($data['credentials'] as $credential) {
                    auth()->user()->credentials()->updateOrCreate(
                        ['id' => $credential['id'] ?? null],
                        [
                            'name' => $credential['name'],
                            'auth_type' => $credential['auth_type'],
                            'config' => $credential
                        ]
                    );
                }

                $this->notify('success', 'Profile updated successfully');
            } else {
                $this->notify('error', 'User not authenticated.');
            }


                $this->notify('success', 'Profile updated successfully');
            } else {
                $this->notify('error', 'User not authenticated.');
            }


                $this->notify('success', 'Profile updated successfully');
            } else {
                $this->notify('error', 'User not authenticated.');
            }


                $this->notify('success', 'Profile updated successfully');
            } else {
                $this->notify('error', 'User not authenticated.');
            }


                $this->notify('success', 'Profile updated successfully');
            } else {
                $this->notify('error', 'User not authenticated.');
            }


            $this->notify('success', 'Profile updated successfully');
        } else {
            $this->notify('error', 'User not authenticated.');
        }


        $this->notify('success', 'Profile updated successfully');
    }
}
