<?php
include_once dirname(__FILE__).'/../dao/IDao.php';
include_once dirname(__FILE__).'/../connexion/Connexion.php';
include_once dirname(__FILE__).'/../classes/Contact.php';

class ContactService implements IDao {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($contact) {
        $query = "INSERT INTO contact (name, telephone) VALUES (:name, :telephone)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            'name' => $contact->getName(),
            'telephone' => $contact->getTelephone()
        )) or die('Error SQL');
        // Optionally, you might want to return the ID of the newly inserted contact
        // return $this->connexion->getConnexion()->lastInsertId();
        return true; // Indicate success
    }

    public function delete($contact) {
        $query = "DELETE FROM contact WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            'id' => $contact->getId()
        )) or die('Error SQL');
        return true; // Indicate success
    }

     public function update($contact) {
        $query = "UPDATE contact SET name = :name, telephone = :telephone WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            'id' => $contact->getId(),
            'name' => $contact->getName(),
            'telephone' => $contact->getTelephone()
        )) or die('Error SQL');
        return true; // Indicate success
    }

    public function findById($id) {
        $query = "SELECT id, name, telephone FROM contact WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            'id' => $id
        ));
        if ($res = $req->fetch(PDO::FETCH_OBJ)) {
            $contact = new Contact($res->id, $res->name, $res->telephone);
            return $contact;
        }
        return null; // Return null if not found
    }

    public function findAll() {
        $contacts = array();
        $query = "SELECT id, name, telephone FROM contact";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($res = $req->fetch(PDO::FETCH_OBJ)) {
            $contacts[] = new Contact($res->id, $res->name, $res->telephone);
        }
        return $contacts;
    }
}