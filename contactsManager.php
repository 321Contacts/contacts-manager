<?php

//we will make 5 distinct functions for each option in the menu


function startSession($fileName) {
  //retrieve info on session_start, open method a+ (read and write. pointer at the end of the file, create if not existent)
  $handle = fopen($fileName, 'a+');
  $contacts = fread($handle, filesize($fileName));
  return $contacts;
}
 $list = startSession("contacts.txt");
 echo $list;  

function menuOptions() {
  //print menu of options
}

function showList() {
  //print a list
}

function addContacts() {
  //add a contacts
}

function searchName() {
  //search by name
}

function deleteContact() {
  //delete contact
}
