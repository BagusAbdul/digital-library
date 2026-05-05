<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('buku_id')->constrained('buku');
        $table->date('tanggal_peminjaman');
        $table->date('tanggal_pengembalian')->nullable();
        $table->enum('status_peminjaman', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');
        $table->timestamps();
        });
        DB::unprepared("
            CREATE TRIGGER reduce_stock_after_borrow
            AFTER INSERT ON peminjaman
            FOR EACH ROW
            BEGIN
                UPDATE buku SET stok = stok - 1 WHERE id = NEW.buku_id;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER restore_stock_after_return
            AFTER UPDATE ON peminjaman
            FOR EACH ROW
            BEGIN
                IF NEW.status_peminjaman = 'dikembalikan' AND OLD.status_peminjaman = 'dipinjam' THEN
                    UPDATE buku SET stok = stok + 1 WHERE id = NEW.buku_id;
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS reduce_stock_after_borrow");
        DB::unprepared("DROP TRIGGER IF EXISTS restore_stock_after_return");
        Schema::dropIfExists('peminjaman');
    }
};
