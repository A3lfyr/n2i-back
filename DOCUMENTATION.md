# Documentation des points d'API

## Fonctionnement général

### Types de requêtes

- Récupération d'informations: Celle-ci se fait en utilisant la méthode GET
  - Mnémonique: GET
- Ajout d'information: Celle-ci se fait en utilisant la méthode POST et en donnant la valeur `add` au champ `action`
  - Mnémonique: POST | add
- Modification d'information: Celle-ci se fait en utilisant la méthode POST et en donnant la valeur `update` au champ `action`
  - Mnémonique: POST | update
- Suppression d'information: Celle-ci se fait en utilisant la méthode POST et en donnant la valeur `delete` au champ `action`
  - Mnémonique: POST | delete

### Codes d'erreur

*Lorsque vous recevez une réponse avec un code différent de 200, une erreur est indiquée dans l'objet* `error` *que vous recevez*

- 200: Tout s'est bien déroulé
- 400: Requête invalide. Très probablement un oubli de paramètre(s). Attention à bien préciser l'action avec une requête POST
- 401: Forbidden. L'utilisateur n'est pas authentifié ou une erreur s'est produite lors de l'authentification. Le message d'erreur peut contenir plus d'indications sur la raison de l'erreur, comme dans le cas d'une erreur dans les identifiants lors de la connexion.
- 405: Méthode non autorisée. Se produit lorsque le point d'API ne support pas la méthode utilisée. Par exemple, le login standard ne supporte que l'utilisation d'une requête POST | add.

## Points d'API

### Authentification

#### Authentification standard

**Chemin: ** `/login.php`
Méthode: POST | add
Paramètres attendus :

- `username`: Nom d'utilisateur
- `password`: Mot de passe
- `remember`: 0/1 selon si l'on souhaite récupérer un token.

Contenu de la réponse :
Si tout se passe bien, code de statut 200 avec le message "d'erreur" `"Connected"`
Dans le cas d'une erreur dans les identifiants, une erreur 401 sera renvoyée, avec le message d'erreur `"Wrong credentials"`

### Requêtes

#### Spot

**Chemin: ** `/spot.php`
Méthode: GET
Paramètres attendus :

- `longitude`: longitude du spot
- `latitude`: latitude du spot

Contenu de la réponse :
Si tout se passe bien, code de statut 200 avec le message `"Bien recu"`, puis les informations sur le spot demandé.
Dans le cas d'une erreur dans les paramètre, une erreur 400 sera renvoyée, avec le message d'erreur `"Bad Request"`
Si aucun spot n'est trouvé pour ces longitude/latitude, une erreur avec le code de statut 404 et le message `"Aucun resultat pour cette recherche"`

#### Spots

**Chemin: ** `/spots.php`
Méthode: GET

Contenu de la réponse :
Si tout se passe bien, code de statut 200 avec le message `"Bien recu"`, puis les informations sur tous les spots de la base de donnée.
Si aucun spot n'est trouvé dans la base de donnée, une erreur avec le code de statut 404 et le message `"Aucun resultat pour cette recherche"`