
**Setting up your development environment on your local machine :**

## 1. Clone the repository
<ul>
<li> git clone https://github.com/asimbilaladil/tv-shows-api.git</li> 
<li> cd tv-shows-api</li>
</ul>

## 2. Setup ".env" file
<ul>
<li> cp .env.example .env</li> 
</ul>

## 3. Build Docker Images
<ul>
<li> docker-compose build</li> 
</ul>

## 4. Install composer packages
<ul>
<li> docker-compose run --rm --no-deps php composer install</li> 
</ul>

## 5. Create key
<ul>
<li> docker-compose run --rm --no-deps php php artisan key:generate</li> 
</ul>

## 6. Run database migration
<ul>
<li> docker-compose run --rm --no-deps php aristan migrate</li> 
</ul>


## 7. Run Docker
<ul>
<li>  docker-compose up -d</li> 
</ul>

****Api to get all shows :****
<ul>
<li> http://localhost:8080/api/shows?page={{pageNo}}&limit={{perPage}}</li> 
</ul>

****Api to search shows by show name :****
<ul>
<li> http://localhost:8080/api/show/search?q={{showName}} </li> 
</ul>
