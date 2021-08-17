<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\UserAttr;

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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::USERS_TABLE);
    }
}
