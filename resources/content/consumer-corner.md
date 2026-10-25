# Уголок потребителя

Страница: `/ugolok-potrebitelya`.

При первом развёртывании создайте запись страницы:

```sh
php artisan db:seed --class=ConsumerCornerSeeder --force
```

Seeder использует `firstOrCreate`: повторный запуск сохраняет уже внесённые через админку изменения. Содержимое страницы редактируется в разделе «Страницы» → «Уголок потребителя» → контентный блок «HTML-код». `consumer-corner.html` содержит начальное содержимое для новых установок.

Исходные ссылки на шесть сканов и пять PDF из пользовательского HTML сохранены в `consumer-corner-sources.json`. Файлы размещены в `public/documents/consumer`, содержимое документов не изменялось. Внешняя ссылка на реестр сохранена. Стили страницы: `resources/css/pages/consumer-corner.css` (подключается общим `resources/css/app.css`).
