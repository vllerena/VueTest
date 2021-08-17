<?php

namespace App\Rules\Traits;

trait RoleRules
{
    public function nameRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }

    public function permissionRules($required = true, $nullable = false)
    {
        $required = $required ? 'required' : ($nullable ? 'nullable' : 'filled');
        return [$required, 'string', 'max:255'];
    }
}
