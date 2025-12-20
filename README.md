# Rolist-Mingle
## Don't Roll Single
A web app to mingle with other rolists and play more often.
I had the idea of a social media back then during my dev studies.
Furthermore, I would want it to be a RPG companion to help players all over the world too roll & role.
I want to deal with accessibilty issues on the whole project so it respects the POUR principles : Perceivable, Operable, Understandable, Robust.

## Actual Features
    - Create a profile :
        - Personnal profile picture
        - Give your RPG/type of universe best of
        - Choose a profile type

    - Dice launcher from dice 4 to dice 100.
    - Hit location dice.
    - Create a character
    - Personnal profile :
        - Change password
        - Change bio
        - Add universes to your preferences

# LAMP ENVIRONMENT

## BUILD AND RUN

To build images and run all containers and volumes

```sh
docker-compose up -d
```

To display examples datas, you can launch PhP myAdmin and import sql/rolist_mingle export.sql

## NPM

```sh
npm install
```

## COMPOSER

```sh
composer install
```

# LAUNCH APP FOR DEV

Launch docker container 

& connection with .env 

 ```sh
& npm run dev
```