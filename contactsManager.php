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
function menuOptions()
{
  fwrite(STDOUT,

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

function viewContacts()
{

  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));

  // create info arrays
  // explode contact string by \n and save
  // $contactsArray = explode("\n", $contacts);
  // print_r($contactsArray);
  // explode string arrays by | into contact arrays
  //
  // build output
  // create table heading "CONTACTS"
  // create table columns with "Contact", "Number"
  // create formatted strings with foreach loop
  // concatenate everything into a string
  // output the string


  fwrite(STDOUT, $contacts.PHP_EOL) ;


  menuOptions();
}

viewContacts();


function addContact()
{
  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));

  fwrite(STDOUT, "Please enter first name:  ");
  $firstName = trim(fgets(STDIN));

  fwrite(STDOUT, "Please enter last name: ");
  $lastName = trim(fgets(STDIN));

  fwrite(STDOUT, "Please enter phone number:  ");
  $phoneNumber = fgets(STDIN);

  fwrite($handle, $firstName . " " . $lastName . "|" . $phoneNumber);

  fclose($handle);

  menuOptions();

}


function searchName()
{
  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  $contacts = trim($contacts);

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
  fclose($handle);
  menuOptions();
}



function deleteContact()
{
  $fileName = "contacts.txt";
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  $contacts = trim($contacts);
  

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
  menuOptions();
}
