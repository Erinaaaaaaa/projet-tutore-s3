<?php

function isMdpOk($mdpDB, $mdpUser){

    if($mdpDB == $mdpUser){
        return true;
    }
    else
        return false;
}
