<?php

namespace Acme\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TaskBundle\Entity\Task;
use Acme\TaskBundle\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function buildAction()
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        
        $form = $this->createForm(new TaskType(), $task);
    
        return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
            ));
        
    }
    public function newAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        
      
        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date', array('widget' => 'single_text'))
            ->add('save', 'submit')
            ->add('saveAndAdd', 'submit')
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isValid()) {
         
            $nextAction = $form->get('saveAndAdd') ->isClicked()
                    ? 'task_new'
                    : 'task_success';
            
            return $this->redirect($this->generateUrl($nextAction));
        }
 
        return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
            ));
        
     }
}   
        
        /* $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        
        $form = $this->createFormBuilder($task)
                ->add('task', 'text')
                ->add('dueDate', 'date')
                ->add('save', 'submit')
                ->getForm();
        
        return $this->render('AcmeTaskBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
            ));      */        

