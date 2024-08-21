### Documentation de Déploiement pour l'Application Web Rolist-Mingle

Ce document destiné aux développeurs et développeurs opérationnels décrit le processus de déploiement de l'application web **Rolist-Mingle** en utilisant **GitHub Actions** pour déployer l'application sur **Oracle Cloud**. Le déploiement inclut la construction et le déploiement d'une image Docker ainsi que la gestion des dépendances du projet.
Ce document ne couvre pas le développement de nouvelles fonctionnalités ou lesm odifications majeures d'architecture du projet.

#### Langages de programmation

1. HTML 5
2. CSS 3 et SCSS
3. JavaScript
4. PHP
5. MySQL

#### Prérequis

1. **Oracle Cloud** : Un serveur Oracle Cloud configuré avec un accès SSH.
2. **GitHub** : Le repository contenant le code source de l'application : https://github.com/sbonnard/rolist-mingle.
3. **Docker Hub** : Un compte Docker Hub pour stocker les images Docker.
4. **Secrets GitHub** : Les variables d'environnement suivantes doivent être configurées dans les secrets du repository GitHub :
   - `DOCKER_HUB_USERNAME` : Nom d'utilisateur Docker Hub.
   - `DOCKER_HUB_PWD` : Mot de passe Docker Hub.
   - `ORACLE_PRIVATE_KEY` : Clé privée SSH pour accéder à Oracle Cloud.
   - `ORACLE_HOST` : Adresse IP ou DNS du serveur Oracle Cloud.
   - `ORACLE_USER` : Nom d'utilisateur pour SSH sur Oracle Cloud.
5. **PHPMyAdmin** : Pour gérer les données en base.
6. **MySQL** : Assurez-vous que MySQL soit bien installé sur la VM oracle.
7. **Node.js** : Installer en version 10.7.0.

#### Structure du Projet

L'application Rolist-Mingle utilise les dépendances suivantes :
- **Composer** : Gestionnaire de dépendances pour PHP.
- **Vite** : Outil de construction pour les projets front-end.
- **Sass** : Préprocesseur CSS.

Le code source est organisé avec les dossiers suivants :
- `vendor/` : Contient les dépendances PHP gérées par Composer.
- `node_modules/` : Contient les dépendances JavaScript gérées par npm et Vite.
- `public/` : Contient les fichiers statiques de l'application, y compris les assets compilés par Vite et Sass.

#### Déploiement Automatisé via GitHub Actions

Le processus de déploiement est automatisé via un fichier YAML situé dans `.github/workflows/deploy.yml`. Voici une explication détaillée du fichier utilisé pour déployer l'application.

##### Le déploiement doit comprendre les éléments suivants :

1. Préparation de l'environnement
    ● Vérification des prérequis (versions des outils, dépendances)
    ● Configuration des variables d'environnement
2. Récupération du code source
    ● Clonage du dépôt Git ou téléchargement des fichiers
3. Installation des dépendances
    ● Exécution des commandes d'installation (npm install, composer install,
etc.)
4. Configuration de l'application
    ● Copie et modification des fichiers de configuration
5. Construction de l'application
    ● Compilation, minification, bundling (npm run build, etc.)
6. Tests
    ● Exécution des tests unitaires et d'intégration
7. Déploiement
    ● Copie des fichiers sur le serveur de production
    ● Mise à jour de la base de données si nécessaire
8. Redémarrage des services
    ● Redémarrage du serveur web, des conteneurs Docker, etc.
9. Vérification post-déploiement
    ● Tests de bon fonctionnement de l'application en production

