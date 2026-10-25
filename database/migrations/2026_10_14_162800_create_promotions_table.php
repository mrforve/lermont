<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('legacy_image_url')->nullable();
            $table->longText('content')->nullable();
            $table->string('button_text', 100)->nullable();
            $table->text('button_url')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->dateTime('starts_at')->nullable()->index();
            $table->dateTime('ends_at')->nullable()->index();
            $table->timestamps();
        });

        DB::table('promotions')->insert([
            [
                'title' => 'Скидка 5 % + подарок от отеля!',
                'slug' => 'birthday',
                'legacy_image_url' => 'https://hotel-lermont.ru/wp-content/uploads/2026/08/izobrazhenie-codex-27-avg.-2026-g.-14_50_34.jpg',
                'content' => '<p>🎉 <strong>Акция для именинников.</strong> Скидка 5 % + подарок от отеля! Отпразднуйте день рождения с комфортом у моря. Мы дарим скидку и небольшой сюрприз, чтобы ваш праздник стал ещё приятнее.</p><p><strong>Период действия:</strong> 7 дней до и после дня рождения, а также в сам день рождения.</p><p><strong>Условия:</strong> необходимо подтвердить дату рождения при бронировании.</p><p><strong>Как получить:</strong> забронируйте номер напрямую в отеле по телефону.</p><p>📅 Сделайте свой день рождения незабываемым в отеле «Лермонт»!</p>',
                'button_text' => 'Забронировать',
                'button_url' => '/booking/',
                'is_active' => true,
                'sort_order' => 10,
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Чёрная пятница: 3+1 ночь в подарок!',
                'slug' => 'black-friday-3-plus-1',
                'legacy_image_url' => 'https://hotel-lermont.ru/wp-content/uploads/2026/08/izobrazhenie-codex-27-avg.-2026-g.-14_53_39.jpg',
                'content' => '<p><strong>Период проживания по акции:</strong> с <strong>1 ноября по 30 декабря 2026 года</strong> и с <strong>11 января по 28 февраля 2027 года</strong>, <strong>за исключением праздничных дат</strong>.</p><p><strong>Условия акции «3+1»:</strong> при бронировании проживания от 4 ночей <strong>каждая 4-я ночь — в подарок</strong>. Предложение действует в указанные периоды и не распространяется на праздничные даты. Количество номеров по акции ограничено.</p>',
                'button_text' => 'Забронировать номер',
                'button_url' => '/booking/?be-offer=965144',
                'is_active' => true,
                'sort_order' => 20,
                'starts_at' => null,
                'ends_at' => '2027-02-28 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Для молодожёнов и на годовщину свадьбы',
                'slug' => 'newlyweds',
                'legacy_image_url' => 'https://hotel-lermont.ru/wp-content/uploads/2026/08/exec-f2d827ff-9a58-4edd-a057-02cae5434e0a-1024x683.png',
                'content' => '<p>👰‍♀️🤵‍♂️ <strong>Скидка 10 % + подарок от отеля!</strong> Начните или продолжите вашу историю любви с романтического отдыха у моря. Мы поможем сделать этот момент особенным.</p><p><strong>Период действия:</strong> 7 дней до и после даты бракосочетания или годовщины, а также в сам праздничный день.</p><p><strong>Условия:</strong> требуется подтверждение даты бракосочетания.</p><p><strong>Как получить:</strong> забронируйте номер напрямую в отеле по телефону.</p><p>❤️ Пусть ваш отдых станет частью прекрасной истории!</p>',
                'button_text' => 'Забронировать',
                'button_url' => '/booking/',
                'is_active' => true,
                'sort_order' => 30,
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Спецтариф для групповых заездов',
                'slug' => 'group-rates',
                'legacy_image_url' => 'https://hotel-lermont.ru/wp-content/uploads/2024/10/i-2-1024x806.webp',
                'content' => '<p>👥 <strong>Скидка от 5 до 20 % (под запрос).</strong> Планируете поездку большой компанией, корпоративный отдых или мероприятие? Мы предложим выгодные условия для группового размещения.</p><p><strong>Размер скидки:</strong> зависит от сезона, периода проживания и загрузки отеля.</p><p><strong>Включено:</strong> завтрак «шведский стол».</p><p><strong>Ограничения:</strong> не действует в период высокой загрузки, праздничных дат и высокого сезона.</p><p><strong>Как получить:</strong> отправьте запрос на бронирование — мы рассчитаем индивидуальное предложение.</p><p>🗓️ Идеальный вариант для дружной компании или корпоративного выезда!</p>',
                'button_text' => 'Отправить запрос',
                'button_url' => '/contacts',
                'is_active' => true,
                'sort_order' => 40,
                'starts_at' => null,
                'ends_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
