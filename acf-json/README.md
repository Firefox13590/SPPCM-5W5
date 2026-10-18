# Champs ACF — US138

Le groupe « Partenaires du footer — US138 » contient quatre groupes :
- partenaireCsn
- partenaireFneeq
- partenaireMainRouge
- partenairePlanete

Chaque groupe contient nom (texte), image (identifiant du média) et lien (URL).
Les noms suivent la convention camelCase du README. Aucun champ payant ACF Pro n’est nécessaire.

## Configuration partagée

Le fichier group_sppcm_us138_partenaires.json conserve la définition des champs dans Git.
Après récupération de la branche, activer ACF puis ouvrir ACF > Groupes de champs > Synchronisation disponible > Importer si nécessaire.
La règle cible actuellement la page « Instances syndicales », identifiant 5819 dans la sauvegarde SPPCM. Si une autre base de données utilise un identifiant différent, adapter cette règle à la page équivalente avant de saisir le contenu.

## Contenu

Ouvrir Pages > Instances syndicales > Modifier, puis le panneau Partenaires du footer — US138.
Choisir les images et saisir les liens, puis mettre à jour la page.
Le JSON partage la structure des champs, pas les valeurs ni les médias : ceux-ci restent dans la base WordPress et les uploads et doivent être transmis par le processus de migration de l’équipe.

## Affichage

Cette étape configure uniquement les champs. Le footer doit encore lire ces valeurs depuis la page de configuration, puis afficher les partenaires et leurs liens. Ne pas considérer #83 comme terminée avant d’avoir vérifié qu’une modification dans l’administration apparaît dans le footer.
