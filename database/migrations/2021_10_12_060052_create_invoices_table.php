<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50); // رقم الفاتورة
            $table->date('invoice_date'); // تاريخ الفاتورة
            $table->date('due_date'); // تاريخ الاستحقاق
            $table->string('product'); // المنتج
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete();//القسم
//            $table->string('section');//القسم
            $table->double('discount');  // الخصم
            $table->string('rate_vat', 999);     // نسبة الضريبة
            $table->double('value_vat', 99, 2); // قيمة الضريبة
            $table->double('total', 99, 2);     // المبلغ الكلي للفاتروة
            $table->string('status', 50);             // حالة الفاتورة
            $table->integer('value_status');   // اشارة المدفوعة 1 وهيك
            $table->double('amount_collection', 99, 2)->nullable();
            $table->double('amount_commission', 99, 2)->nullable();
            $table->text('note')->nullable();
            $table->string('user');
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
