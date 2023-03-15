## Requirements
 - Docker (Developed on Docker Desktop v4.17.0 with Docker Engine v20.10.23.)
 - Docker Compose ( included in Docker Desktop )

## How to start the project
 - Move to project directory
 - Run `docker-compose -f docker-compose.yml up --build`

## How to SSH the app container
 - Run `docker ps` to get the name/id of the php container
 - Run `docker exec -it {Name/ID} /bin/sh`

## How to set up the project
 - Run in the container: `php artisan migrate --seed`

## Available endpoints:

 - List competitions: GET `http://localhost/api/competitions`
 - Get one competition: GET `http://localhost/api/competitions/{competitionId}`
 - Create one competition: POST `http://localhost/api/competitions`
    <br><b>Body</b>:
    ````
    {
     "name": "Chess",
     "player_limit": 20
    }
   ````
 - Add player to competition: POST `http://localhost/api/competitions/{competitionId}/player`
   <br><b>Body</b>:
    ````
    {
     "name": "Johnnie Lubowitz"
    }
   ````
 - Increment player's score on competition: POST `http://localhost/api/competitions/{competitionId}/player/{playerId}`
   <br><b>Body</b>:
    ````
    {
     "score": 22
    }
   ````
