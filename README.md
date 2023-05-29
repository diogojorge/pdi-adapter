# pdi-adapter
> **PDI - Stage 2** - Simple customer management application using Design Pattern Adapter
>
> **PDI - Stage 3** - Add functionality to create and list customers using Design Pattern Command

## Summary
1. Design Pattern used
    - 1.1 [Adapter design pattern](#11-adapter-desing-pattern)
    - 1.2 [Command design pattern](#12-comand-desing-pattern)
2. [Firsts steps](#2-firsts-steps)
3. [Motivation](#3-motivation)
4. [Structure](#4-structure)
    - 4.1 [Adapter structure](#41-adapter-structure)
    - 4.2 [Command structure](#42-adapter-structure)
5. [Reference](#5-reference)

## 1. Design Pattern used
### 1.1 Adapter design pattern
The *Adapter* allows classes with incompatible interfaces to work together, converting the interface of a class into another interface, making objects collaborate with each other.

#### Participants
* **ClientInterface**: defines the existing specific interface.
* **Client**: instantiate objects compatible with the ***ClientInterface*** interface.
* **Adaptee**: defines an interface that needs to be adapted.
* **Adapter**: adapts the ***Adaptee*** interface to the ***ClientInterface*** interface.

### 1.2 Command design pattern
The *Command* pattern encapsulates a single function free of any variable in object form, thus allowing to parameterize clients with different requests, queue or record (log) requests, and support operations that can be undone.

#### Participants
* **Command**: declares an interface for performing an operation.
* **ConcreteCommand**: defines a binding between a Receiver object and an action. Implements a method *Execute* by invoking the corresponding operation(s) on the ***Receiver***.
* **Client**: creates a ***ConcreteCommand*** object and sets its receiver.
* **Invoker**: asks ***Command*** to execute the request.
* **Receiver**: knows how to perform the operations associated with a request. Any class can function as a *Receiver*.

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
### Stage 1
* An XYZ system uses, in its form of data persistence, text files to store information. But the need to start using DBMS for more robust persistence data. At the beginning, you will use SQLite and will need to adapt it to your existing persistence forms.
### Stage 2
* Make use of the command pattern so that we can handle the actions of inserting and listing customers.

## 4. Structure
### 4.1 Adapter structure
* **ClientInterface**:
    * *Diogo\PdiAdapter\Infrastructure\FilePersistence\FilePersistenceInterface.php*
* **Client**:
    * *Diogo\PdiAdapter\Application\FilePersistenceController.php*
* **Adaptee**:
    * *Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface.php*
* **Adapter**:
    * *Diogo\PdiAdapter\Application\DBMSPersistenceAdapter.php*

### 4.2 Command structure
* **Command**:
    * *Diogo\PdiAdapter\Application\DBMSPersistenceCommandInterface*
* **ConcreteCommand**:
    * *Diogo\PdiAdapter\Application\DBMSPersistenceShowCommand*
    * *Diogo\PdiAdapter\Application\DBMSPersistenceInsertCommand*
* **Client**:
    * *Test\Diogo\PdiAdapter\Application\DBMSPersistenceInvokerTest.php*
* **Invoker**:
    * *Diogo\PdiAdapter\Application\DBMSPersistenceInvoker.php*

## 5. Reference

[DesignPatternsPHP - Structural: Adapter / Wrapper](https://designpatternsphp.readthedocs.io/en/latest/Structural/Adapter/README.html)
[DesignPatternsPHP - Behavioral: Command](https://designpatternsphp.readthedocs.io/en/latest/Behavioral/Command/README.html)
