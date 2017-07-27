<?php

//we will make 5 distinct functions for each option in the menu


function startSession($fileName) {
  //retrieve info on session_start, open method a+ (read and write. pointer at the end of the file, create if not existent)
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  viewContacts($contacts);
  menuOptions();
}


function menuOptions() {
  //print menu of options
  fwrite(STDOUT, "Please enter a number to select an option.".PHP_EOL);
  fwrite(STDOUT, "1) View Contacts".PHP_EOL);
  fwrite(STDOUT, "2) Add Contact".PHP_EOL);
  fwrite(STDOUT, "3) Add Contact".PHP_EOL);
  $input = fgets(STDIN);
  
  if ($input == 2) {
    addContacts();
  }
  if ($input == 2) {
    addContacts();
  }
  if ($input == 2) {
    addContacts();
  }

}

function viewContacts($contacts) {
  //print a list
  fwrite(STDOUT, $contacts) ;
}

function addContacts() {
  //add a contacts
  echo "Contact added :)";
}

function searchName() {
  //search by name
}

function deleteContact() {
  //delete contact
}
startSession("contacts.txt");
