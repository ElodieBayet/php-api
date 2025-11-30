# **PHP & API :** Documentation

Chaque API REST doit être accompagnée d'une documentation. Que l'API soit publique ou privée. Ceci est donc la documentation qui s'adjoint au projet **PHP & API**.


## Description

### Requêtes et réponses

**En-tête des requêtes HTTP**
- `Content-Type` application/json; charset=UTF-8

**Méthodes des requêtes HTTP**
- `GET`
- `POST`
- `PUT`
- `DELETE`

**Corps des requêtes HTTP**
- Format `json`

**Codes de Statut des réponses HTTP**
- `200` OK
- `201` Created
- `204` No Content
- `400` Bad Request
- `404` Not Found
- `422` Unprocessable Content
- `500` Internal Server Error


### Données

**Types**
- `string` chaine de caractères libres
- `int` entier positif
- `date` au format `AAAA-MM-JJ`
- `url` chaine de caractères respectant le format `RFC 2396`

**Encodage**
- `UTF-8`
- Conversion `HtmlEntities` pour certains caractères. Par exemple : `&lt;` `&gt;`, etc.


---
---


## Compositeurs

```
/api/compositors
```


### `GET` : Retourner tous les compositeurs

#### Paramètres de requête - *Query parameters*

*️⃣ **Trier**

**`sort`** — Trier par <nom_du_champ>. Valeur : `string` obligatoire.
```
/api/compositors?sort=lastname
```

**`desc`** — Trier par ordre décroissant. Valeur : `aucune`. Par défaut : trié par date de naissance.
```
/api/compositors?desc
/api/compositors?desc&sort=firstname
```


*️⃣ **Filtrer**

**`born_before`** — Filter antérieurement à la date de naissance. Valeur : `string` obligatoire au format `AAAA-MM-JJ`.
```
/api/compositors?born_before=1750-01-01
```

**`born_after`** — Filter postérieurement à la date de naissance. Valeur : `string` obligatoire au format `AAAA-MM-JJ`.
```
/api/compositors?born_after=1750-01-01
```

**`dead_before`** — Filter antérieurement à la date de décès. Valeur : `string` obligatoire au format `AAAA-MM-JJ`.
```
/api/compositors?dead_before=1750-01-01
```

**`dead_after`** — Filter postérieurement à la date de décès. Valeur : `string` obligatoire au format `AAAA-MM-JJ`.
```
/api/compositors?dead_after=1750-01-01
```


*️⃣ **Rechercher**

**`origin`** — Rechercher par origine. Valeur : `string` obligatoire.
```
/api/compositors?origin=allemagne
```

**`lastname`** — Rechercher par nom de famille. Valeur : `string` obligatoire.
```
/api/compositors?lastname=schumann
```

**N/B :** Habituellement, une API fournit un paramètre de recherche générique tel que `search`. Cette fonctionnalité n'est pas implémentée ici, mais peut faire l'objet d'un exercice libre. De même que la mise en place d'une recherche par date de naissance ou date de décès.


#### Résultat

🟢 **200** OK
```json
{
    "data": [
        {
            "lastname": "string",
            "firstname": "string",
            "birth": "1000-12-31",
            "death": "1000-12-31",
            "origin": "string",
            "figure": "url",
            "id": 0
        },
        // etc.
    ],
    "total_items": 0
}
```


---


### `POST` : Créer un compositeur

#### Contenu de la requête - *Body request*

```json
{
    "lastname": "string",
    "firstname": "string",
    "death": "1000-12-31",
    "birth" : "1000-12-31", 
    "origin": "string",
    "figure": "url",
    "periods": [
        0
    ]
}
```

**Required**
- `lastname`
- `firstname`
- `death`
- `birth`
- `periods`


#### Résultat

🟢 **201** Created
```json
{
    "data": {
        "id" : 0
    }
}
```

🟡 **400** Bad Request
En cas d'erreur de champs ou de données
```json
{
    "errors": {
        "message": "Some fields don't match requirements and can't be processed",
        // Soit :
        "fields": {
            "<nom_du_champ>": {
                // Possibilités
                "missing" : "Must be provided",
                "too_short" : "Must contain <x> characters minimum",
                "too_long" : "Must contain <y> characters maximum",
                "format" : "Must respect format <W>", 
                "type" : "Must be an interger",
                "range": "Must fit between <x> and <y>"
            },
        },
        // Soit :
        "all" : "No field matches as expected"
    }
}
```
En cas d'absence ou de non concordance avec la ou les période(s)
```json
{
    "errors": {
        "message": "Some fields don't match requirements and can't be processed",
        "fields": {
            "periods": "No period exists for <x> [, ...]"
        }
    }
}
```

🔴 **500** Internal Server Error
```json
{
    "errors": {
        "message" : "No compositor saved due to an unexpected internal error"
    }
}
```


---


### `GET` : Retourner un compositeur

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant du compositeur. Valeur `int` prositive obligatoire.


#### Résultat

