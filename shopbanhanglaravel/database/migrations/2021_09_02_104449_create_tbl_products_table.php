<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->text('product_desc');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('product_content')->nullable();
            $table->integer('product_price')->nullable();
            $table->string('product_image');
            $table->string('product_size')->default(1);
            
            $table->integer('product_status');
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
