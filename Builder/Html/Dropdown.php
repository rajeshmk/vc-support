<?php

namespace Vocolabs\Support\Builder\Html;

class Dropdown
{
    public function fromAssociative(array $data_array, string $key_column, string $value_column, $default = null): string
    {
        $html = '';
        foreach ($data_array as $row) {
            $html .= '<option value="' . $row[$key_column] . '"'
                . ($default == $row[$key_column] ? ' selected' : '')
                . '>' . $row[$value_column] . '</option>';
        }

        return $html;
    }

    public function fromNvp(array $data_array, $default = null): string
    {
        $html = '';
        foreach ($data_array as $name => $value) {
            $html .= '<option value="' . $name . '"'
                . ($default == $name ? ' selected' : '')
                . '>' . $value . '</option>';
        }

        return $html;
    }

    public function fromScalar(array $data_array, $default = null): string
    {
        $html = '';
        foreach ($data_array as $value) {
            $html .= '<option value="' . $value . '"'
                . ($default == $value ? ' selected' : '')
                . '>' . ucwords(str_replace(['_', '-'], ' ', $value)) . '</option>';
        }

        return $html;
    }

    public function voco_scalar_json_dropdown(array $data_array): array
    {
        return array_map(function ($value) {
            return [
                'text' => ucwords(str_replace(['_', '-',  '.'], ' ', $value)),
                'id' => $value,
            ];
        }, $data_array);
    }
}
