<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\UserAttr;
use App\Models\Info\RoleAttr;

class CreateUsersTable extends Migration
{
    private const USERS_TABLE = UserAttr::TABLE_NAME;
    public function up()
    {
        Schema::create(self::USERS_TABLE, function (Blueprint $table) {
            $table->id(UserAttr::ID);
            $table->string(UserAttr::NAME);
            $table->string(UserAttr::USERNAME)->unique();
            $table->string(UserAttr::PASSWORD);
            $table->boolean(UserAttr::IS_ACTIVE)->default(true);
            $table->boolean(UserAttr::IS_SUPERUSER)->default(false);
            $table->foreignId(UserAttr::ROLE_ID)
                ->nullable()
                ->constrained(RoleAttr::TABLE_NAME, RoleAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::USERS_TABLE);
    }
}
