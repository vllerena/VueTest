<?php

namespace App\ModelFilters;

use App\Models\Info\UserAttr;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function name($name)
    {
        return $this->related('user', UserAttr::NAME, 'LIKE', "%$name%");
    }

    public function username($username)
    {
        return $this->related('user', UserAttr::USERNAME, 'LIKE', "%$username%");
    }

    public function isActive($active)
    {
        $isActive = boolval($active);
        return $this->related('user', UserAttr::IS_ACTIVE, '=', $isActive);
    }

    public function user($id)
    {
        return $this->related('user', UserAttr::ID, '=', $id);
    }
}
