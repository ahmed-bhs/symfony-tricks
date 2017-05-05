<h1>Create events in Symfony3 :</h1><br>
The events within Symfony are just a type of service that allows us to have a functionality made and that functionality is launched when we indicate it and when necessary, in this way we could reuse an event as many times as we would like . For example, we could have an event to send mails or to save notifications, and that every time we did some action that required to save a notification, with the dispatcher we would launch the event . I simply see it as an interesting concept, but it really is not a revolution, it is simply a class with a method or methods that will subsequently be called.
Let's go directly to the practice and we will create an event in Symfony 3 .
First we created an Event directory in our bundle and inside we created our event. Within the class of the event we could have many methods and properties.


<br>

```php
<?php
namespace AppBundle\Event;
use Symfony\Component\EventDispatcher\Event;
 
class PruebasEvent extends Event
{
    private $code;
 
    public function setCode($code)
    {
        $this->code = $code;
    }
 
    public function getCode()
    {
        return $this->code;
    }
}
```

Now we will create the class that will be subscribed to the event inside a directory called EventSubscriber .<br>

```php
<?php
namespace AppBundle\EventSubscriber;
 
class PruebasEventSubscriber
{
    public function onCustomEvent($event)
    {
        var_dump($event->getCode());
    }
     
    public function onSuperEvento($event)
    {
        var_dump("LLAMANDO A LA FUNCIONALIDAD DE UN EVENTO");
    }
}
```

<br>

Now to use all this we have to add the event as a service. We indicate the class of the subscriber and we indicate to him which event is going to use and which method is going to launch
<br>
```yaml
services:
    custom.event.home_page_event:
        class: AppBundle\EventSubscriber\PruebasEventSubscriber
        tags:
            - { name: kernel.event_listener, event: custom.event.pruebas_event, method: onSuperEvento }
```
<br>
The last step would be to use it in our controller, when necessary.<br>

```php
use AppBundle\Event\PruebasEvent;
 
// Creamos el objeto del evento
$event = new HomePageEvent();
$event->setCode(200);
 
// Lanzar evento
$eventDispatcher = $this->get('event_dispatcher');
$eventDispatcher->dispatch('custom.event.home_page_event', $event);
```
