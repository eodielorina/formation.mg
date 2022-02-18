CREATE OR REPLACE VIEW v_departement_service_entreprise AS SELECT
    etp.id as entreprise_id,
    etp.nom_etp,
    dep.nom_departement,
    serv.nom_service
FROM
    departement_entreprises dep,
    entreprises etp,
    services serv
WHERE
    dep.entreprise_id = etp.id AND
    serv.departement_entreprise_id = dep.id;

