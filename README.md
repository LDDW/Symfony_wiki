# Symfony_wiki

 - Symfony version : 6.1.7
 - PHP version : >=8.1

## How to lauch project ? 

!!! Don't forget to launch your apache, mysql !!!

1. Install Composer & Node Packages
```sh
   composer install
   npm install
```

2. Configure .env file for create DATABASE URL

3. Create Database with SQL script 
```sql
   CREATE DATABASE symfony_wiki
```

4. Migrate Table
```sh
   php bin/console make:migration
   php bin/console doctrine:migrations:migrate
```

5. Import Data into Database with SQL script
```sql
    --
    -- Déchargement des données de la table `categorie`
    --

    INSERT INTO `categorie` (`id`, `nom`, `image`) VALUES
    (1, 'Téléphone', 'assets/uploads/image_categorie.jpg\r\n'),
    (2, 'Ordinateur', 'assets/uploads/image_categorie2.jpg');

    --
    -- Déchargement des données de la table `user`
    --

    INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`) VALUES
    (1, 'cyrilbizouarn5@gmail.com', '[]', '$2y$13$dTtH5sT2.sDqV8TiXTIN1ujnOR6YdccQqXor3RU9V1dkslSroGyu2', 'Cyril Bizouarn'),
    (2, 'test', '[]', '$2y$13$dTtH5sT2.sDqV8TiXTIN1ujnOR6YdccQqXor3RU9V1dkslSroGyu2', 'Cyril Bizouarn');

    --
    -- Déchargement des données de la table `article`
    --

    INSERT INTO `article` (`id`, `auteur_id`, `titre`, `image`, `informations`) VALUES
    (1, 1, 'Iphone 14 Pro Max', 'assets/uploads/iphone_14_pro_max.jpeg', 'Une manière inédite et magique d’interagir avec votre iPhone. Des fonctionnalités de sécurité essentielles conçues pour sauver des vies. Un appareil photo 48 Mpx innovant pour un niveau de détail à couper le souffle. Et toute la puissance de la puce de smartphone ultime.'),
    (2, 1, 'Iphone 14 Pro', 'assets/uploads/iphone_14.png', 'Ceci est le deuixème article de Jules BOISMOND'),
    (3, 1, 'Iphone 13 pro', 'assets/uploads/iphone_13_pro.jpg', 'quatrième article de Jules BOISMOND'),
    (4, 1, 'Iphone 13', 'assets/uploads/iphone_13.jpg', 'Ceci est le troisième article de Jules BOISMOND'),
    (5, 2, 'Macbook Pro 13', 'assets/uploads/MacBook_Pro_13″.jpg', 'Description du macbook'),
    (6, 2, 'Macbook Pro 16', 'assets/uploads/Mac_Book_Pro_16″.jpeg', 'Description du macbook'),
    (7, 2, 'Macbook Air', 'assets/uploads/Mac_Book_Air.jpg', 'Description du macbook'),
    (8, 2, 'Macbook Air M2', 'assets/uploads/Mac_Book_Air.jpg', 'Description du macbook');

    --
    -- Déchargement des données de la table `article_categorie`
    --

    INSERT INTO `article_categorie` (`article_id`, `categorie_id`) VALUES
    (3, 1),
    (4, 1),
    (5, 2),
    (6, 2);
```

6. Launch project
```sh
   symfony serve
```

## IMPORTANT !

If css is empty on pages, use this command
```sh
    npm run sass
```
