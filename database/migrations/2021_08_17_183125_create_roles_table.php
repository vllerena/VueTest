<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\RoleAttr;

class CreateRolesTable extends Migration
{
    private const ROLES_TABLE = RoleAttr::TABLE_NAME;
    public function up()
    {
        Schema::create(self::ROLES_TABLE, function (Blueprint $table) {
            $table->id(RoleAttr::ID);
            $table->string(RoleAttr::NAME);
            $table->text(RoleAttr::PERMISSION)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::ROLES_TABLE);
    }
}
