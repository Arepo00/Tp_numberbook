<?php
header('Content-Type: application/json'); // Set response header to JSON
include_once dirname(__FILE__).'/../service/ContactService.php';
include_once dirname(__FILE__).'/../classes/Contact.php';

$response = array();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required POST variables are set
    if (isset($_POST['name']) && isset($_POST['telephone'])) {
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];

        // Basic validation
        if (!empty($name) && !empty($telephone)) {
            try {
                $contactService = new ContactService();
                $newContact = new Contact(null, $name, $telephone); // ID is null for creation

                if ($contactService->create($newContact)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Contact created successfully via POST.';
                    // Optionally return the created contact details (might need to fetch it again if ID is needed)
                } else {
                    // This part might not be reached if create() uses die() on error
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to create contact.';
                }
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = 'An error occurred: ' . $e->getMessage();
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Missing required fields: name and telephone.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Required POST variables (name, telephone) not set.';
    }
} else {
    // Handle non-POST requests if necessary, e.g., return an error
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method. Only POST is accepted.';
    http_response_code(405); // Method Not Allowed
}

// Send the JSON response
echo json_encode($response);