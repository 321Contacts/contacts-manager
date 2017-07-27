<?php

//we will make 5 distinct functions for each option in the menu


function startSession($fileName) {
  //retrieve info on session_start, open method a+ (read and write. pointer at the end of the file, create if not existent)
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  viewContacts($contacts);
  menuOptions();
}


function menuOptions() 
{
  //print menu of options
  fwrite(STDOUT, "Please enter a number to select an option.".PHP_EOL);
  fwrite(STDOUT, "1) View Contacts".PHP_EOL);
  fwrite(STDOUT, "2) Add Contact".PHP_EOL);
  fwrite(STDOUT, "3) Search Name".PHP_EOL);
  fwrite(STDOUT, "4) NUKE Contact".PHP_EOL);
  fwrite(STDOUT, "5) Exit".PHP_EOL);
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

function viewContacts($contacts) {
  //print a list
  fwrite(STDOUT, $contacts) ;
}

function addContact() {
  echo "Contact added :)" . PHP_EOL;
  menuOptions();
}

function searchName() {
  echo "Name searched" . PHP_EOL;
  menuOptions();
}

function deleteContact() {
  echo "Contact Deleted" . PHP_EOL;
  menuOptions();
}

startSession("contacts.txt");
