<?php
header('Content-Type: application/json');
include_once dirname(__FILE__).'/../service/ContactService.php';

$response = array();

// Check if ID is provided in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate if ID is a number (basic validation)
    if (is_numeric($id)) {
        try {
            $contactService = new ContactService();
            $contact = $contactService->findById($id);

            if ($contact) {
                // Return the contact details
                $response['status'] = 'success';
                $response['contact'] = array(
                    'id' => $contact->getId(),
                    'name' => $contact->getName(),
                    'telephone' => $contact->getTelephone()
                );
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Contact not found.';
            }
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid ID provided. ID must be numeric.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No ID provided in the request.';
}

// Send the JSON response
echo json_encode($response);