<?php

namespace App\service;


use App\repository\opinionRepository;
use app\repository\appointmentRepository;
use app\repository\customerRepository;
use app\entity\customer;
use \DateTime;

class homeService
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

    public function index(): array
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

        for ($i = 1; $i <= 3; $i++) {
            $threeOpinions[] = array_shift($AllOpinions);
        }

        return $threeOpinions;
    }
}
