```php
$builder
            ->add('assignedto', EntityType::class, array('multiple' => false,
                'class' => 'AuthBundle\Entity\User', 'placeholder' => 'Select Personel', 
                    'query_builder' => function (UserRepository $er) {
                        return $er->createQueryBuilder('u')
                        ->select('u') 
                        ->join('u.employee','e')
                        ->join('u.ticketQueues','tq')                                  
                        ->orderBy('u.username', 'ASC');                                                  
                    },
                'label' => "Assigned To:",
                'choice_label' => function
                ($q) {
                    return $q->getEmployee()->getFirstName()." ".$q->getEmployee()->getLastName();
                }, 'attr' => array('class' => 'form-control')))  
```      
