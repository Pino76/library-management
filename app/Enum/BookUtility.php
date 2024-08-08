<?php

namespace App\Enum;

enum BookUtility
{
    #Quanti giorni un utente può tenere il libro
    const EXPIRE_DATE_BOOK = 5;


    #Il libro viene prenotato
    const RESERVE = "created_at";

    #Il libro viene preso in prestito
    const BORROWED = "borrowed_date";

    #La data in cui il libro deve essere riconsegnato
    const TO_BE_RETURNED = "expire_date";


    #La data in cui il libro è stato riconsegnato
    const RETURNED = "returned_date";



}
