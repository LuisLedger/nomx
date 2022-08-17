<?php

namespace App\Models;

use App\Models\FieldParser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSocial extends Model
{
    use HasFactory;

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
            'name'  => 'description',
            'alias' => 'Descripción',
            'order' => 'ASC',
        ],
        [
            'name'  => 'color',
            'alias' => 'Color',
            'order' => 'ASC',
            'type'  => 'color'
        ],
    ];

    public static function getThemeSocial($request)
    {
        $query = Self::select('*');

        if (isset($request->name)) {
            $query = $query->whereIn('name', $request->name);
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
            'name'        => 'Nombre',
            'description' => 'Descripción',
            'color'       => 'Color',
        ];

        $db_info = \DB::select('describe theme_socials');

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

                if ($item->Field == 'color') {
                    $field['type'] = 'color';
                }

                $result[] = $field;
            }
        }

        return $result;
    }
}
