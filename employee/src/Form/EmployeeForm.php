<?php
	namespace Drupal\employee\Form;
	use Drupal\Core\Form\Formbase;
	use Drupal\Core\Form\FormStateInterface;
	use Drupal\Core\Database\Database;

	class EmployeeForm extends FormBase{
		/**
		 * {@inheritdoc}
		 */

		public function getFormId(){
			return 'create_employee';
		}

		/**
		 * {@inheritdoc}
		 */
		  
		 public function buildForm(array $form, FormStateInterface $form_state){

		 	$genderOptions = array(
		 		'0'=>'Select Gender',
		 		'Male'=>'Male',
		 		'Female'=>'Female',
		 		'Other'=>'Other'
		 	);

		 	$form['name'] = array(
               '#type'=>'textfield',
               '#title'=>t('Name'),
               '#default_value'=>''
               
           );

		 	$form['age'] = array(
               '#type'=>'textfield',
               '#title'=>t('Age'),
               '#default_value'=>''
           );

		 	$form['email'] = array(
               '#type'=>'textfield',
               '#title'=>t('Email'),
               '#default_value'=>''
               
           );

		 	$form['gender']= array(
		 		'#type'=>'textfield',
		 		'#title'=>'Gender',
		 		'#options'=>$genderOptions
		 		
		 	);

		 	$form['save']= array(
		 		'#type'=>'submit',
		 		'#value'=>'Save Employee',
		 		'#button_type'=>'primary'
		 	);

		 	return $form;

		}

		/**
		 * {@inheritdoc}
		 */

		public function validateForm(array &$form, FormStateInterface $form_state){
			$name = $form_state->getValue('name');
			if(trim($name) == ''){
				$form_state->setErrorByName('name',$this->t('Name is required'));
			}
			else if($form_state->getValue('gender')== '0'){
				$form_state->setErrorByName('gender',$this->t('Gender is required'));
			}
			else if($form_state->getValue('email')== '0'){
				$form_state->setErrorByName('email',$this->t('Email is required'));
			
			}
		}

		

	     public function submitForm(array &$form, FormStateInterface $form_state){
	    	$postData = $form_state->getValues();

	    	unset($postData['save'],$postData['form_build_id'],$postData['form_token'],$postData['form_id'],$postData['op']);

	    	$query = \Drupal::database();
	    	$query->insert('employees')->fields($postData)->execute();

	    	drupal_set_message(t('Data Inserted Successfully'),'status',TRUE);


		  	
		
		 } 

	}
?>