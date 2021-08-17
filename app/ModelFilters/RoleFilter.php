<?php

namespace App\ModelFilters;

use App\Models\Info\RoleAttr;
use EloquentFilter\ModelFilter;

class RoleFilter extends ModelFilter
{
    public function name($name)
    {
        return $this->where(RoleAttr::NAME, 'LIKE', "%$name%");
    }
}
