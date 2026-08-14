# Formation Hub

Projet démonstrateur construit avec Laravel 13, Inertia.js et Vue 3, sur le thème de la gestion de sessions de formation professionnelle. Je n'avais aucune expérience professionnelle sur Laravel ni sur Inertia avant ce projet : l'objectif était de monter en compétence sur cette stack en construisant quelque chose de concret et de complet, pas de me contenter d'un tutoriel.

## Fonctionnalités

Le projet permet à un administrateur de créer, modifier et consulter des sessions de formation, en leur assignant un formateur. Un formateur, une fois connecté, ne voit que ses propres sessions et les personnes qui y sont inscrites. Les contacts inscriptibles à une session proviennent d'une API externe, mise en cache localement, et l'inscription d'un contact à une session est bloquée automatiquement si la capacité maximale est atteinte ou si ce contact est déjà inscrit.

## Choix techniques

Le projet utilise Inertia.js plutôt qu'une architecture API découplée avec Sanctum, pour pratiquer un monolithe moderne côté Laravel (rendu piloté par le serveur, pas de couche API séparée) plutôt qu'une SPA totalement découplée.

L'intégration à un CRM externe (initialement décrite comme du Salesforce) est simulée avec une API REST publique et gratuite (`jsonplaceholder.typicode.com`), qui joue le rôle des contacts externes. Configurer une vraie authentification Salesforce en quelques jours n'aurait apporté aucune valeur supplémentaire pour démontrer le pattern d'intégration recherché : appel HTTP, gestion des erreurs, mise en cache. Le code qui encapsule cet appel (`ContactService`) est écrit pour être indépendant de la source réelle des données.

Le cache utilise le driver `database` de Laravel plutôt que Redis. Redis aurait nécessité un service supplémentaire à faire tourner localement sous Windows, sans bénéfice réel pour démontrer le pattern de mise en cache : le code applicatif (`Cache::remember`, `Cache::forget`) reste strictement identique quel que soit le driver, seule la variable `CACHE_STORE` dans `.env` changerait pour basculer sur Redis en production.

## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

La base de données est en SQLite et se configure automatiquement, rien d'autre à installer.

Un compte administrateur est créé par le seeder : `admin@test.com` / `password`. Les comptes formateurs sont générés aléatoirement par la même commande.

## Tests

```bash
php artisan test
```

La suite couvre le comportement du cache sur l'appel à l'API externe (via `Http::fake`), le blocage d'une inscription quand la capacité d'une session est atteinte, le blocage d'une inscription en doublon, le refus d'un formateur à créer une inscription, et le parcours complet d'une inscription réussie.

## Hors périmètre

Ce projet ne couvre pas le rendu côté serveur (SSR), l'authentification à deux facteurs, la suppression de compte avancée, ni une vraie intégration Salesforce. Ce sont des choix délibérés pour rester concentrée sur les points jugés les plus utiles à démontrer dans le temps disponible.