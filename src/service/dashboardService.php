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
        if ($_SESSION['Id_account'] !== 34) {

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

                // mettre les données dans la session pour les afficher dans la vue
                $_SESSION['appointments'] = $appointmentData;
            }
        } else {
            $listingToday =  [];
            $listingFuture = [];
            $appointmentsToday = $this->appointmentRepository->findAllAppointmentToday();

            foreach ($appointmentsToday as $appointment) {
                $hourAppointment = (new DateTime($appointment['Date_time']))->format('h\hi');

                $customer = $this->customerRepository->findById($appointment['Id_customer']);
                $firstname = $customer->getFirstname();
                $lastname = $customer->getLastname();

                $prestation = $this->serviceRepository->findById($appointment['Id_service']);
                $libelle = $prestation->getDescription();
                $time = $prestation->getTime();

                $employe = $this->employeRepository->findById($appointment['Id_employe']);
                $employeName = $employe->getFirstname();
                $listingToday[] =
                    [
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "prestation" => $libelle,
                        "timeOfPrestation" => $time,
                        "hourAppointment" => $hourAppointment,
                        "employe" => $employeName,
                    ];
                var_dump('coucou');
            }
            usort($listingToday, function ($a, $b) {
                return $b['hourAppointment'] <=> $a['hourAppointment'];
            });


            $appointmentsFuture = $this->appointmentRepository->findFutureAppointments();

            foreach ($appointmentsFuture as $appointment) {
                $customer = $this->customerRepository->findById($appointment['Id_customer']);
                $firstname = $customer->getFirstname();
                $lastname = $customer->getLastname();

                $service = $this->serviceRepository->findById($appointment['Id_service']);
                $prestation = $service->getDescription();
                $time = $service->getTime();

                $date = (new DateTime($appointment['Date_time']))->format('Y-m-d h:i');

                $employe = $this->employeRepository->findById($appointment['Id_employe']);
                $employeName = $employe->getFirstname();



                $listingFuture[] = [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "prestation" => $prestation,
                    "timeOfPrestation" => $time,
                    "dateAppointment" => $date,
                    "employe" => $employeName,
                ];
            }

            usort($listingToday, function ($a, $b) {
                return $b['hourAppointment'] <=> $a['hourAppointment'];
            });


            return [
                'today' => $listingToday,
                'future' => $listingFuture
            ];
        }
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
