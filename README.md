# CQRS skeleton project based on Symfony Framework
This repository is a starter kit for your cqrs projects based on a talk given by [@lilobase](https://twitter.com/Lilobase) at [Afup's PHPTour](https://afup.org/talks/2628-cqrs-fonctionnel-event-sourcing-domain-driven-design).

You can easily watch the slides [here](https://speakerdeck.com/lilobase/ddd-and-cqrs-php-tour-2018) in order to understand how you can extend this project to your needs.

I adapted it based on my knowledge of several projects using this pattern.

# Requirements
You need php 7.2 to make it work correctly due to the use of [object type](http://php.net/manual/en/language.types.object.php).
This project is based on symfony/skeleton (currently v4.2)

# Where to start ?
First create an aggregate root folder in `src` and several business domain folders containing either the following subfolders `Command` `Domain` `Event` `Infrastructure` `Query`.
Edit the following config files to your needs : 
* `config/routes/annotations.yaml` : must point to your controllers classes
* `config/services/_yourservices_.yaml` : definition of your different services and import it in `config/services.yaml`
* `config/packages/doctrine.yaml` : add the mapping to your doctrine entities