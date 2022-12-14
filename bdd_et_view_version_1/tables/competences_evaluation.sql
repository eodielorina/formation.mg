-- CREATE TABLE `competence_a_evaluers` (
--   `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   `titre_competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `module_id` bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
--   `objectif` int(10) UNSIGNED not null DEFAULT 0,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table `evaluation_stagiaires`(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
    `competence_id` bigint(20) UNSIGNED NOT NULL REFERENCES competence_a_evaluers(id) ON DELETE CASCADE,
    `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
    `note_avant` int(10) UNSIGNED not null DEFAULT 0,
    `note_apres` int(10) UNSIGNED not null DEFAULT 0,
    `status` int UNSIGNED not null DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
