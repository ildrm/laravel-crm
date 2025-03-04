<?php

namespace App\Filament\Pages;

use App\Models\UserCredential;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Actions\Action;

class Profile extends Page
{
    protected static string $view = 'filament.pages.profile';
    protected static bool $shouldRegisterNavigation = true;

    public $first_name;
    public $last_name;
    public $email;
    public $credentials;

    public function mount(): void
    {
        $user = auth()->user();
        
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->credentials = $user->credentials;
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
                                        ->label('First Name')
                                        ->required(),
                                    Forms\Components\TextInput::make('last_name')
                                        ->label('Last Name')
                                        ->required(),
                                    Forms\Components\TextInput::make('email')
                                        ->label('Email')
                                        ->email()
                                        ->required(),
                                ]),
                        ]),

                    Tabs\Tab::make('Credentials')
                        ->schema([
                            Forms\Components\Repeater::make('credentials')
                                ->label('Credentials')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Credential Name')
                                        ->required(),
                                    Forms\Components\Select::make('auth_type')
                                        ->label('Authentication Type')
                                        ->options([
                                            'no_auth' => 'No Auth',
                                            'basic_auth' => 'Basic Auth',
                                            'bearer_token' => 'Bearer Token',
                                            'jwt_bearer' => 'JWT Bearer',
                                            'digest_auth' => 'Digest Auth',
                                            'oauth1' => 'OAuth 1.0',
                                            'hawk' => 'Hawk Authentication',
                                            'aws' => 'AWS Signature',
                                            'ntlm' => 'NTLM Authentication',
                                            'api_key' => 'API Key',
                                            'akamai' => 'Akamai EdgeGrid',
                                            'asap' => 'ASAP (Atlassian)',
                                        ])
                                        ->reactive()
                                        ->default('no_auth')
                                        ->required(),
                                    
                                    Forms\Components\Section::make('Configuration')
                                        ->schema(function (Forms\Get $get) {
                                            $authType = $get('auth_type');
                                            return match ($authType) {
                                                'no_auth' => [],

                                                'basic_auth' => [
                                                    Forms\Components\TextInput::make('username')
                                                        ->label('Username')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('password')
                                                        ->label('Password')
                                                        ->password()
                                                        ->required(),
                                                ],

                                                'bearer_token' => [
                                                    Forms\Components\Textarea::make('token')
                                                        ->label('Token')
                                                        ->required()
                                                        ->rows(3),
                                                ],

                                                'jwt_bearer' => [
                                                    Forms\Components\Select::make('algorithm')
                                                        ->label('Algorithm')
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
                                                            'ES512' => 'ES512',
                                                        ])
                                                        ->required(),
                                                    Forms\Components\TextInput::make('secret')
                                                        ->label('Secret')
                                                        ->required(),
                                                    Forms\Components\Checkbox::make('secret_base64_encoded')
                                                        ->label('Secret Base64 Encoded'),
                                                    Forms\Components\Textarea::make('payload')
                                                        ->label('Payload (JSON)')
                                                        ->required()
                                                        ->rows(3),
                                                    Forms\Components\TextInput::make('header_prefix')
                                                        ->label('Header Prefix'),
                                                    Forms\Components\Textarea::make('jwt_headers')
                                                        ->label('JWT Headers (JSON)')
                                                        ->rows(3),
                                                ],

                                                'digest_auth' => [
                                                    Forms\Components\TextInput::make('username')
                                                        ->label('Username')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('password')
                                                        ->label('Password')
                                                        ->password()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('realm')
                                                        ->label('Realm'),
                                                    Forms\Components\TextInput::make('nonce')
                                                        ->label('Nonce'),
                                                    Forms\Components\Select::make('algorithm')
                                                        ->label('Algorithm')
                                                        ->options([
                                                            'MD5' => 'MD5',
                                                            'MD5-sess' => 'MD5-sess',
                                                            'SHA-256' => 'SHA-256',
                                                            'SHA-256-sess' => 'SHA-256-sess',
                                                            'SHA-512-256' => 'SHA-512-256',
                                                            'SHA-512-256-sess' => 'SHA-512-256-sess',
                                                        ]),
                                                    Forms\Components\TextInput::make('qop')
                                                        ->label('QOP'),
                                                    Forms\Components\TextInput::make('nonce_count')
                                                        ->label('Nonce Count')
                                                        ->numeric(),
                                                    Forms\Components\TextInput::make('client_nonce')
                                                        ->label('Client Nonce'),
                                                    Forms\Components\TextInput::make('opaque')
                                                        ->label('Opaque'),
                                                ],

                                                'oauth1' => [
                                                    Forms\Components\Select::make('signature_method')
                                                        ->label('Signature Method')
                                                        ->options([
                                                            'HMAC-SHA1' => 'HMAC-SHA1',
                                                            'HMAC-SHA256' => 'HMAC-SHA256',
                                                            'HMAC-SHA512' => 'HMAC-SHA512',
                                                            'RSA-SHA1' => 'RSA-SHA1',
                                                            'RSA-SHA256' => 'RSA-SHA256',
                                                            'RSA-SHA512' => 'RSA-SHA512',
                                                            'PLAINTEXT' => 'PLAINTEXT',
                                                        ])
                                                        ->required(),
                                                    Forms\Components\TextInput::make('consumer_key')
                                                        ->label('Consumer Key')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('consumer_secret')
                                                        ->label('Consumer Secret')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('access_token')
                                                        ->label('Access Token'),
                                                    Forms\Components\TextInput::make('token_secret')
                                                        ->label('Token Secret'),
                                                    Forms\Components\TextInput::make('callback_url')
                                                        ->label('Callback URL')
                                                        ->url(),
                                                    Forms\Components\TextInput::make('verifier')
                                                        ->label('Verifier'),
                                                    Forms\Components\TextInput::make('timestamp')
                                                        ->label('Timestamp'),
                                                    Forms\Components\TextInput::make('nonce')
                                                        ->label('Nonce'),
                                                    Forms\Components\TextInput::make('version')
                                                        ->label('Version'),
                                                    Forms\Components\TextInput::make('realm')
                                                        ->label('Realm'),
                                                    Forms\Components\Checkbox::make('include_body_hash')
                                                        ->label('Include Body Hash'),
                                                ],

                                                'hawk' => [
                                                    Forms\Components\TextInput::make('hawk_auth_id')
                                                        ->label('Hawk Auth ID')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('hawk_auth_key')
                                                        ->label('Hawk Auth Key')
                                                        ->required(),
                                                    Forms\Components\Select::make('algorithm')
                                                        ->label('Algorithm')
                                                        ->options([
                                                            'SHA-1' => 'SHA-1',
                                                            'SHA-256' => 'SHA-256',
                                                        ])
                                                        ->required(),
                                                    Forms\Components\TextInput::make('user')
                                                        ->label('User'),
                                                    Forms\Components\TextInput::make('nonce')
                                                        ->label('Nonce'),
                                                    Forms\Components\TextInput::make('ext')
                                                        ->label('Ext'),
                                                    Forms\Components\TextInput::make('app')
                                                        ->label('App'),
                                                    Forms\Components\TextInput::make('dlg')
                                                        ->label('Dlg'),
                                                    Forms\Components\TextInput::make('timestamp')
                                                        ->label('Timestamp'),
                                                    Forms\Components\Checkbox::make('include_payload_hash')
                                                        ->label('Include Payload Hash'),
                                                ],

                                                'aws' => [
                                                    Forms\Components\TextInput::make('access_key')
                                                        ->label('Access Key')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('secret_key')
                                                        ->label('Secret Key')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('region')
                                                        ->label('AWS Region')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('service_name')
                                                        ->label('Service Name')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('session_token')
                                                        ->label('Session Token'),
                                                ],

                                                'ntlm' => [
                                                    Forms\Components\TextInput::make('username')
                                                        ->label('Username')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('password')
                                                        ->label('Password')
                                                        ->password()
                                                        ->required(),
                                                    Forms\Components\TextInput::make('domain')
                                                        ->label('Domain'),
                                                    Forms\Components\TextInput::make('workstation')
                                                        ->label('Workstation'),
                                                ],

                                                'api_key' => [
                                                    Forms\Components\TextInput::make('key')
                                                        ->label('Key')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('value')
                                                        ->label('Value')
                                                        ->required(),
                                                    Forms\Components\Select::make('add_to')
                                                        ->label('Add To')
                                                        ->options([
                                                            'header' => 'Header',
                                                            'query' => 'Query Params',
                                                        ])
                                                        ->required(),
                                                ],

                                                'akamai' => [
                                                    Forms\Components\TextInput::make('access_token')
                                                        ->label('Access Token')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('client_token')
                                                        ->label('Client Token')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('client_secret')
                                                        ->label('Client Secret')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('nonce')
                                                        ->label('Nonce'),
                                                    Forms\Components\TextInput::make('timestamp')
                                                        ->label('Timestamp'),
                                                    Forms\Components\TextInput::make('base_url')
                                                        ->label('Base URL')
                                                        ->required()
                                                        ->url(),
                                                    Forms\Components\TextInput::make('max_body_size')
                                                        ->label('Max Body Size')
                                                        ->numeric(),
                                                ],

                                                'asap' => [
                                                    Forms\Components\TextInput::make('algorithm')
                                                        ->label('Algorithm')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('issuer')
                                                        ->label('Issuer')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('audience')
                                                        ->label('Audience')
                                                        ->required(),
                                                    Forms\Components\TextInput::make('key_id')
                                                        ->label('Key ID')
                                                        ->required(),
                                                    Forms\Components\Textarea::make('private_key')
                                                        ->label('Private Key')
                                                        ->required()
                                                        ->rows(3),
                                                    Forms\Components\TextInput::make('subject')
                                                        ->label('Subject'),
                                                    Forms\Components\Textarea::make('additional_claims')
                                                        ->label('Additional Claims (JSON)')
                                                        ->rows(3),
                                                    Forms\Components\TextInput::make('expiry')
                                                        ->label('Expiry'),
                                                ],

                                                default => [],
                                            };
                                        })
                                        ->visible(fn (Forms\Get $get) => filled($get('auth_type')) && $get('auth_type') !== 'no_auth')
                                        ->columns(2),
                                ])
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    protected function getActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Profile')
                ->action('save')
        ];
    }

    public function save()
    {
        $data = $this->form->getState();

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
                    'config' => array_diff_key($credential, ['id' => '', 'name' => '', 'auth_type' => '']),
                ]
            );
        }

        $this->notify('success', 'Profile updated successfully');
    }
}