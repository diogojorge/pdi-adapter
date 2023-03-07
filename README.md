# pdi-adapter
> PDI - Stage 2 - Simple customer management application using Design Pattern Adapter

## Summary
1. [Adapter design pattern](#1-adapter-desing-pattern)
2. [Firsts steps](#2-firsts-steps)
2. [Motivation](#3-motivation)
3. [Structure](#4-structure)
4. [Reference](#5-reference)

## 1. Adapter design pattern
The Adapter allows classes with incompatible interfaces to work together, converting the interface of a class into another interface, making objects collaborate with each other.

### Participantes
* **ClientInterface**: defines the existing specific interface.
* **Client**: instantiate objects compatible with the ***ClientInterface*** interface.
* **Adaptee**: defines an interface that needs to be adapted.
* **Adapter**: adapts the ***Adaptee*** interface to the ***ClientInterface*** interface.

## 2. Firsts steps

### Starting the Application:
```bash
$ git clone https://github.com/diogojorge/pdi-adapter.git
$ cd pdi-adapter/
$ docker-compose up
```

### Getting a shell in running container
```bash
$ docker exec -it pdi-nginx /bin/sh
$ docker exec -it pdi-phpfpm /bin/sh
```

### Useful commands to run inside the php container
```bash
$ composer unit-test
$ composer phpcs-check
$ composer phpcs-fix
$ composer phpstan
$ composer psalm
$ composer rector
$ composer coverage
```
## 3. Motivation
An XYZ system uses, in its form of data persistence, text files to store information. But the need to start using DBMS for more robust persistence data. At the beginning, you will use SQLite and will need to adapt it to your existing persistence forms.

## 4. Structure
* **ClientInterface**:
    * *Diogo\PdiAdapter\Infrastructure\FilePersistence\FilePersistenceInterface.php*
* **Client**:
    * *Diogo\PdiAdapter\Application\FilePersistenceController.php*
* **Adaptee**:
    * *Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface.php*
* **Adapter**:
    * *Diogo\PdiAdapter\Application\DBMSPersistenceAdapter.php*

## 5. Reference

[DesignPatternsPHP: Adapter / Wrapper](https://designpatternsphp.readthedocs.io/en/latest/Structural/Adapter/README.html)
