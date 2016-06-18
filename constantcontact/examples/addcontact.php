<?php
// require the autoloader


require_once './constantcontact/src/Ctct/autoload.php';

use Ctct\ConstantContact;
use Ctct\Components\Contacts\Contact;
use Ctct\Components\Contacts\ContactList;
use Ctct\Components\Contacts\EmailAddress;
use Ctct\Exceptions\CtctException;

// Enter your Constant Contact APIKEY and ACCESS_TOKEN


define("APIKEY",  $config['constantcontact_api_key']);
define("ACCESS_TOKEN", $config['constantcontact_access_token']);


$cc = new ConstantContact(APIKEY);



// attempt to fetch lists in the account, catching any exceptions and printing the errors to screen

    $lists = $cc->getLists(ACCESS_TOKEN);

//print_r($lists);die;

foreach ($lists as $list) {
	if($list->name == $config['constantcontact_list_name'])
	{
		$new_list=$list->id;
	}
}
if (isset($email) && strlen($email) > 1) {
   $response = $cc->getContactByEmail(ACCESS_TOKEN, $email);
   // create a new contact if one does not exist
        if (empty($response->results)) {
            $action = "Creating Contact";

            $contact = new Contact();
            $contact->addEmail($email);
            $contact->addList($new_list);
            $contact->first_name = $username;
            $contact->last_name = $username;

            /*
             * The third parameter of addContact defaults to false, but if this were set to true it would tell Constant
             * Contact that this action is being performed by the contact themselves, and gives the ability to
             * opt contacts back in and trigger Welcome/Change-of-interest emails.
             *
             * See: http://developer.constantcontact.com/docs/contacts-api/contacts-index.html#opt_in
             */
            
            $returnContact = $cc->addContact(ACCESS_TOKEN, $contact, true);

            // update the existing contact if address already existed
        } else {
            $action = "Updating Contact";

            $contact = $response->results[0];
            $contact->addList($new_list);
            $contact->first_name = $username;
            $contact->last_name = $username;

            /*
             * The third parameter of updateContact defaults to false, but if this were set to true it would tell
             * Constant Contact that this action is being performed by the contact themselves, and gives the ability to
             * opt contacts back in and trigger Welcome/Change-of-interest emails.
             *
             * See: http://developer.constantcontact.com/docs/contacts-api/contacts-index.html#opt_in
             */
            $returnContact = $cc->updateContact(ACCESS_TOKEN, $contact, true);
        }
}

if (isset($returnContact)) {
   /* echo '<div class="container alert-success"><pre class="success-pre">';
    print_r($returnContact);
    echo '</pre></div>';*/
    return $returnContact;
} 

?>
