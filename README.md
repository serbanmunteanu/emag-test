# eMAG's Hero

###Description
Once upon a time there was a great hero, called Orderus, with some strengths and weaknesses, as all heroes have. Orderus walks the ever-green forests of Emagia, he encounters some wild beasts and need to fight with them.

###Installation
Application is running on docker container, for install just:

```
docker-compose up
```

If you don't have Docker installed you can run the app with just:
```
php index.php
```
>*Note: this action require PHP 7.4 or greater

###Usage
After you run one of the commands you can find the output of the game in **src/Output/Logs/game.log**

If you switch to option *cli* for output you must enter into docker container like this:

```
docker ps
docker exec -ti *containerId* bash
/var/www: $php index.php
```
The output of the game will be displayed in the console.

###Architecture
The Application contain 5 component:

- Ability
    - Use factory method design pattern for creating new Ability
- Champion
    - Use builder design pattern to construct new Champion
    - It use this pattern because Champion Model can became more complex and this approch add more flexibilty for feature developments
- Game
    - This class initialize the game between two champions, determine the first attacker base on requiremets, determine the winner and swap players
- Round
    - This class contain whole game-round fight logic
- Output
    - Output the provided message throw one of the adapters
    - Use adapter pattern for being able to switch from config between:
        - cli
        - log

The main logic behind is to being able to add any abilities and any champions throw config. The config contain also settings about game and how to output the result.

On application bootstrap all the abilities are being loaded from config and after that the champions are built with desire stats and abilities. The champions are initially saved in the application properties depending on their type (knights or monsters) and ready to be picked in for the game.

###Features
- All champions could have abilities customizable by config
- A game could have any number of rounds
- East to add new abilities
- Easy to add new champion
- Multiple display options

###Enhancements
- Redefine test to use mocks
- Add a cache layer to acting like a database to see all the results
- Add Champion properties XP and increase after every battle to being able to unlock new abilities
- Abstract Game class to support any type of duels: 2v2, 3v3, etc. This class can use strategy pattern for game fights and to accept arrays of knights & monsters

>Note from me: I was having fun doing this, I hope you came this far to see this note. That is means you are awesome because you read docs.