```yaml
name: Deploy to Oracle Cloud

on:
  push:
    branches: [ master ] # Le déploiement se déclenche lors d'un push sur la branche master

env:
  IMAGE_NAME: ${{ secrets.DOCKER_HUB_USERNAME }}/rolist-mingle # Nom de l'image Docker

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v2 # Récupère le code source

    - name: Install dependencies
      run: |
        # Aller dans le dossier où se trouvent les json
        cd app
        # Installer les dépendances PHP
        composer install --no-dev --optimize-autoloader
        
        # Installer les dépendances JavaScript et compiler les assets
        npm install
        npm run build # Compile les fichiers avec Vite (incluant Sass)

    - name: Login to Docker Hub
      uses: docker/login-action@v2
      with:
        username: ${{ secrets.DOCKER_HUB_USERNAME }}
        password: ${{ secrets.DOCKER_HUB_PWD }}

    - name: Build and deploy Docker image
      uses: docker/build-push-action@v2
      with:
        context: .
        push: true
        tags: ${{ env.IMAGE_NAME }}

    - name: Test application
      run: |
        docker run --name test-container -d -p 8080:80 ${{ env.IMAGE_NAME }}
        sleep 5
        curl http://localhost:8080 | grep "Hello"
        docker stop test-container

    - name: Install docker if not installed
      env:
        PRIVATE_KEY: ${{ secrets.ORACLE_PRIVATE_KEY }}
        HOST: ${{ secrets.ORACLE_HOST }}
        USER: ${{ secrets.ORACLE_USER }}
      run: |
        echo "$PRIVATE_KEY" > private_key && chmod 600 private_key
        ssh -o StrictHostKeyChecking=no -i private_key ${USER}@${HOST} << EOF
          # Installer docker si non présent
          if ! command -v docker &> /dev/null; then
            sudo apt-get update
            sudo apt-get install -y docker.io
            sudo usermod -aG docker $USER
            sudo systemctl start docker
            sudo systemctl enable docker
            sudo docker -v
          fi
        EOF

    - name: Deploy to Oracle Cloud
      env:
        PRIVATE_KEY: ${{ secrets.ORACLE_PRIVATE_KEY }}
        HOST: ${{ secrets.ORACLE_HOST }}
        USER: ${{ secrets.ORACLE_USER }}
      run: |
        echo "$PRIVATE_KEY" > private_key && chmod 600 private_key
        ssh -o StrictHostKeyChecking=no -i private_key ${USER}@${HOST} << EOF
          sudo docker info
          sudo docker images
          sudo docker pull ${{ env.IMAGE_NAME }}
          sudo docker stop rolist-mingle || true
          sudo docker rm rolist-mingle || true
          sudo docker run -d --name rolist-mingle -p 80:80 ${{ env.IMAGE_NAME }}
        EOF
```

#### Explication des Étapes

1. **Trigger du Workflow** :
   - Le déploiement est déclenché par un push sur la branche `master`.

2. **Installation des Dépendances** :
   - Les dépendances PHP sont installées via Composer.
   - Les dépendances JavaScript sont installées via npm, et les fichiers front-end sont compilés avec Vite.

3. **Connexion à Docker Hub** :
   - Authentification auprès de Docker Hub pour pouvoir pousser l'image Docker.

4. **Construction et Déploiement de l'Image Docker** :
   - L'image Docker de l'application est construite et poussée vers Docker Hub.

5. **Test de l'Application** :
   - L'image Docker est testée localement pour vérifier son bon fonctionnement avant le déploiement.

6. **Installation de Docker sur Oracle Cloud (si nécessaire)** :
   - Docker est installé sur le serveur Oracle Cloud si ce n'est pas déjà fait.

7. **Déploiement sur Oracle Cloud** :
   - L'image Docker est tirée depuis Docker Hub, et un conteneur est lancé sur le serveur Oracle Cloud.

#### Conclusion

Ce processus de déploiement permet de maintenir un flux CI/CD efficace pour l'application Rolist-Mingle, en assurant que chaque modification poussée sur la branche `master` soit automatiquement déployée sur Oracle Cloud après avoir passé les tests de base. Ce flux garantit que les dépendances et les assets front-end sont correctement gérés et compilés avant chaque déploiement.