<h1>Creating services in Symfony3 </h1><br>
Today we will see how to create services in Symfony3 to better encapsulate our code and separate functionalities, this can be us much used in the development of services rest or backend applications, etc. as we see here .
Step 1 . We create a directory within our bundle called Services.
Step 2. Create a file for the class, in my case I will create one that is called Helpers.
Step 3. We create the class, with the methods and functionality that we need, in my case to do the test, I will simply have a method.<br>

```php
<?php
namespace AppBundle\Services;
 
class Helpers {
 
    public function hola(){
        return "Hola desde el servicio";
    }
     
}
```
<br>

Step 4. Configure the service in the app / config / services.yml file
<br>
```yaml
services:
 
    app.helpers:
        class: AppBundle\Services\Helpers
        arguments: ["null"]
```        
        
  We are indicating the name or identifier of the service, the class to load and the arguments or other services that will receive this service.
Now in one of our actions of any project controller we can call the service.<br>
```php
$helpers = $this->get("app.helpers");
echo $helpers->hola();
```