🟢 **200** OK
```json
{
    "data": {
        "lastname": "string",
        "firstname": "string",
        "birth": "1000-12-31",
        "death": "1000-12-31",
        "origin": "string",
        "figure": "url",
        "periods": [
            0
        ],
        "id": 0
    }
}
```

🟠 **404** Not Found
```json
{
    "errors": {
        "message": "No compositor found for identifier <x>"
    }
}
```


---


### `PUT` : Mettre à jour un compositeur

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant du compositeur. Valeur `int` prositive obligatoire.


#### Contenu de la requête - *Body request*

```json
{
    "lastname": "string",
    "firstname": "string",
    "death": "1000-12-31",
    "birth" : "1000-12-31", 
    "origin": "string",
    "figure": "url",
}
```


#### Résultat

🟢 **200** OK
```json
{
    "data": {
        "lastname": "string",
        "firstname": "string",
        "birth": "1000-12-31",
        "death": "1000-12-31",
        "origin": "string",
        "figure": "url",
        "periods": [
            0
        ],
        "id": 0
    }
}
```

🟡 **400** Bad Request
```json
{
    "errors": {
        "message": "Some fields don't match requirements and can't be processed",
        "fields": {
            "<nom_du_champ>": {
                // Possibilités
                "format" : "Must respect format <Z>", 
                "too_short" : "Must contain <x> characters minimum",
                "too_long" : "Must contain <y> characters maximum",
                "type" : "Must be an interger"
            },
        }
    }
}
```

🟠 **404** Not Found
```json
{
    "errors": {
        "message": "No compositor found for identifier <x>"
    }
}
```

🔴 **500** Internal Server Error
```json
{
    "errors": {
        "message" : "No compositor updated due to an unexpected internal error"
    }
}
```


---


### `DELETE` : Supprimer un compositeur

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant du compositeur. Valeur `int` prositive obligatoire.


#### Résultat

🟢 **204** No Content
_Aucun contenu n'est retourné._

🟠 **404** Not Found
```json
{
    "errors": {
        "message": "No compositor found for identifier <x>"
    }
}
```

🔴 **500** Internal Server Error
```json
{
    "errors": {
        "message" : "No compositor deleted due to an unexpected internal error"
    }
}
```


---
---


## Périodes

```
/api/periods
```


### `GET` : Retourner toutes les périodes

#### Résultat

🟢 **200** OK
```json
{
    "data": [
        {
            "name": "string",
            "begin": 0,
            "end": 0,
            "tag": "string",
            "id": 0
        },
        // etc.
    ],
    "total_items": 0
}
```


---


### `GET` : Retourner une période

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant de la période. Valeur `int` positive obligatoire.
```
/api/periods/5
```

#### Résultat

🟢 **200** OK
```json
{
    "data": {
        "name": "string",
        "begin": 0,
        "end": 0,
        "tag": "string",
        "description": "string",
        "id": 0
    }
}
```

🟠 **404** Not Found
```json
{
    "errors": {
        "message": "No period found for identifier <x>"
    }
}
```


---


### `PUT` : Mettre à jour une période

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant de la période. Valeur `int` positive obligatoire.
```
/api/periods/5
```

#### Contenu de la requête - *Body request*

```json
{
    "name": "string",
    "begin": 0,
    "end": 0,
    "tag": "string",
}
```

#### Résultat

🟢 **200** OK
```json
{
    "data": {
        "lastname": "string",
        "firstname": "string",
        "birth": "1000-12-31",
        "death": "1000-12-31",
        "origin": "string",
        "figure": "url",
        "periods": [
            0
        ],
        "id": 0
    }
}
```

🟡 **400** Bad Request
```json
{
    "errors": {
        "message": "Some fields don't match requirements and can't be processed",
        "fields": {
            "<nom_du_champ>": {
                // Possibilités
                "too_short" : "Must contain <x> characters minimum",
                "too_long" : "Must contain <y> characters maximum",
                "type" : "Must be an interger",
                "range": "Must fit between <x> and <y>"
            },
        }
    }
}
```

🟠 **404** Not Found
```json
{
    "errors": {
        "message": "No period found for identifier <x>"
    }
}
```

🔴 **500** Internal Server Error
```json
{
    "errors": {
        "message" : "No period updated due to an unexpected internal error"
    }
}
```


---


### `GET` : Retourner une période et tous les compositeurs associés

#### Paramètres du chemin - *Path parameters*

**`id`** — Identifiant de la période. Valeur `int` positive obligatoire.
```
/api/periods/5/compositors
```


#### Résultat

🟢 **200** OK
```json
{
    "data": {
        "name": "string",
        "begin": 0,
        "end": 0,
        "tag": "string",
        "description": "string",
        "id": 0,
        "compositors": [
            {
                "lastname": "string",
                "firstname": "string",
                "birth": "1000-12-31",
                "death": "1000-12-31",
                "id": 0
            },
            // etc.
        ]
    }
}
```

