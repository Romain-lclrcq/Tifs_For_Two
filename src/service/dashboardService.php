<?php

namespace App\service;

use App\repository\accountRepository;
use App\repository\appointmentRepository;
use App\repository\customerRepository;
use App\repository\employeRepository;
use App\repository\serviceRepository;
use App\entity\customer;
use \DateTime;


class dashboardService
{

    private accountRepository $accountRepository;
    private customerRepository $customerRepository;
    private appointmentRepository $appointmentRepository;
    private employeRepository $employeRepository;
    private serviceRepository  $serviceRepository;

    public function __construct(accountRepository $accountRepository, customerRepository $customerRepository, appointmentRepository $appointmentRepository, employeRepository $employeRepository, serviceRepository  $serviceRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->customerRepository = $customerRepository;
        $this->appointmentRepository = $appointmentRepository;
        $this->employeRepository = $employeRepository;
        $this->serviceRepository = $serviceRepository;
    }


    public function index()
    {
        // TODO chercher les différentes infos du compte utilisateur 
        $account = $this->accountRepository->findById($_SESSION['Id_account']);
        // TODO Fonction dans le CustomerRepo pour récupérer les users qui ont le mêmes ID que le compte

        $_SESSION['mail'] = $account->getMail();
        $_SESSION['tel'] = $account->getTelNumber();
        $_SESSION['idaccount'] = $account->getIdAccount();


        // chercher les utilisateurs
        $customers = $this->customerRepository->findByIdAccount($account->getIdAccount());
        $_SESSION['customers'] = $customers;



        // TODO puis chercher les différentes infos pour l'historique
        $appointmentData = [];
        foreach ($customers as $customer) {
            $appointments  = $this->appointmentRepository->findAppointmentByCustomer($customer->getIdcustomer());
            foreach ($appointments as $appointment) {
                $employe = $this->employeRepository->findById($appointment->getIdEmploye());
                $service = $this->serviceRepository->findById($appointment->getIdService());

                $appointmentData[] = [
                    // Utiliser ':' pour l'heure permet un format standard et facilite le tri
                    'date' => $appointment->getDateTime()->format('d-m-Y H:i'),
                    'firstname' => $customer->getFirstname(),
                    'lastname' => $customer->getLastname(),
                    'employe' => $employe->getFirstname(),
                    'service' => $service->getDescription(),
                    'serviceDuration' => $service->getTime()
                ];
            }
        }

        // mettre les données dans la session pour les afficher dans la vue
        $_SESSION['appointments'] = $appointmentData;
    }


    public function findCustomerById(int $id)
    {
        return $this->customerRepository->findById($id);
    }

    public function deleteCustomerById(int $id)
    {
        $this->customerRepository->delete($id);
    }

    public function disconnect()
    {
        session_destroy();
    }

    public function update(array $data)
    {

        $birthday = new DateTime($data['birthday']);

        $customer = new customer(
            $data['lastname'],
            $data['firstname'],
            $birthday,
            (int)$data['idAccount'],
            (int)$data['idCustomer']
        );

        $this->customerRepository->update($customer);
    }



    public function create(array $data)
    {
        $birthday = new DateTime($data['birthday']);

        $customer = new customer(
            $data['lastname'],
            $data['firstname'],
            $birthday,
            $data['idAccount'],
        );
        $this->customerRepository->create($customer);
        return $customer;
    }
}
