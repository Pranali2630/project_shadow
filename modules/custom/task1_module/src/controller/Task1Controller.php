<?php
namespace Drupal\task1_module\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\Response;
// use Drupal\Core\Link;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Drupal\Core\Url;


class Task1Controller {
  public function task1() {
    return array(
      '#markup' => 'Welcome to our Website.'
    );
  }

  public function showdata() {


    drupal_flush_all_caches();
    // you can write your own query to fetch the data I have given my example.
   
        $result = \Drupal::database()->select('register_form', 'n')
        ->fields('n', array('id', 'name','mobile', 'email'))
        ->execute()->fetchAllAssoc('id');

        // $rows = array();
        // $i=1;
        // foreach ($result as $row => $content) {
        // $rows[] = array(
        // 'data' => array($i++, $content->name,$content->mobile,$content->email));
        // }
        //echo $button ='<a href="display" target="_blank" class="btn btn-primary" id="button">Export CSV</a>';

        
        // $header = array('Id', 'Name','Mobile','Email');
        // $output = array(
        // '#theme' => 'table', 
        // '#header' => $header,
        // '#rows' => $rows,
      
        // );
        // echo $button;

          return [
            '#theme' => 'userlistpage',
            '#items' => $result,
        ];
        //return $output;
      }


      public function downloadCsv() {		
		
        $result= \Drupal::database()->select('register_form', 'n')
        ->fields('n', array('id', 'name','mobile', 'email'))
        ->execute()->fetchAllAssoc('id');


          // Start using PHP's built in file handler functions to create a temporary file.
          $handle = fopen('php://temp', 'w+');

          // Set up the header that will be displayed as the first line of the CSV file.
          // Blank strings are used for multi-cell values where there is a count of
          // the "keys" and a list of the keys with the count of their usage.
          $header = [
            'Sr No',
            'Name',
            'Email',
            'Contact Details',
            
          ];
          // Add the header as the first line of the CSV.
          fputcsv($handle, $header);

          //foreach ($table as $node) {
            // Build the array for putting the row data together.
            //  $data = $this->buildRow($node);



            $result = \Drupal::database()->select('register_form', 'n')
            ->fields('n', array('id', 'name','mobile', 'email'))
            ->execute()->fetchAllAssoc('id');
          // Create the row element.
              $rows = array();
              foreach ($result as $row => $content) {

                  $rows= [
                    $content->id,
                    $content->name,
                    $content->email, 
                    $content->mobile
                  ];
                  fputcsv($handle, $rows);
              }
           

              

            // Add the data we exported to the next line of the CSV>
            
          //}

          // Reset where we are in the CSV.
          rewind($handle);
          
          // Retrieve the data from the file handler.
          $csv_data = stream_get_contents($handle);

          // Close the file handler since we don't need it anymore.  We are not storing
          // this file anywhere in the filesystem.
          fclose($handle);

          // This is the "magic" part of the code.  Once the data is built, we can
          // return it as a response.
          $response = new Response();

          // By setting these 2 header options, the browser will see the URL
          // used by this Controller to return a CSV file called "article-report.csv".
          $response->headers->set('Content-Type', 'text/csv');
          $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

          // This line physically adds the CSV data we created 
          $response->setContent($csv_data);

          return $response;


        
      }


      private function buildRow($node) {
        $user_data = $this->getuserData($node);
        $data = [
          'id' => $user_data['id'],
          'name' => $user_data['name'],
          'email' => $user_data['email'],
          'mobile' => $user_data['mobile'],
          
        ];
     
        return $data;
      }


     
}