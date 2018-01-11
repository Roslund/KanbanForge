# DVA313
A school project for the course DVA313, Software Engineering 2: Project Teamwork.

![](https://i.imgur.com/hXaemJI.png)

## Goal
The goal of the project was to create a digital kanbanboard that interfaces with TeamForge.


## Project Group
![alt tag](https://github.com/Enari/DVA313/raw/master/Project%20Documents/Group%20Photo.png)
* André Caldegren
* Anton Roslund
* Amer Surkovic
* Dzana Hanic
* Jawid Nasiri
* Kevin Oswaldo Cabrera Navarro
* Robert Duras
* ~~Noah Gustavsson~~ (Dropped the coruse)


## Board
![](https://i.imgur.com/4Ixqjqf.png)

# Instalation
Note that this project has only been tested using apache, nginx and mysql.

### Requirements
* PHP >= 7.1
* Composer

## Steps
1. Clone the repo, the laravel project is in the directory kanbanboard
```bash
git clone https://github.com/Enari/DVA313.git
```

2. Install dependencies
```bash
composer install
```

3. Copy `env.example` to `.env` and fill in sql and teamforge credentials. Note that te teamforge credentials provided must be a site admin on teamforge.
```bash
cp .env.example .env
```

4. Generate an application key. 
```bash
php artisan key:generate
``` 

5. Provide teamforge URL in `config/teamforge.php`

6. Migrate the database
```bash
php artisan migrate
```

7. Enable automatic updates from teamforge by calling `php artisan schedule:run` every minute using chron.
```
*  *    * * *   root    php /var/www/DVA313/kanbanboard/artisan schedule:run >> /dev/null 2>&1
```

8. Point you webserver to `kanbanboard/public`, note that mod_rewrite needs to be enabled.

9. Optional: Seed the database with example data
```bash
php artisan db:seed
```


