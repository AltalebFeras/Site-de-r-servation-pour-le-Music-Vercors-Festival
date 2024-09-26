<?php

namespace src\Repositories;

use src\Models\Utilisateur;
use PDO;
use src\Models\Database;

class UtilisateurRepositories
{
    private $DB;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../../config.php';
    } 

    public function getAllUtilisateurs(): array
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE utilisateurID = :id";
        $statement = $this->DB->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllUtilisateurDetails($id): array
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE utilisateurID = :id";
        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoordonee($utilisateurID)
    {
        $sql = "SELECT prenom FROM " . PREFIXE . "utilisateur WHERE utilisateurID = :id";
        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':id', $utilisateurID);
        $statement->execute();
        $prenom = $statement->fetchColumn();
        return $prenom;
    }

    public function createUtilisateur(Utilisateur $Utilisateur): Utilisateur
    {
        $sql = "INSERT INTO " . PREFIXE . "utilisateur (nom, prenom, email, motDePasse, telephone, adresse, RGPD, role ) VALUES (:nom, :prenom,:email,:motDePasse, :telephone, :adresse, :RGPD, :role);";
        $statement = $this->DB->prepare($sql);

        $statement->execute([
            ':nom' => $Utilisateur->getNom(),
            ':prenom' => $Utilisateur->getPrenom(),
            ':email' => $Utilisateur->getEmail(),
            ':motDePasse' => $Utilisateur->getMotDePasse(),
            ':telephone' => $Utilisateur->getTelephone(),
            ':adresse' => $Utilisateur->getAdresse(),
            ':RGPD' => $Utilisateur->getRgpd()->format("Y-m-d"),
            ':role' => $Utilisateur->getRole()
        ]);

        $utilisateurID = $this->DB->lastInsertId();
        $Utilisateur->setUtilisateurID($utilisateurID);

        return $Utilisateur;
    }

    public function sInscrire()
    {
        if (
            empty($_POST) ||
            !isset($_POST['nom']) ||
            !isset($_POST['prenom']) ||
            !isset($_POST['email']) ||
            !isset($_POST['motDePasse']) ||
            !isset($_POST['motDePasseVerifier']) ||
            !isset($_POST['telephone']) ||
            !isset($_POST['adresse']) ||
            !isset($_POST['RGPD'])
        ) {
            $_SESSION['error_message0'] = "Missing required fields.";
            header('location: ' . HOME_URL);
            exit;
        }

         $nom = trim(htmlspecialchars($_POST['nom']));
        $prenom = trim(htmlspecialchars($_POST['prenom']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $motDePasse = $_POST['motDePasse'];
        $motDePasseVerifier = $_POST['motDePasseVerifier'];
        $telephone = trim(htmlspecialchars($_POST['telephone']));
        $adresse = trim(htmlspecialchars($_POST['adresse']));
        $RGPD = $_POST['RGPD'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message0'] = "Invalid email format. Please enter a valid email.";
            header('location: ' . HOME_URL);

            exit;
        }

         if (
            strlen($motDePasse) < 8
         ) {
            $_SESSION['error_message0'] = "Password must be at least 8 characters long and contain at least one letter, one number, and one special character.";
            header('location: ' . HOME_URL);

            exit;
        }

         if ($motDePasse !== $motDePasseVerifier) {
            $_SESSION['error_message0'] = "Passwords do not match. Please try again.";
            header('location: ' . HOME_URL);

            exit;
        }

         $utilisateurRepositories = new UtilisateurRepositories();
        $existingUtilisateur = $utilisateurRepositories->findByEmail($email);
        if ($existingUtilisateur) {
            $_SESSION['error_message0'] = "Email already exists.";
            header('location: ' . HOME_URL);

            exit;
        }

         $hashedmotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
        $RGPDdate = new \DateTime();

         $data = array(

            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'motDePasse' => $hashedmotDePasse,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'RGPD' => $RGPDdate,
            'role' => "user"
        );

        $newUtilisateur = new Utilisateur($data);

        $utilisateurRepositories->createUtilisateur($newUtilisateur);

        $_SESSION['success_message'] = "Votre inscription est validée!";
        $_SESSION['role'] = 'user';
        $_SESSION['utilisateur'] = $this->DB->lastInsertId();

        header('location: ' . HOME_URL . 'connexion');
        exit;
    }



    public function seConnecter()
    {

        if (
            isset($_POST['email']) &&
            isset($_POST['motDePasse']) &&
            !empty($_POST['email']) &&
            !empty($_POST['motDePasse'])
        ) {
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];

            $db = new Database();
            $conn = $db->getDB();


            $request = "SELECT * FROM mvf_utilisateur WHERE email = :email";
            $stmt = $conn->prepare($request);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($row) {
                 $utilisateurData = $row[0];

                 if (password_verify($motDePasse, $utilisateurData['motDePasse'])) {
                     $_SESSION['utilisateur'] = $utilisateurData['utilisateurID'];


                    $_SESSION['connecté'] = true;
                    header('location: ' . HOME_URL . 'dashboard/reservation');
                    exit;
                } else {
                    $_SESSION['error_message1'] = "Invalid email or password. Please try again.";
                    header('location: ' . HOME_URL . 'connexion');
                    exit;
                }
            } else {
                $_SESSION['error_message1'] = "User not found. Please try again.";
                header('location: ' . HOME_URL . 'connexion');
                exit;
            }
        }
    }

    public function findByEmail($email)
    {

        $request = 'SELECT * FROM ' . PREFIXE . 'utilisateur WHERE email = :email';
        $query = $this->DB->prepare($request);

        $query->execute(['email' => $email]);

        $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

        return $utilisateur ? $utilisateur : false;
    }

    public function deleteThisUser($utilisateurID): bool
    {
        $sql = "DELETE FROM " . PREFIXE . "utilisateur WHERE utilisateurID = :id";
        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':id', $utilisateurID, PDO::PARAM_INT);
        return $statement->execute();
    }
}
