<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'leffet-lune' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'j`0(B>I$k3@h.gW#mSS|CCS)m5~]|#)[u(D,Koq+yVnA*;XC:/r`xkf_4mO+ ,I;' );
define( 'SECURE_AUTH_KEY',  'CFz&-+^*fZPkGRr|?;$`QSqc>{=!jsCs%3[|CO=T-EG*z2yCJm>cOagrSp,twD`2' );
define( 'LOGGED_IN_KEY',    '>>MsY}>]`.CM^omn]Q>f0YiIxkh95Y;x{to2vV7wBQKR(!,4pR.r*e=O@^V/<`]F' );
define( 'NONCE_KEY',        '&I`YNJET8i%ji8:0+;7cz(vCj|H ^P5;Bb4ygby-dBE72U$_iVXt6VZDR%uV&5`:' );
define( 'AUTH_SALT',        'ps4QMxLK`@Idv8i&|l8l6qFE:`.Zf(_o:20@0J*Ro>4eurZIy%aBs 2PdJIO1}2_' );
define( 'SECURE_AUTH_SALT', 'j,E{vRO)Y5;*CG(=u3XcB{9ntnqJ<six!1Ups-Y.vtJ/,^Xc$*aS(F%:)l:p*34Z' );
define( 'LOGGED_IN_SALT',   '5+pLa7NLfa|Km}5 {ELv-Xgd2#:85_p!aU~=YbJNKT62HWg:T +0FX=)>G,M?eHZ' );
define( 'NONCE_SALT',       ',:i[7S.QTt-OAuNebkAft Q7NBc+({HrFqDBi0;tWHE_/M!f,@f<C+J{z?j/g|nR' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'lili_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
