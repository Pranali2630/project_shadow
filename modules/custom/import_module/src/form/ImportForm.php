<?php
namespace Drupal\import_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;



/**
 * install composer require phpoffice/phpspreadsheet
 * Provides a form for deleting a batch_import_example entity.
 *
 * @ingroup batch_import_example
 */
class ImportForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return 'import_data';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#prefix'] = '<p>This example form will import  CSV file  </p>';


    $form = array(
        '#attributes' => array('enctype' => 'multipart/form-data'),
    );
      
    $form['file_upload_details'] = array(
        '#markup' => t('<b>The File</b>'),
    );
      
    $validators = array(
        'file_validate_extensions' => array('csv'),
    ); 
    $form['excel_file'] = array(
        '#type' => 'managed_file',
        '#name' => 'excel_file',
        '#title' => t('File *'),
        '#size' => 20,
        '#description' => t('Excel format only'),
        '#upload_validators' => $validators,
        '#upload_location' => 'public://content/excel_files/',
    );

    $form['actions'] = array(
      '#type' => 'actions',
      'submit' => array(
        '#type' => 'submit',
        '#value' => 'Import',
      ),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $file = \Drupal::entityTypeManager()->getStorage('file')
    ->load($form_state->getValue('excel_file')[0]);    
    $full_path = $file->get('uri')->value;
    $file_name = basename($full_path);

    $inputFileName = \Drupal::service('file_system')->realpath('public://content/excel_files/'.$file_name);
		
		$spreadsheet = IOFactory::load($inputFileName);
		
		$sheetData = $spreadsheet->getActiveSheet();
		
		$rows = array();
		foreach ($sheetData->getRowIterator() as $row) {
			//echo "<pre>";print_r($row);exit;
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE); 
			$cells = [];
			foreach ($cellIterator as $cell) {
				$cells[] = $cell->getValue();
					 

			}
           $rows[] = $cells;
		   
		}

    foreach($rows as $row){
			$id = $row[0];
      $name = $row[1];
      $email = $row[2];
      $mobile = $row[3];

      $query=\Drupal::database();
      $query->insert('import_data') -> fields(array(
          'name'=>$name,
          'email'=>$email,
          'mobile'=>$mobile,
          // 'role'=>$role,
          // 'course'=>$course,
          

      ))->execute();

      $query=\Drupal::database();

		}
		
		\Drupal::messenger()->addMessage('imported successfully');

    //     echo "<pre>";
    //     print_r($rows);
    //     echo "</pre>";

    
  }


}
