<?php

use App\Enums\Contacts\ContactKey;
use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        foreach (ContactKey::getKeys() as $key) {
            (new Contact([
                'key' => $key,
                'value' => '',
            ]))->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Contact::query()->delete();
    }
};
