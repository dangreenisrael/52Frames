<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 15:12
 */

class Album {
    public $albumId;

    public function __construct($albumId){
        $this->albumId = $albumId;
    }


    /*
     * Return Number
     */
    public function getPhotoCount(){
        return null;
    }


    /*
     * Return Number
     */
    public function getWeekNumber(){
        return null;
    }


    /*
     * Return String
     */
    public function getChallengeName(){
        return null;
    }

    /*
     * Return String
     */
    public function getExtraChallengeName(){
        return null;
    }


    /*
     * Return Array of Photo Objects
     */
    public function getWinners(){
        return null;
    }


    /*
     * Return Photo Object
     */
    public function getAudienceAward(){
        return null;
    }
}