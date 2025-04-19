<!DOCTYPE html>
<?php
// Include the ContactService
include_once dirname(__FILE__).'/service/ContactService.php';
$contactService = new ContactService();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Management</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        fieldset { margin-bottom: 20px; }
        legend { font-weight: bold; }
    </style>
</head>
<body>

    <form method="POST" action="controller/addContact.php">
        <fieldset>
            <legend>Add New Contact</legend>
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" value="" required /></td>
                </tr>
                <tr>
                    <td>Telephone:</td>
                    <td><input type="text" name="telephone" value="" required /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Add Contact" />
                        <input type="reset" value="Clear" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <h2>Contact List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Delete</th>
                <th>Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all contacts
            $contacts = $contactService->findAll();
            if (count($contacts) > 0) {
                foreach ($contacts as $contact) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact->getId()); ?></td>
                        <td><?php echo htmlspecialchars($contact->getName()); ?></td>
                        <td><?php echo htmlspecialchars($contact->getTelephone()); ?></td>
                        <td>
                            <!-- Link to a future delete controller -->
                            <a href="controller/deleteContact.php?id=<?php echo $contact->getId(); ?>" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
                        </td>
                        <td>
                            <!-- Link to a future update page -->
                            <a href="updateContact.php?id=<?php echo $contact->getId(); ?>">Modify</a>
                        </td>
                    </tr>
            <?php
                } // end foreach
            } else {
            ?>
                <tr>
                    <td colspan="5">No contacts found.</td>
                </tr>
            <?php
            } // end if
            ?>
        </tbody>
    </table>

</body>
</html>