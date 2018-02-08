<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuantityToInvoiceAdditionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('additional_invoice', function($table)
       {
           $table->integer('quantity');
       });
     }

     public function down()
     {
       Schema::table('additional_invoice', function($table)
       {
           $table->dropColumn('quantity');
       });
     }
}
