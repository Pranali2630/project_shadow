<?php
    namespace Drupal\crud_module\Form;
    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;
    use Drupal\Core\Database\Database;
    use Drupal\Core\Url;
    use Drupal\Core\Routing;
    use Drupal\redirect\Entity\Redirect;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    
    class EmployeeForm extends FormBase {
         /**
         * {@inheritdoc}
         */
        public function getFormId() {
            return 'employee_form';
        }

        /**
         * {@inheritdoc}
         */
        public function buildForm(array $form, FormStateInterface $form_state) {
            $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Enter Employee Name'),
            '#required' => TRUE,
            '#attributes' => array(
                'class' => 'form-control col-md-12',
                'id' => 'user_title',
            ),
            ];

            $form['mobile'] = [
                '#type' => 'textfield',
                '#title' => $this->t('Enter Mobile Number'),
                '#required' => TRUE,
                '#attributes' => array(
                    'class' => 'form-control col-md-12',
                    'id' => 'user_mobile',
                ),
                ];

            $form['email'] = [
                '#type' => 'email',
                '#title' => $this->t('Enter Email address'),
                '#required' => TRUE,
                '#attributes' => array(
                    'class' => 'form-control col-md-6',
                    'id' => 'user_email',
                ),
                ];

            $form['password'] = [
                '#type' => 'password',
                '#title' => $this->t('Enter Your Password'),
                '#required' => TRUE,
                '#attributes' => array(
                    'class' => 'form-control col-md-6',
                    'id' => 'user_password',
                ),
            ];

        
            $form['actions']['#type'] = 'actions';

            $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Save'),
            '#button_type' => 'primary',
        
            ];
            return $form;
        }


       
        /**
         * {@inheritdoc}
         */
        public function submitForm(array &$form, FormStateInterface $form_state) {

            $name = $form_state->getValue('name');
            $email = $form_state->getValue('email');
            $mobile=$form_state->getValue('mobile');
            $password=$form_state->getValue('password');
            $password =  md5($password);
           
            
            // print_r(gettype($course));die;
           
            $query=\Drupal::database();
            $query->insert('register_form') -> fields(array(
                'name'=>$name,
                'email'=>$email,
                'mobile'=>$mobile,
                'password'=>$password,
                // 'course'=>$course,
                

            ))->execute();

            $query=\Drupal::database();



            // $response = new RedirectResponse('register-view/');  
            $response = new RedirectResponse('view');  
            //$response = new RedirectResponse('myprofile');
            $response->send();
            //Give status of form data value
            // \Drupal::messenger()->addMessage('Registered Successfully ');
            // $this->messenger()->addStatus($this->t('Username  is @name', ['@name' => $form_state->getValue('name')]));
            // $this->messenger()->addStatus($this->t('Your email address  is @email', ['@email' => $form_state->getValue('email')]));
            //$this->messenger()->addStatus($this->t('Your selected course  is @course', ['@course' => $form_state->getValue('course')]));
        }
    }
?>