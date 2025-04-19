<?php
include_once dirname(__FILE__).'/../service/ContactService.php';
include_once dirname(__FILE__).'/../classes/Contact.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';

    // Basic validation (you might want more robust validation)
    if (!empty($name) && !empty($telephone)) {
        // Instantiate the service
        $contactService = new ContactService();

        // Create a new Contact object (id is null as it's auto-incremented)
        $newContact = new Contact(null, $name, $telephone);

        // Use the service to create the contact
        $contactService->create($newContact);

        // Redirect back to the main page (or a success page)
        header("Location: ../index.php");
        exit; // Important to prevent further script execution after redirection
    } else {
        // Handle error - e.g., redirect back with an error message
        // For simplicity, just redirecting back
        header("Location: ../index.php?error=missing_fields");
        exit;
    }
} else {
    // If accessed directly without POST, redirect to index
    header("Location: ../index.php");
    exit;
}