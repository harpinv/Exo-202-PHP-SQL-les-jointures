<?php

/**
 * 1. Commencez par importer le script SQL disponible dans le dossier SQL.
 * 2. Connectez vous à la base de données blog.
 */

/**
 * 3. Sans utiliser les alias, effectuez une jointure de type INNER JOIN de manière à récupérer :
 *   - Les articles :
 *     * id
 *     * titre
 *     * contenu
 *     * le nom de la catégorie ( pas l'id, le nom en provenance de la table Categorie ).
 *
 * A l'aide d'une boucle, affichez chaque ligne du tableau de résultat.
 */

// TODO Votre code ici.
$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'blog';

try {
    $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

    $request = $connect->prepare("
            SELECT article.id, article.title, article.content, categorie.name
            FROM article
            INNER JOIN categorie ON categorie.id = article.category_fk
    ");

    $liste = $request->execute();

    if($liste) {
        foreach ($request->fetchAll() as $value) {
            echo "<div>";
            print_r($value);
            echo "</div>";
        }
    }


/**
 * 4. Réalisez la même chose que le point 3 en utilisant un maximum d'alias.
 */

// TODO Votre code ici.

    $request = $connect->prepare("
            SELECT article.id, article.title, article.content, categorie.name, auteur.firstName, auteur.lastName
            FROM article
            INNER JOIN categorie ON categorie.id = article.category_fk
            INNER JOIN auteur ON auteur.id = article.author_fk
    ");

    $liste = $request->execute();

    if($liste) {
        foreach ($request->fetchAll() as $value) {
            echo "<div>";
            print_r($value);
            echo "</div>";
        }
    }
/**
 * 5. Ajoutez un utilisateur dans la table utilisateur.
 *    Ajoutez des commentaires et liez un utilisateur au commentaire.
 *    Avec un LEFT JOIN, affichez tous les commentaires et liez le nom et le prénom de l'utilisateur ayant écris le comentaire.
 */

// TODO Votre code ici.

    $request = $connect->prepare("
            SELECT commentaire.id, commentaire.content, utilisateur.firstName, utilisateur.lastName
            FROM commentaire
            left JOIN utilisateur ON utilisateur.id = commentaire.user_fk
    ");

    $liste = $request->execute();

    if($liste) {
        foreach ($request->fetchAll() as $value) {
            echo "<div>";
            print_r($value);
            echo "</div>";
        }
    }
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}