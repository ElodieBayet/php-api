# **PHP & API**

Version | Objectif | Domaine | Cadre | Démo
------- | -------- | ------- | ----- | ----
2.1 | Andragogie | Programmation | Laboratoire | -

Re-upload et correction du support 'PHP & API' daté de janvier 2020.

**N/B** : La retouche et la correction sont toujours en cours. Certaines parties sont susceptibles d'être manquantes.

---


## Présentation

Ce projet est une **ressource pédagogique** qui sert d'exemple de développement d'API REST en PHP tout en respectant, le principes des opérations CRUD, l'architecture **Model-View-Controller** et le paradigme **Orienté Objet**.

Ce support était fourni aux stagiaires ayant accompli le cours "Laboratoire PHP".


### Objectifs

- Résoudre un système de routage en PHP
- Respecter l'architecture Model-View-Controller et l'abstraction Orientée Objets
- Traiter les opérations CRUD
- Manipuler des données transitoires au format JSon
- Adopter les bonnes pratiques de conception d'une API ReST et tendre vers le modèle de maturité de Richardson
- Se préprarer à l'apprentissage d'un Framework professionnel comme [Symfony](https://symfony.com/doc).


### Prérequis

Cours 
1. "Informatique général"
1. "Algorithmique"
1. "Programmation PHP"
1. "Modélisation de base de données"
1. "Orienté Objet en PHP"
1. "SQL / MySQL"
1. "Conception d'API REST"


### Exploitation

Ce projet peut être utilisé dans un cadre d'apprentissage individuel et privé. Il ne convient pas pour une utilisation publique ou professionnelle.


---


## Description

Le projet illustre les opéartions CRUD via 2 endpoints principaux.

[Documentation](./documentation.md)


### Endpoints

#### Compositors

Path
- `/api/compositors`

Méthodes
- `GET`
- `POST`
- `UPDATE`
- `DELETE`

Fonctionnalités
- Trier
- Filtrer
- Rechercher


#### Periods

Path
- `/api/periods`

Méthodes
- `GET`
- `UPDATE`

Fonctionnalités
- Obtenir les compositeurs pour une période


### Base de données

#### Schéma entités-associations

<img src="https://demo.elodiebayet.com/php-api/assets/img/schema_entites-associations.jpg" width="429" height="185">

#### Schéma relationel

![Schéma relationel](https://demo.elodiebayet.com/php-api/assets/img/schema_relationel.jpg)


### Diagramme logiciel

(en cours de rédaction)


---


## Installation

Clônez ce _repository_ dans un répertoire local sur votre machine.

### Prérequis

- [Apache HTTP Server 2.4](https://httpd.apache.org/download.cgi)
- [PHP ^8.4](https://www.php.net/downloads.php)
- [MySQL ^8.0 et Workbench](https://dev.mysql.com/downloads/)
- [Postman API Client](https://www.postman.com/product/api-client/)


### Configuration

#### Virtual Host

Fichier **httpd-vhosts.conf**
```
<VirtualHost *:80>
	ServerName php-api.local
	DocumentRoot "YOUR-DIRECTORY-PATH-HERE"
	<Directory "YOUR-DIRECTORY-PATH-HERE">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```

Fichier **host**
```
127.0.0.1 php-api.local
::1 php-api.local
```


#### Base de données

Le dossier `_database/` contient les fichiers SQL nécessaires à l'implémentation de la base de données.

- `1_schema.sql` définit la structure (DDL). Il doit être exécuté en premier.
- `2_data_periods.sql` implémente la table `period` et ses sous-entités languistiques (DML). C'est l'entité forte, donc il doit être exécuté en deuxième.
- `3_data_compositor.sql` implémente la table `compositor` (DML). C'est l'entité faible, donc il doit être exécuté après le DML précédent.


#### Variables d'environnement

Dupliquez le fichier `env.template.php` et renommez-le en `env.local.php`. Adaptez les constantes avec des propriétés adéquantes pour votre utilisation locale – en particulier les valeurs de connexion la base de données.

Si vous déployez ce projet en ligne, dupliquez une nouvelle fois le fichier `env.template.php` et renommez-le en `env.php`. Adaptez cette fois les constantes avec des propriétés adaptées pour l'environnement de production. C'est cette version `en.php` doit être déployée sur votre serveur distant. 

**Attention** : ne divulguez jamais vos variables d'environnement publiquement.


---


## Remarques


### Références

- [Guide API ReST : Marmicode](https://guide-api-rest.marmicode.fr/api-rest)
- [API REST Best practices : Microsoft Learn](https://learn.microsoft.com/fr-fr/azure/architecture/best-practices/api-design)
- [PHP : Documentation](https://www.php.net/manual/fr/)
- [MySQL : Documentation](https://dev.mysql.com/doc/refman/8.0/en/)

