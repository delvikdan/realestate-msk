<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'aomaster_est' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'aomaster_est' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'g5b*3zSQ' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mzbk!I]g}dv|v$)-;81T|d[:7F%+2kwH[PK,-p8KErpzk<u3TmF(ir1A%1`wZ=LG' );
define( 'SECURE_AUTH_KEY',  '^uvUS>L.ygNAh5QmSL^B#,Z8!:D5aX)<#RtIT267DQ+I39i#mZzB&}-b[D@fm[TT' );
define( 'LOGGED_IN_KEY',    'v%lw9ohF)e<:8BI*c;qNH*FFg7Z5]wb=*|4+T}k{#uBYZE+ZZ-GD(e@[&jbZ) 6B' );
define( 'NONCE_KEY',        'Fe~MIa&H[%{7)WfC.~6pG9O0Rcp4K6-F1oLc#g{=Z,f1ZWD00U%/gOl1##1WpLp4' );
define( 'AUTH_SALT',        '5 /1YTt,`o$-sP3wl&}Qi}kf?cY:WKH[;Iu9(PEo}DtkR;-ZFy.~]a}JlS=r)qGx' );
define( 'SECURE_AUTH_SALT', '|2aBL-%}0 H0kMGFk9yU!=N1U3u*68>j5wGb>OE}[8`w&to1i*E&,saV6s~~!94Z' );
define( 'LOGGED_IN_SALT',   'PI_MsevaCWM-j5_t0+ElA0et`Ne}O{6C]c}qO3lE,szR0YH8]K%u~PQ4&*?Mw~Pi' );
define( 'NONCE_SALT',       'I:{/53DIIkvB(xOm}_XW`G;?^24?vPGkf[ W>[o8#l?a:eBb&n>MKt[d7&e1!R3Z' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'est_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
