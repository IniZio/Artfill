<!DOCTYPE HTML>
<html>
<head>
    <title>Constant Contact API v2 Add/Update Contact Example</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<!--
README: Add or update contact example
This example flow illustrates how a Constant Contact account owner can add or update a contact in their account. In order for this example to function 
properly, you must have a valid Constant Contact API Key as well as an access token. Both of these can be obtained from 
http://constantcontact.mashery.com.
-->

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
try {
    $lists = $cc->getLists(ACCESS_TOKEN);

    
} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
      //  print_r($error);
    }
}

foreach ($lists as $list) {
	if($list->name == $config['constantcontact_list_name'])
	{
		$new_list=$list->id;
	}
}


// check if the form was submitted
if (isset($email) && strlen($email) > 1) {
    $action = "Getting Contact By Email Address";
    try {
        // check to see if a contact with the email addess already exists in the account
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

        // catch any exceptions thrown during the process and print the errors to screen
    } catch (CtctException $ex) {
       /* echo '<span class="label label-important">Error ' . $action . '</span>';
        echo '<div class="container alert-error"><pre class="failure-pre">';
        print_r($ex->getErrors());
        echo '</pre></div>';
        die();*/
    }
}
?>

<body>
<div class="well">
  

    <form class="form-horizontal" name="submitContact" id="submitContact" method="POST" action="addOrUpdateContact.php">
    <input type="hidden" name="list" value="' . $new_list . '"/>
    <input type="hidden" id="email" name="email" value="' . $email . '"/>
    <input type="hidden" id="first_name" name="first_name" value="' . $username . '"/>
    <input type="hidden" id="last_name" name="last_name" value="' . $username . '"/>
    
     
       <?php /*?> <div class="control-group">
            <label class="control-label" for="email">Email</label>

            <div class="controls">
                <input type="email" id="email" name="email" placeholder="Email Address">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="first_name">First Name</label>

            <div class="controls">
                <input type="text" id="first_name" name="first_name" placeholder="First Name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="last_name">Last Name</label>

            <div class="controls">
                <input type="text" id="last_name" name="last_name" placeholder="Last Name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="list">List</label>

            <div class="controls">
                <select name="list">
                    <?php
                    foreach ($lists as $list) {
                        echo '<option value="' . $list->id . '">' . $list->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                <div class="controls">
                    <input type="submit" value="Submit" class="btn btn-primary"/>
                </div>
        </div><?php */?>
    </form>
</div>


<!-- Success Message -->
<?php if (isset($returnContact)) {
   /* echo '<div class="container alert-success"><pre class="success-pre">';
    print_r($returnContact);
    echo '</pre></div>';*/
    return $returnContact;
} 

?>


</body>
</html>