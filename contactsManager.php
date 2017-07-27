<?php

//we will make 5 distinct functions for each option in the menu
startSession("contacts.txt");

function startSession($fileName) 
{
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  fwrite(STDOUT, $contacts);
  // viewContacts($contacts);
  menuOptions();
  return $handle;
}


function menuOptions() 
{
  fwrite(STDOUT, "Please enter a number to select an option.".PHP_EOL .
    "1) View Contacts" . PHP_EOL .
    "2) Add Contact" . PHP_EOL .
    "3) Search Name" . PHP_EOL .
    "4) NUKE Contact" . PHP_EOL .
    "5) Exit" . PHP_EOL);

  $input = fgets(STDIN);
  

  switch ($input) {
    case 1:
      // viewContacts($contacts);
      startSession("contacts.txt");
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

function viewContacts($contacts) 
{
  fwrite(STDOUT, $contacts) ;
}

function addContact() 
{
  echo "Contact added :)" . PHP_EOL;
  menuOptions();
}

function searchName() 
{
  echo "Name searched" . PHP_EOL;
  menuOptions();
}

function deleteContact() 
{
  echo "Contact Deleted" . PHP_EOL;
  menuOptions();
}

