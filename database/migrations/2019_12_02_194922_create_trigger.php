<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER total_price AFTER UPDATE ON `order_items` FOR EACH ROW
            BEGIN
            UPDATE myshop.orders
            SET myshop.orders.total=(orders.total-(OLD.price*OLD.amount)+(NEW.price*NEW.amount))
            WHERE myshop.orders.id = NEW.order_id;
            END
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DROP TRIGGER `total_price`');
    }
}
