<?php

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'elaine_leite');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_Z7qy@%&bs^JN4ERxXXrWMw.Mv{R,Mx?SJUGd+^)KdK;=2/%Ua0kP([.J>~,VjBf');
define('SECURE_AUTH_KEY',  'YEEU7sfss[Pw{mNZ,i`E*-edb=lE3FHdq4&MMrz;pJVp^&=sDxCm>/}>npUZ^@Cy');
define('LOGGED_IN_KEY',    '<r0?<_=@UKJVlTTLaz!t?5`xoy6l6P5uV&mgF]]F6<f9g=^|AjWH01Bs>p;P8FO`');
define('NONCE_KEY',        'NnWBK^y?(!/ }d1a ?+JV1gZ)0JVa4?5#<@m3X/A^^02+spe@1qN%j@,%TFhWHq*');
define('AUTH_SALT',        'xp7~N=BZMgT.a),[h|@e^( I mndY,Ao>8ZR>/k8zW9+r](HM/WEAeN7y8GArYXv');
define('SECURE_AUTH_SALT', 'MPJL9%:h(b8K m=!H;@SUp(!5zFR7U]cSBi{0n`tYmq@FUl>KY86u h_.U_<]dhi');
define('LOGGED_IN_SALT',   '4x+2U(t}.h>L]z;^N53Tsx*b`.M}@3jF1Nd0SB.)1iU%:|.bIPAtMBi,oL*L[#z#');
define('NONCE_SALT',       'itiafHaCy%C0-ik9W$` ~ZIgkF+Kpl4`z4|r0Wpi~j:^L[N<X:Eg%a+.a*h6!*eB');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wpppab22_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
