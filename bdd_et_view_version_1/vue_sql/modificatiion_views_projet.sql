
create or replace view v_projet_session as
    select
        p.id as projet_id,
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
        p.status as status_projet,
        p.activiter as activiter_projet,
        p.created_at as date_projet,
        tf.type_formation,
        cfps.nom as nom_cfp,
        cfps.adresse_ville as adresse_ville_cfp,
        cfps.adresse_lot as adresse_lot_cfp,
        cfps.adresse_region as adresse_region_cfp,
        cfps.email as mail_cfp,
        cfps.telephone as tel_cfp,
        cfps.domaine_de_formation,
        cfps.nif as nif_cfp,
        cfps.stat as stat_cfp,
        cfps.rcs as rcs_cfp,
        cfps.cif as cif_cfp,
        cfps.logo as logo_cfp,
        ts.totale_session
    from projets p
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on p.cfp_id = cfps.id
    join v_totale_session ts on ts.projet_id = p.id;

create or replace view v_groupe_entreprise as
    select
        ge.id as groupe_entreprise_id,
        ge.groupe_id,
        ge.entreprise_id,
        e.nom_etp,
        e.adresse_rue,
        e.adresse_quartier,
        e.adresse_code_postal,
        e.adresse_ville,
         e.adresse_region,
        e.logo,
        e.nif,
        e.stat,
        e.rcs,
        e.cif,
        e.secteur_id,
        e.email_etp,
        e.site_etp,
        (e.activiter) activiter_etp,
        e.telephone_etp,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'Prévisionnel'
            when 2 then 'A venir'
            when 3 then 'En cours'
            when 4 then 'Terminé'
        end item_status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'status_grise'
            when 2 then 'status_confirme'
            when 3 then 'statut_active'
            when 4 then 'status_termine'
        end class_status_groupe,
        g.activiter as activiter_groupe,
        g.type_payement_id,
        tp.type as type_payement
    from groupe_entreprise ge
    join groupes g on ge.groupe_id = g.id
    join entreprises e on ge.entreprise_id = e.id
    join type_payement tp on g.type_payement_id = tp.id;

create or replace view v_groupe_projet_entreprise as
    select
        p.nom_projet,
        p.type_formation_id,
        p.cfp_id,
        p.created_at as date_projet,
        p.status as status_projet,
        p.activiter as activiter_projet,
        tf.type_formation,
        vpe.*,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.domaine_de_formation,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp
    from projets p
    join v_groupe_entreprise vpe on p.id = vpe.projet_id
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on cfps.id = p.cfp_id;


create or replace view v_groupe_projet_entreprise_module as
    select
        vgpe.*,
        mf.reference,
        mf.nom_module,
        mf.prix,
        mf.duree,
        mf.modalite_formation,
        mf.duree_jour,
        mf.objectif,
        mf.prerequis,
        mf.description,
        mf.materiel_necessaire,
        mf.cible,
        mf.niveau_id,
        mf.niveau,
        mf.formation_id,
        mf.nom_formation,
        mf.domaine_id,
        mf.nom,
        mf.email,
        mf.telephone,
        mf.pourcentage
    from
        v_groupe_projet_entreprise vgpe
    join moduleformation mf on vgpe.module_id = mf.module_id;

CREATE OR REPLACE VIEW v_detailmodule AS
    SELECT
        d.id AS detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_id,
        d.projet_id,
        d.groupe_id,
        d.cfp_id,
        g.entreprise_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status_groupe,
        g.activiter_groupe,
        mf.reference,
        mf.nom_module,
        mf.formation_id,
        mf.nom_formation,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        p.nom_projet,
        (c.nom) nom_cfp
    FROM
        details d
    JOIN v_groupe_projet_entreprise g ON
        d.groupe_id = g.groupe_id
    JOIN moduleformation mf ON
        mf.module_id = g.module_id
    JOIN formateurs f ON
        f.id = d.formateur_id
    JOIN projets p ON
        d.projet_id = p.id
    JOIN cfps c ON
        p.cfp_id = c.id
    GROUP BY
    d.id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.formateur_id,
    d.projet_id,
    d.groupe_id,
    d.cfp_id,
    g.max_participant,
    g.min_participant,
    g.nom_groupe,
    g.module_id,
    g.date_debut,
    g.date_fin,
    g.status_groupe,
    g.activiter_groupe,
    mf.reference,
    mf.nom_module,
    mf.formation_id,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    p.nom_projet,
    c.nom,
    g.entreprise_id
    ;


CREATE OR REPLACE VIEW v_participant_groupe AS
    SELECT
        dm.*,
        pg.stagiaire_id,
        s.matricule,
        s.nom_stagiaire,
        s.prenom_stagiaire,
        s.genre_stagiaire,
        s.fonction_stagiaire,
        s.mail_stagiaire,
        s.telephone_stagiaire,
        s.user_id AS user_id_stagiaire,
        s.photos,
        s.departement_entreprise_id as departement_id,
        s.cin,
        s.date_naissance,
        (s.lot) adresse,
        s.niveau_etude,
        s.activiter AS activiter_stagiaire,
        s.lieu_travail
    FROM
        participant_groupe pg
    JOIN v_detailmodule dm ON
        pg.groupe_id = dm.groupe_id
    JOIN stagiaires s ON
        s.id = pg.stagiaire_id;



create or replace view v_projet_cfp as
    select
        p.id as projet_id,
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
        p.status,
        p.activiter as activiter_projet,
        p.created_at as date_projet,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.domaine_de_formation as domaine_de_formation_cfp,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp,
        tf.type_formation
    from projets p
    join cfps on cfps.id = p.cfp_id
    join type_formations tf on tf.id = p.type_formation_id;