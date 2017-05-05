Generate a single entity from a table in Symfony3 <br>
A long time ago we saw with Symfony2 how to generate entities from the database , the only change that there is with regard to version 3 of Symfony is that the console instead of being in app / console is in bin / console.
Today we will see how to generate a single entity from a table in Symfony3.
If you need to create another table in the database simply create and launch the commands again to generate entities that we saw earlier and in theory will generate the entity that does not exist in the project.
Indicating the commands -filter parameter you can specify which table you are going to convert to entity in doctrine.<br>
<code>
php bin/console doctrine:mapping:import MiBundle yml --filter="TuTabla" </code><br>
Now we simply generate the entities with the command:<br>
<code>
php bin/console doctrine:generate:entities MiBundle --no-backup</code><br>
With this we would already have a new entity ready to work with Symfony3 and we already know how to generate a single entity from a table in Symfony3.
