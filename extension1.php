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
