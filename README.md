# SPPCM-5W5

Projet web en équipe

## Stack technologique

- MAMP 5.0.6
- Wordpress 7.1
- Git 2.54.0 (2.54.0.windows.1)+
- Git LFS 3.7.1+
- GitHub

## Méthodologie

### Git

- JAMAIS TRAVAILLER SUR LA BRANCHE 'main' ou 'dev' sauf pour @Firefox13590.

### Structure des fichiers

- Mettre chaque fichiers le dossier déjà éxistant.
- Créer les dossiers manquants pour les ressources non catégorisées si nécessaire.

### Structure du code

- Structure standard pour un script JavaScript:

```js
/* 
VARIABLES
*/

// éléments HTML
const = inputs = document.querySelectorAll(".form-infolettre input[type='text']");
```

#### Nomenclature

- Le nom des classes doivent être en PascalCase.
- Le nom des champs doivent être en camelCase et peuvent ou non débuter par un `_`. Ex: `_health` ou `health`.
- Le nom des propriétés doivent être en PascalCase.
  - Il n'est pas obligatoire de préciser le modificateur d'accès si celui-ci est privé (manque de mention assume privé).
  - Le nom des constantes doivent être en SCREAMING_SNAKE_CASE.
  - Le nom des évènements doivent être en PascalCase et doivent toujours finir par `Event`. Ex: `EyeContactEvent`.
- Le nom des méthodes (fonctions) doivent être en PascalCase.

## Implémentation

### Ajouter implémentation
