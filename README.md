# NFQ Backend task

A queue managing system where client requests position in queue until specialist can respond/checkup etc.

### Important notice

System is not currently functioning in it's intended way.

System is developed not by Symfony standarts,
it's a mix between symfony recomended development and flat php clases.
In particular this project dont rely on ORM and DQL/QuerieBuilder, but it implements 
Seperate database managment platform mainly based with plain SQL.
This is done with intention of fiting the task given.

This approach was selected because of time constraints.
Big part of flat php zone in this project is due to requirements by product owner.

### Missing features/ToDo's

Valid login system
Personal client zone
Average waiting time calculations
Specialist filtering

### Dangers

Do not use sensitive information while using this system.
You been warned.

System is vunerable to:
SQL injections.
Client information leaks (Before mentioned not functioning login system )


## Getting Started

### Requirements

  LAMP stack  
  PHP7.2  
  Composer  

### Prerequisites

On the project directory:
```
composer update
```
Database setup:

Setup of .env file.

```
php bin/console doctrine:migration:migrate
```

OR

```
php bin/console doctrine:schema:update --force
```

## Deployment

Project is not currently ready to be deployed.

## Built With

* [Symfony 4](https://symfony.com/) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management


## Versioning

We use [GitHub] for versioning.

## Authors

* **Justinas Garipovas** - *project* - [JustinasGaripovas](https://github.com/JustinasGaripovas)


