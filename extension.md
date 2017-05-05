<h1>Creating Twig Extensions in Symfony 3</h1>

Today we are going to see how to create extensions of Twig in Symfony3.
An extension of Twig is just a helper for our views , it will allow us to have a functionality that will allow to be used in any twig view of our Symfony project .
To create extensions of Twig the first thing we have to do is to create a directory called Twig within our Bundle. And inside we create a class PHP, for example I will create the file GetUserExtension.php that will contain a class of the same name that will extend to the object Twig_Extension.

```php
<?php 
 
namespace AppBundle\Twig;
 
use Symfony\Bridge\Doctrine\RegistryInterface;
 
 
class GetUserExtension extends \Twig_Extension
{
 
    // Cargamos doctrine dentro del servicio/extensión
    protected $doctrine;
 
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }
 
    /* Le ponemos el nombre al filtro que finalmente usaremos en la vista 
     y le indicamos que metodo va a cargar.*/
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_user', array($this, 'getUserFilter')),
        );
    }
 
    // Método con la funcionalidad de la extensión
    public function getUserFilter($user_id)
    {
        $user_repo = $this->doctrine->getRepository("BackendBundle:User");
 
        $user= $user_repo->findOneBy(array("id" => $user_id));
 
        if(!empty($user) && is_object($user)){
           $result = $user; 
        }else{
           $result = false;
        }
         
        return $result;
    }
 
    public function getName()
    {
        return 'get_user_extension';
    }
}
```

<br>
This extension, helper or filter will allow us to get the data of a given user id if it exists. 
In order to use this extension in our views we have to add it as a service in our services.yml , in this case I pass doctrine to the service because we are also using it in the Twig extension class.<br>


```yaml
services:
    get_user.twig_extension:
        class: AppBundle\Twig\GetUserExtension
        public: false
        arguments:
            doctrine: "@doctrine"
        tags:
            - { name: twig.extension }
```
<br>
Now we can use the extension, in my case I save the user in a variable.<br>

```twig
{% set usuario = myuser.id|get_user %}
```        
  
