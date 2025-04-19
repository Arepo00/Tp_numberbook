<?php
header('Content-Type: application/json');
include_once dirname(__FILE__).'/../service/ContactService.php';

$response = array();

try {
    $contactService = new ContactService();
    $contacts = $contactService->findAll();

    $contactData = array();
    foreach ($contacts as $contact) {
        $contactData[] = array(
            'id' => $contact->getId(),
            'name' => $contact->getName(),
            'telephone' => $contact->getTelephone()
        );
    }

    $response['status'] = 'success';
    $response['contacts'] = $contactData;

} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'An error occurred: ' . $e->getMessage();
}

// Send the JSON response
echo json_encode($response);