-- Источник WordPress: база lermont_wordpress_import
-- Целевая Laravel-база: lermont
-- Запускать без указания базы:
-- mysql -u root < import_wordpress_content_cross_db.sql

-- Импорт материалов WordPress в Laravel Lermont
-- Требование: таблицы wp_posts, wp_postmeta, wp_terms,
-- wp_term_taxonomy и wp_term_relationships должны находиться
-- в той же базе данных, что и content_categories/content_items.
--
-- Изображения этим SQL не скачиваются: MySQL не умеет загружать HTTP-файлы.
-- В конце файла есть SELECT со списком URL главных изображений.

START TRANSACTION;

-- 1. Категории
INSERT INTO lermont.content_categories
    (name, slug, description, is_active, sort_order, created_at, updated_at)
VALUES
    ('Новости', 'news', NULL, 1, 10, NOW(), NOW()),
    ('Спецпредложения', 'offers', NULL, 1, 20, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order),
    updated_at = NOW();

SET @news_category_id = (
    SELECT id
    FROM lermont.content_categories
    WHERE slug = 'news'
    LIMIT 1
);

SET @offers_category_id = (
    SELECT id
    FROM lermont.content_categories
    WHERE slug = 'offers'
    LIMIT 1
);

-- 2. Импорт опубликованных записей из рубрики WordPress "Новости".
-- Материалы с акционными словами автоматически относятся к "Спецпредложениям".
INSERT INTO lermont.content_items (
    content_category_id,
    title,
    slug,
    image,
    short_description,
    content,
    button_text,
    button_url,
    is_active,
    show_on_home,
    sort_order,
    published_at,
    starts_at,
    ends_at,
    seo_title,
    seo_description,
    created_at,
    updated_at
)
SELECT
    CASE
        WHEN LOWER(p.post_title) REGEXP
            'акци|скидк|предложен|новый год|14 февраля|23 февраля|8 марта|майск|черн(ая|ую) пятниц|празднич'
        THEN @offers_category_id
        ELSE @news_category_id
    END AS content_category_id,

    p.post_title AS title,

    CASE
        WHEN p.post_name IS NULL OR p.post_name = ''
            THEN CONCAT('wordpress-', p.ID)
        ELSE p.post_name
    END AS slug,

    NULL AS image,

    CASE
        WHEN p.post_excerpt IS NOT NULL AND TRIM(p.post_excerpt) <> ''
            THEN LEFT(TRIM(p.post_excerpt), 1000)
        ELSE LEFT(
            TRIM(
                REGEXP_REPLACE(
                    REGEXP_REPLACE(p.post_content, '<[^>]*>', ' '),
                    '[[:space:]]+',
                    ' '
                )
            ),
            1000
        )
    END AS short_description,

    -- Меняем абсолютные ссылки старого сайта на относительные.
    REPLACE(
        REPLACE(
            p.post_content,
            'https://hotel-lermont.ru',
            ''
        ),
        'http://hotel-lermont.ru',
        ''
    ) AS content,

    NULL AS button_text,
    NULL AS button_url,
    1 AS is_active,

    CASE
        WHEN LOWER(p.post_title) REGEXP
            'акци|скидк|предложен|новый год|14 февраля|23 февраля|8 марта|майск|черн(ая|ую) пятниц|празднич'
        THEN 1
        ELSE 0
    END AS show_on_home,

    0 AS sort_order,
    NULLIF(p.post_date, '0000-00-00 00:00:00') AS published_at,
    NULL AS starts_at,
    NULL AS ends_at,

    NULLIF(yoast_title.meta_value, '') AS seo_title,
    NULLIF(yoast_description.meta_value, '') AS seo_description,

    COALESCE(NULLIF(p.post_date, '0000-00-00 00:00:00'), NOW()) AS created_at,
    COALESCE(NULLIF(p.post_modified, '0000-00-00 00:00:00'), NOW()) AS updated_at

FROM lermont_wordpress_import.wp_posts AS p

INNER JOIN lermont_wordpress_import.wp_term_relationships AS rel
    ON rel.object_id = p.ID

INNER JOIN lermont_wordpress_import.wp_term_taxonomy AS tax
    ON tax.term_taxonomy_id = rel.term_taxonomy_id
    AND tax.taxonomy = 'category'

INNER JOIN lermont_wordpress_import.wp_terms AS term
    ON term.term_id = tax.term_id
    AND term.slug = 'news'

LEFT JOIN lermont_wordpress_import.wp_postmeta AS yoast_title
    ON yoast_title.post_id = p.ID
    AND yoast_title.meta_key = '_yoast_wpseo_title'

LEFT JOIN lermont_wordpress_import.wp_postmeta AS yoast_description
    ON yoast_description.post_id = p.ID
    AND yoast_description.meta_key = '_yoast_wpseo_metadesc'

WHERE
    p.post_type = 'post'
    AND p.post_status = 'publish'

ON DUPLICATE KEY UPDATE
    content_category_id = VALUES(content_category_id),
    title = VALUES(title),
    short_description = VALUES(short_description),
    content = VALUES(content),
    is_active = VALUES(is_active),
    show_on_home = VALUES(show_on_home),
    published_at = VALUES(published_at),
    seo_title = VALUES(seo_title),
    seo_description = VALUES(seo_description),
    updated_at = VALUES(updated_at);

COMMIT;

-- 3. Проверка результата
SELECT
    cc.name AS category,
    COUNT(*) AS materials_count
FROM lermont.content_items AS ci
INNER JOIN lermont.content_categories AS cc
    ON cc.id = ci.content_category_id
WHERE cc.slug IN ('news', 'offers')
GROUP BY cc.id, cc.name
ORDER BY cc.sort_order;

-- 4. Список главных изображений для последующего скачивания.
-- local_path — значение, которое нужно будет записать в content_items.image
-- после скачивания файла в storage/app/public/content-items/imported/.
SELECT
    ci.id AS content_item_id,
    ci.slug,
    CONCAT(
        'https://hotel-lermont.ru/wp-content/uploads/',
        attached_file.meta_value
    ) AS image_url,
    CONCAT(
        'content-items/imported/',
        SUBSTRING_INDEX(attached_file.meta_value, '/', -1)
    ) AS local_path
FROM lermont.content_items AS ci

INNER JOIN lermont_wordpress_import.wp_posts AS p
    ON (
        p.post_name = ci.slug
        OR (
            ci.slug LIKE 'wordpress-%'
            AND p.ID = CAST(REPLACE(ci.slug, 'wordpress-', '') AS UNSIGNED)
        )
    )

INNER JOIN lermont_wordpress_import.wp_postmeta AS thumbnail
    ON thumbnail.post_id = p.ID
    AND thumbnail.meta_key = '_thumbnail_id'

INNER JOIN lermont_wordpress_import.wp_postmeta AS attached_file
    ON attached_file.post_id = CAST(thumbnail.meta_value AS UNSIGNED)
    AND attached_file.meta_key = '_wp_attached_file'

WHERE attached_file.meta_value IS NOT NULL
ORDER BY ci.id;
