<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    DB::unprepared("DROP PROCEDURE IF EXISTS sp_pinjam_buku");
    DB::unprepared("
        CREATE PROCEDURE sp_pinjam_buku(IN p_user_id INT, IN p_buku_id INT)
        BEGIN
            INSERT INTO peminjaman (user_id, buku_id, tanggal_peminjaman, status_peminjaman, created_at, updated_at)
            VALUES (p_user_id, p_buku_id, CURDATE(), 'dipinjam', NOW(), NOW());
        END
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_procedures');
    }
};
