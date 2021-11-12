<?php
    namespace Drupal\employee\Controller;
    use Drupal\Core\Controller\ControllerBase;

    class EmployeeController extends ControllerBase{
    	public function createEmployee(){
    		$form = \Drupal::formBuilder()->getForm('Drupal\employee\Form\EmployeeForm');
    		$renderFrom = \Drupal::service('renderer')->render($form);

    		return[
    			'#type'=>'markup',
    			'#markup'=>$renderFrom
    		];
    	}
    }
?>