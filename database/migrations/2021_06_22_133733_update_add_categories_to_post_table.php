<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddCategoriesToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // qui stabilisco che la colonna sarà una foreign key
            $table->foreign('category_id')
                // che punta alla colonna id... 
                ->references('id')
                // della tabella 'categories' 
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // regole per cancellare la colonna

            // prima cancello la foreign key e gli passo come parametro ('nometabella_nomedellacolonna_foreign')
            $table->dropForeign('posts_category_id_foreign');

            // poi cancello la colonna 
            $table->dropColumn('category_id');
        });
    }
}
