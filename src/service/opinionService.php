<?php

namespace App\service;

use App\repository\opinionRepository;
use app\repository\appointmentRepository;
use app\repository\customerRepository;
use \DateTime;

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
        $result = [];
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
        // var_dump($firstnames);
        // var_dump($opinions);
        // foreach ($opinions as $opinion) {
        //     foreach ($firstnames as $firstname) {
        //         $result[] = ([
        //             'firstname' => $firstname->getFirstname(),
        //             'commentary' => $opinion['commentary'],
        //             'note' => $opinion['note']
        //         ]);
        //     }
        // // }
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
}
