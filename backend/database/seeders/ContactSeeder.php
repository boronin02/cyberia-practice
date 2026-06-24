<?php

namespace Database\Seeders;

use App\Enums\Contacts\ContactKey;
use App\Models\Contact;
use Illuminate\Database\Seeder;

final class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            ContactKey::PHONE => '+7 (999) 123-45-67',
            ContactKey::EMAIL => 'info@example.com',
            ContactKey::ADDRESS => 'г. Москва, ул. Примерная, д. 1, офис 101',
            ContactKey::COORDS => '55.751244,37.618423',
            ContactKey::TELEGRAM => 'https://t.me/example',
            ContactKey::WHATSAPP => 'https://wa.me/79991234567',
            ContactKey::VK => 'https://vk.com/example',
        ];

        foreach ($contacts as $key => $value) {
            Contact::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
