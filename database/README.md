---
description: >-
  Database interaction is key in any application and the way yuga makes it easy,
  is credibly wonderful
---

# Database

## Introduction

Yuga makes interacting with databases extremely simple across a variety of database backends using either raw SQL, the [fluent query builder](https://yuga-framework.gitbook.io/documentation/database/query), and the [Elegant ORM](https://yuga-framework.gitbook.io/documentation/database/elegant). Currently, Yuga supports three databases:

* MySQL
* PostgreSQL
* SQLite

#### Configuration

The database configuration for your application is located at `config/config.php`. In this file you can define all of your database connections, as well as specify which connection should be used by default. Examples for most of the supported database systems are provided in this file.

By default, Yuga comes configured to use mysql but comes with the `DATABASE_NAME` key in the `environment/.env` blank so, it does not connect to any database but once the database name is provided, it will connect automatically.

