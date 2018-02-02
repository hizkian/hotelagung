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
       Schema::table('invoice_additional', function($table)
       {
           $table->integer('quantity');
       });
     }

     public function down()
     {
       Schema::table('invoice_additional', function($table)
       {
           $table->dropColumn('quantity');
       });
     }
}
