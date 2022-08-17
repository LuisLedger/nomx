<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldParser extends Model
{
    use HasFactory;

    public static function FieldParserToForm($field_name, $field_type) 
    {
        $result = '';

        if (strpos($field_type, 'varchar') !== false) {
            $result = 'text';
            if (strpos($field_name, 'url') !== false) {
                $result = 'url';
            } elseif (strpos($field_name, 'password') !== false) {
                $result = 'password';
            }
        } elseif ($field_type == 'text') {
            $result = 'text';
            if (strpos($field_name, 'url') !== false) {
                $result = 'url';
            } elseif (strpos($field_name, 'password') !== false) {
                $result = 'password';
            }
        } elseif (strpos($field_type, 'bigint') !== false) {
            $result = 'number';
        } elseif (strpos($field_type, 'int') !== false) {
            $result = 'number';
        } elseif (strpos($field_type, 'double') !== false) {
            $result = 'number';
        }

        return $result;
    }
}
