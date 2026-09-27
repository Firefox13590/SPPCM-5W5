# SPPCM-5W5

Projet web en équipe

## Stack technologique

- MAMP 5.0.6
- Wordpress 7.1
- Git 2.54.0 (2.54.0.windows.1)+
- Git LFS 3.7.1+
- GitHub
- Figma

## Méthodologie

### Git

- JAMAIS TRAVAILLER SUR LA BRANCHE `main` ou `dev` sauf pour @Firefox13590.
- Créer une branche avec l'identifiant du user-story avant de travailler. Ex: US130.
  - "US" en majuscule.
- une fois les modification terminées, TOUJOURS faire un pull request vers `dev`.
  - Seul @Firefox13590 a le droit d'accepter ou non les pull requests.

### Structure des fichiers

- Mettre chaque fichier dans le dossier déjà éxistant.
- Créer les dossiers manquants pour les ressources non catégorisées si nécessaire.

### Structure du code

- Structure standard pour un script JavaScript fonctionnel (même logique pour le code PHP): **[readme.js](/js/readme.js)**
- Structure standard pour une feuille de styles CSS (même logique pour SASS): **[readme.css](/css/readme.css)**, **[readme.scss](/sass/_readme.scss)**

#### Nomenclature

- Le nom des variables doivent être en camelCase.
  - Le nom des constantes qui ne sont pas des éléments HTML doivent être en SCREAMING_SNAKE_CASE.
- Le nom des classes et fonctions doivent être en PascalCase.
- Le nom des classes et identifiants CSS doivent être en kebab-case.

- Le nom des variables, constantes, classes, etc. peut contenir des abréviations.
  - Si les abréviations ne sont pas universelles (hp -> hit points, js -> JavaScript, el -> element, img -> image, etc.), préciser le nom complet avec un commentaire.
  - Le français et l'anglais sont permis, mais il faut offrir une traduction en commentaire si l'anglais est employé (TOKEBAKICITTE).

- Le nom des variables doivent être formulées sous la forme `quoi[en lien avec quoi 1][en lien avec quoi 2][en lien avec quoi #n]`
  - Quoi (un élément)
  - En lien avec quoi (en lien avec un autre élément)
  - En lien avec quoi (en lien avec un autre élément) et ainsi de suite
  - La séparation de la formulation d'une variable peut être interprétée de différentes manière tant que l'idée générale reste la même.

| Exemple | quoi | en lien avec quoi 1 | en lien avec quoi 2 |
| --- | --- | --- | --- |
| inputsFormInfolettre | inputs | Form | Infolettre |
| inputsFormInfolettre | inputs | FormInfolettre | |
| inputsFormInfolettre | inputsForm | Infolettre | |
| header nav span.nav-item | span.nav-item | nav | header |
| RANGEES_MAX_PAR_PLATEFORME | RANGEES_MAX | PAR_PLATEFORME | |
| RANGEES_MAX_PAR_PLATEFORME | RANGEES_MAX | PLATEFORME | |
