<?php

//we will make 5 distinct functions for each option in the menu
// startSession("contacts.txt");
//
// function startSession($fileName)
// {
//   $handle = fopen($fileName, 'a+');
//   $contacts = fread($handle, filesize($fileName));
//   viewContacts($contacts);
//   menuOptions($contacts);
//   return $contacts;
// }
//
//
viewContacts();

function menuOptions()
{

  fwrite(STDOUT,
    PHP_EOL .
    "1) View Contacts" . PHP_EOL .
    "2) Add Contact" . PHP_EOL .
    "3) Search Name" . PHP_EOL .
    "4) NUKE Contact" . PHP_EOL .
    "5) Exit" . PHP_EOL . PHP_EOL .
   "Please enter a number to select an option:  "
  );

  $input = fgets(STDIN);


  switch ($input) {
    case 1:
      viewContacts();

      break;

    case 2:
      addContact();

      break;

    case 3:
      searchName();

      break;

    case 4:
      deleteContact();

    case 5:
      exit;

    default:
      echo "Please enter a valid number between 1 and 5" . PHP_EOL;
      menuOptions();
      break;
  }

}

function readContacts()
{
  clearstatcache();
  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'r');
  $contacts = fread($handle, filesize($fileName));
  fclose($handle);
  $contacts = trim($contacts);
  return $contacts;
}



function viewContacts()
{
  system('clear');

  $contacts = readContacts();

  //table heading
  $line1 = "\e[31m" . str_pad("CONTACTS", 50, "-", STR_PAD_BOTH);
  $line2 = str_pad("NAME", 24, " ", STR_PAD_RIGHT) . "|" . str_pad("NUMBER", 25, " ", STR_PAD_LEFT);
  $line3 = str_pad("", 50, "-", STR_PAD_BOTH) . "\e[0m";
  $heading =  $line1 . PHP_EOL . PHP_EOL . $line2 . PHP_EOL . $line3 . PHP_EOL;

  //explode data for table formatting
  $formatArray = explode("\n", $contacts);
  // $arrayArrays = [];

  foreach($formatArray as $key => $value) {
    $arrayArrays[$key] = explode("|", $value);
    $arrayArrays[$key][1] = substr($arrayArrays[$key][1], 0, 3) . "-" . substr($arrayArrays[$key][1], 3, 3) . "-" . substr($arrayArrays[$key][1], 6);
  }

  //echo to print table
  echo $heading;
  foreach($arrayArrays as $key => $value) {
    echo str_pad($value[0], 24, " ", STR_PAD_RIGHT);
    echo "|";
    echo str_pad($value[1], 25, " ", STR_PAD_LEFT) . PHP_EOL;
  }
 
  menuOptions();
}


function addContact()
{
  system('clear');

  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'a+');

  fwrite(STDOUT, "Please enter first name:  ");
  $firstName = trim(fgets(STDIN));

  fwrite(STDOUT, "Please enter last name: ");
  $lastName = trim(fgets(STDIN));

  fwrite(STDOUT, "Please enter phone number:  ");
  $phoneNumber = fgets(STDIN);

  fwrite($handle, $firstName . " " . $lastName . "|" . $phoneNumber);

  fclose($handle);

  viewContacts();
  menuOptions();
}


function searchName()
{
 
  $contacts = readContacts();

  $contactsArray = explode("\n", $contacts);

  fwrite(STDOUT, "Enter name to search for contact: ") ;
  $searchingFor = trim(fgets(STDIN));

  foreach($contactsArray as $key => $value){
    if (strpos(strtolower($value), strtolower($searchingFor)) !== false) {
      echo PHP_EOL . $value . PHP_EOL . PHP_EOL;

    } else {
       // echo "not found";
    }
  }


  menuOptions();
}



function deleteContact()
{

  // $fileName = "contacts.txt";
  // $handle = fopen($fileName, 'a+');
  // $contacts = fread($handle, filesize($fileName));
  // fclose($handle);
  // $contacts = trim($contacts);

  $contacts = readContacts();

  $contactsArray = explode("\n", $contacts);

  fwrite(STDOUT, "Enter a name to NUKE: ");
  $searchingFor = trim(fgets(STDIN));

  foreach($contactsArray as $key => $value) {
    if (strpos(strtolower($value), strtolower($searchingFor)) !== false) {
      $searchKey = $key;
    } else {
      // echo "not found";
    }
  }


  unset($contactsArray[$searchKey]);
  $contactString = implode("\n", $contactsArray) .PHP_EOL;
  $handle = fopen($fileName, 'w');
  fwrite($handle, $contactString);
  fclose($handle);

  viewContacts();
  menuOptions();
}
