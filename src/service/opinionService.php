<?php

namespace App\service;

use App\repository\opinionRepository;
use app\repository\appointmentRepository;
use app\repository\customerRepository;
use \DateTime;
use App\entity\opinion;

class opinionService
{
    private opinionRepository $opinionRepository;
    private appointmentRepository $appointmentRepository;
    private customerRepository $customerRepository;

    public function __construct(opinionRepository $opinionRepository, appointmentRepository $appointmentRepository, customerRepository $customerRepository)
    {
        $this->opinionRepository = $opinionRepository;
        $this->appointmentRepository = $appointmentRepository;
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $idAppointments = [];
        $opinions = $this->opinionRepository->findAll();
        foreach ($opinions as $opinion) {
            $idAppointments[] = $opinion['Id_appointment'];
        }
        foreach ($idAppointments as $idAppoitnment) {
            $idCustomer = $this->appointmentRepository->findAppointmentById($idAppoitnment);
            $firstname = $this->customerRepository->findById($idCustomer->getIdCustomer());
            $firstnames[] = $firstname->getFirstname();
        }

        foreach ($opinions as $opinion) {
            $date = new DateTime($opinion['date_publication']);
            $opinion[] = ['firstname' => $firstnames[0]];
            $AllOpinions[] = [
                'date' => $date,
                'firstname' => $firstnames[0],
                'commentary' => $opinion['commentary'],
                'note' => $opinion['note']
            ];
            array_shift($firstnames);
        }

        usort($AllOpinions, function ($a, $b) {
            return $b <=> $a;
        });


        return $AllOpinions;
    }

    public function publication(array $data)
    {
        // Protéger le texte envoyé
        $opinion = htmlspecialchars($data['descriptif']);

        // Vérifier que la personne est connecté
        if (!isset($_SESSION['Id_account'])) {
            return $err[] = 'Il faut être connecté pour publier un avis.';
        }

        // Vérifier si le compte connecté à déjà pris rdv 
        // ET
        // Que le rdv soit déjà passé
        // Avec l'id du compte, on récupère TOUS les ids customer associé /
        // On regarde ensuite si il y a un appointment qui a un de ces ids Customer
        // (est ce que mon client, qui a un compte, a déjà pris rdv)
        // Si oui, est ce que le rdv est déjà passé ?
        // (Pour éviter de poster un avis uniquement grâce à une prise de rdv)
        $idAccount = $_SESSION['Id_account'];


        $customers = $this->customerRepository->findByIdAccount($idAccount);
        $today = new DateTime();
        $validationDate = false;
        // $lastAppointment = $this->appointmentRepository->find
        foreach ($customers as $customer) {
            $idCustomer = $customer->getIdcustomer();
            $appointments = $this->appointmentRepository->findAppointmentByCustomer($idCustomer);
            foreach ($appointments as $appointment) {

                if ($today >  $appointment->getDateTime()) {
                    var_dump($appointment);
                    $idAppointment = $appointment->getIdappointment();
                    $validationDate = true;
                    break;
                }
            }
        }
        if (!$validationDate) {
            $err[] = 'prends rdv';
        }




        if (!isset($appointments)) {
            $err[] = 'Vous devez avoir pris rendez-vous pour poster un avis.';
        }


        var_dump($today);
        if (!empty($err)) {
            return $err;
        } else {
            $opinion = new opinion(
                $opinion,
                $today,
                $_POST['note'],
                $idAppointment

            );
            $result =  $this->opinionRepository->create($opinion);
            $result = 'tout va bien';
            return $result;
        }
    }
}
