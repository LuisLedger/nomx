<?php

namespace App\Models;

use App\Models\FieldParser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static $roles = [
        'admin'           => 'Super Admin',
        'manager'         => 'Administrador',
        'functionary'     => 'Funcionario público',
        'aux-functionary' => 'Funcionario aux',
        'specialist'      => 'Especialista',
        'citizen'         => 'Ciudadano',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'twitter_id',
        'oauth_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public static $columns = [
        [
            'name'  => 'id',
            'alias' => '#',
            'order' => 'DESC',
            'sort'  => true,
        ],
        [
            'name'  => 'name',
            'alias' => 'Nombre',
            'order' => 'ASC',
        ],
        [
            'name'  => 'email',
            'alias' => 'Correo',
            'order' => 'ASC',
        ],
        [
            'name'  => 'role',
            'alias' => 'Rol usuario',
            'order' => 'ASC',
        ],
        [
            'name'  => 'created_at',
            'alias' => 'Fecha alta',
            'order' => 'ASC',
        ],
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleNameAttribute()
    {
        return Self::$roles[$this->role];
    }

    /* static */
    public static function getUsers($request)
    {
        $query = Self::select('*');

        if (isset($request->role)) {
            $query = $query->whereIn('role', $request->role);
        }

        if (isset($request->cols)) {
            foreach ($request->cols as $column) {
                if (isset($column['sort'])) {
                    if ($column['sort'] == 'true') {
                        $query = $query->orderBy($column['name'], $column['order']);
                    }
                }
            }
        }

        return $query->paginate($request->limit)->appends($request->all());
    }

    public static function getFieldsInfo()
    {
        $field_alias = [
            // 'id'         => 'ID',
            'name'       => 'Nombre',
            'last_name'  => 'Apellidos',
            'user_name'  => 'Nombre Usuario',
            'email'      => 'Correo Electrónico',
            'role'       => 'Rol de usuario',
            'avatar_url' => 'Avatar',
            'password'   => 'Contraseña',
        ];

        $db_info = \DB::select('describe users');

        $result = [];
        foreach ($db_info as $item) {
            if (isset($field_alias[$item->Field])) {
                $field = [
                    'name'            => $item->Field,
                    'alias'           => $field_alias[$item->Field],
                    'required'        => ($item->Null == 'NO') ? true : false,
                    'type'            => FieldParser::FieldParserToForm($item->Field, $item->Type),
                    'catalog_related' => [],
                ];

                if ($item->Field == 'role') {
                    $field['type']            = 'select';
                    $field['catalog_related'] = Self::$roles;
                }

                if ($item->Field == 'avatar_url') {
                    $field['type']            = 'url';
                    $field['catalog_related'] = Self::$roles;
                }

                if ($item->Field == 'password') {
                    $result[] = $field;

                    $field = [
                        'name'            => $item->Field . '_confirm',
                        'alias'           => 'Confirmar Contraseña',
                        'required'        => ($item->Null == 'NO') ? true : false,
                        'type'            => FieldParser::FieldParserToForm($item->Field, $item->Type),
                        'catalog_related' => [],
                    ];
                }

                $result[] = $field;
            }
        }

        return $result;
    }
}
